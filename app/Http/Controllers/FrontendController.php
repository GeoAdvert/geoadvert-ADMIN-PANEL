<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Advertisement;
use Hash;
use Auth;
use App\Models\User;

class FrontendController extends Controller
{
    public function start()
    {
        return view('pages.start');
    }

    public function advertisingVideo()
    {
        return view('pages.advertising.advertising-video');
    }

    public function logins()
    {
        return view('pages.login');
    }

    public function summary()
    {
        $pkg = session('selected_package');
        $price = $pkg['price']  ?? 0;
        $vat   = round($price * 0.23, 2);
        $total = round($price + $vat, 2);

        return view('pages.summary', compact('pkg', 'price', 'vat', 'total'));
    }


    public function customerData()
    {
        return view('pages.customer-data');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'country'    => 'required',
            'company'    => 'required|max:255',
            'nip'    => 'required|max:255',
            'email'      => 'required|email|unique:users,email',
            'street'     => 'required|string|max:255',
            'house_no'     => 'required|string|max:255',
            'apartment_no'     => 'required|string|max:255',
            'zip_code'     => 'required|string|max:20',
            'locality'   => 'required|string|max:50',
            'directional'   => 'required|string|max:255',
            'phone_number'      => 'required|string|max:30',
            'password'   => 'required|min:8',
        ]);

        $user = User::create([
            'country'     => $data['country'],
            'name'     => $data['company'],
            'nip'    => $data['nip'],
            'email'    => $data['email'],
            'street'    => $data['street'],
            'house_no'    => $data['house_no'],
            'apartment_no'    => $data['apartment_no'],
            'zip_code'    => $data['zip_code'],
            'locality'    => $data['locality'],
            'directional'    => $data['directional'],
            'phone_number'    => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'hashedPassword' => $data['password'],
        ]);

        $user->assignRole('tablet');

        return redirect()
            ->route('logins.index')
            ->with('success', 'Account created! Please log in.');
    }


    public function myAdvertising()
    {
        if(!auth()->check()){
            return redirect()->route('start')->with('error' , 'Please login your account first');
        }else{
            $advertisments = Advertisement::where('tab_Id', auth()->user()->id)->latest()->paginate(10);
            return view('pages.my-advertising', compact('advertisments'));
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'media_file' => 'required|file|mimes:png,jpg,jpeg,mp4|max:10240',
            'type' => 'required|in:restaurant,hotel,banner'
        ]);

        if ($old = $request->session()->pull('payment_media')) {
            $oldFull = public_path($old['file_path']);
            if (file_exists($oldFull)) {
                @unlink($oldFull);
            }
        }

        $file     = $request->file('media_file');
        $type = $request->input('type');
        $isImage  = str_starts_with($file->getMimeType(), 'image/');
        $subDir   = $isImage ? 'payment/image' : 'payment/video';
        $filename = Str::uuid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        $destPath = public_path($subDir);
        if (!is_dir($destPath)) {
            mkdir($destPath, 0755, true);
        }
        $file->move($destPath, $filename);

        $relPath = $subDir . '/' . $filename;

        $request->session()->put('payment_media', [
            'type'          => $isImage ? 'image' : 'video',
            'filename'      => $filename,
            'ad_type' => $type,
            'file_path'     => $relPath,
            'original_name' => $file->getClientOriginalName(),
            'uploaded_at'   => now()->toDateTimeString(),
        ]);

        return response()->json([
            'success'   => true,
            'file_path' => $relPath,
        ]);
    }



    public function getUploadedFile(Request $request)
    {
        $mediaData = $request->session()->get('payment_media');

        if ($mediaData) {
            return response()->json([
                'success' => true,
                'data' => $mediaData
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No file found in session'
        ]);
    }

    public function clearUploadedFile(Request $request)
    {
        $media = $request->session()->pull('payment_media');

        if ($media) {
            $media = is_array(reset($media)) ? $media : [$media];

            foreach ($media as $item) {
                $relPath  = $item['file_path'];
                $fullPath = public_path($relPath);

                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }
        }

        return response()->json(['success' => true]);
    }


    public function selectPackage(Request $request)
    {
        $request->validate([
            'views' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $request->session()->forget('selected_package');

        $request->session()->put('selected_package', [
            'views' => (int) $request->views,
            'price' => (float) $request->price,
        ]);

        return redirect()->route('payment.index');
    }
}
