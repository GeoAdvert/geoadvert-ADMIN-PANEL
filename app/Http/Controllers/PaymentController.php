<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Models\Advertisement;
use App\Models\Transaction;
use Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PaymentController extends Controller
{
    public function index()
    {
        return view('pages.payment');
    }

    public function checkout(Request $request)
    {
        // Check if this is for purchasing additional views for existing ad
        $adsId = $request->get('ads');

        if ($adsId) {
            return $this->checkoutForAdditionalViews($request, $adsId);
        }

        // Original checkout logic for new advertisements
        $package = session('selected_package');
        $media   = session('payment_media');

        if (!$package || !$media) {
            return back()->with('error', 'Session timed out. The package or media is no longer available.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'    => 'pln',
                    'unit_amount' => intval($package['price'] * 100),
                    'product_data' => ['name' => 'Ad package ' . $package['views'] . ' views'],
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('payment.cancel'),
            'metadata'    => [
                'user_id' => auth()->id(),
                'views'   => $package['views'],
                'price'   => $package['price'],
                'file'    => json_encode($media),
                'type'    => 'new_ad', // Flag to identify this is for new ad
            ],
        ]);

        return redirect()->away($stripeSession->url);
    }

    private function checkoutForAdditionalViews(Request $request, $adsId)
    {
        // Validate required parameters
        $views = $request->get('views');
        $price = $request->get('price');

        if (!$views || !$price) {
            return back()->with('error', 'Views and price parameters are required');
        }

        // Verify the advertisement exists and belongs to the user
        $advertisement = Advertisement::where('id', $adsId)
            ->where('tab_Id', auth()->id())
            ->first();

        if (!$advertisement) {
            return back()->with('error', 'Advertisement not found or access denied');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $stripeSession = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'    => 'pln',
                    'unit_amount' => intval($price * 100),
                    'product_data' => [
                        'name' => 'Additional Views: ' . number_format($views) . ' views for ' . $advertisement->fileType
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('payment.cancel'),
            'metadata'    => [
                'user_id'          => auth()->id(),
                'advertisement_id' => $adsId,
                'additional_views' => $views,
                'price'           => $price,
                'type'            => 'additional_views', // Flag to identify this is for additional views
            ],
        ]);

        return redirect()->away($stripeSession->url);
    }

    public function success(Request $request)
    {
        $sid = $request->get('session_id');
        if (!$sid) return redirect()->route('payment.cancel');

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($sid);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('payment.cancel');
        }

        $meta = $session->metadata;

        // Check if this is for additional views or new advertisement
        if ($meta->type === 'additional_views') {
            return $this->handleAdditionalViewsPurchase($session, $meta);
        } else {
            return $this->handleNewAdvertisementPurchase($session, $meta);
        }
    }

    private function handleAdditionalViewsPurchase($session, $meta)
    {
        // Find the existing advertisement
        $advertisement = Advertisement::find($meta->advertisement_id);

        if (!$advertisement) {
            return redirect()->route('payment.cancel')->with('error', 'Advertisement not found');
        }

        // Update the advertisement views (add to existing views)
        $advertisement->increment('views', $meta->additional_views);

        // Create transaction record for additional views purchase
        Transaction::create([
            'user_id'           => $meta->user_id,
            'advertisement_id'  => $advertisement->id,
            'stripe_session_id' => $session->id,
            'purchasing_status' => 'Purchase for views',
            'status'            => 'paid',
            'amount'            => $meta->price,
            'views_purchased'   => $meta->additional_views,
        ]);

        session()->flash('success', 'Additional views purchased successfully! ' . number_format($meta->additional_views) . ' views added to your advertisement.');

        return redirect()->route('myAdvertising.index');
    }

    private function handleNewAdvertisementPurchase($session, $meta)
    {
        // Original logic for new advertisements
        $media  = json_decode($meta->file, true);
        $oldRel = $media['file_path'];

        $filename = basename($oldRel);
        $from     = public_path($oldRel);
        $toDir    = storage_path('app/public/media');
        $to       = $toDir . '/' . $filename;

        if (!is_dir($toDir)) {
            mkdir($toDir, 0755, true);
        }
        File::move($from, $to);

        $newRel = 'media/' . $filename;

        $adType = $media['ad_type'] ?? null;

        $ad = Advertisement::create([
            'tab_Id'        => $meta->user_id,
            'radius'        => null,
            'videoDuration' => 5000,
            'locationBased' => false,
            'status'        => 'active',
            'fileType'      => $media['type'],
            'fileName'      => $filename,
            'views'         => $meta->views,
            'type'          => $adType,
            'start_time'    => null,
        ]);

        Transaction::create([
            'user_id'           => $meta->user_id,
            'advertisement_id'  => $ad->id,
            'stripe_session_id' => $session->id,
            'purchasing_status' => 'Purchase for ads',
            'status'            => 'paid',
            'amount'            => $meta->price,
            'views_purchased'   => $meta->views,
        ]);

        session()->forget(['selected_package', 'payment_media']);
        session()->flash('success', 'New advertisement created successfully!');

        return redirect()->route('myAdvertising.index');
    }

    public function cancel()
    {
        return view('pages.summary');
    }
}
