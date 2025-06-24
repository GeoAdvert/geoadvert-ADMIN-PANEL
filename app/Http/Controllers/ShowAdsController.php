<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ViewAdvertisement;
use App\Models\Quiz;
use App\Models\IndependentAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ShowAdsController extends Controller
{
    public function views(Request $request)
    {
        $advertisement = Advertisement::where('id', $request->id)->first();

        if ($advertisement) {
            $viewAdvertisement = ViewAdvertisement::create([
                'advertisment_id' => $request->id,
            ]);

            return response()->json([
                'status' => 201,
                'success' => true,
                'message' => 'View created',
            ], 201);
        } else {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => '404 not found',
            ], 404);
        }
    }

    public function getLocation(Request $request)
    {
        $currentLocation = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        $adQuery = Advertisement::query();

        if ($request->has('advertisement_id')) {
            $advertisementIds = explode(',', $request->advertisement_id);
            $adQuery->whereIn('id', $advertisementIds);
        } else {
            $adQuery->whereNotExists(function ($query) {
                $query->selectRaw(1)
                    ->from('quiz_ans')
                    ->whereRaw("FIND_IN_SET(advertisements.id, quiz_ans.advertisement_id)");
            });
        }

        $ads = $adQuery->with('advertisementView')->get();

        $ads->transform(function ($ad) {
            $ad->imageURL = !empty($ad->fileName)
                ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
                : null;
            return $ad;
        });

        $ads = $ads->filter(function ($ad) {
            $viewCount = $ad->advertisementView->count();
            $viewLimit = $ad->views;
            return $viewCount < $viewLimit;
        });

        $sortedAds = $this->getAdDisplayOrder($ads, $currentLocation);

        if (!$sortedAds['isLocationBased']) {
            $advertisementIds = $request->has('advertisement_id') ? explode(',', $request->advertisement_id) : [];

            $sortedAds['adsdata'] = Advertisement::where('locationBased', false)
                ->when(!empty($advertisementIds), function ($query) use ($advertisementIds) {
                    return $query->whereIn('id', $advertisementIds);
                }, function ($query) {
                    return $query->whereNotExists(function ($query) {
                        $query->selectRaw(1)
                            ->from('quiz_ans')
                            ->whereRaw("FIND_IN_SET(advertisements.id, quiz_ans.advertisement_id)");
                    });
                })
                ->with(['advertisementView'])
                ->get()
                ->map(function ($ad) {
                    $ad->imageURL = !empty($ad->fileName)
                        ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
                        : null;
                    return $ad;
                });

            $sortedAds['adsdata'] = $sortedAds['adsdata']->filter(function ($ad) {
                $viewCount = $ad->advertisementView->count();
                $viewLimit = $ad->views;
                return ($ad->latitude === null && $ad->longitude === null && $viewCount < $viewLimit);
            });

            $sortedAds['adsdata'] = $sortedAds['adsdata']->sortByDesc('created_at')->values();

            $sortedAds['adsdata'] = $sortedAds['adsdata']->map(function ($ad) {
                if (!empty($ad->fileName)) {
                    $ad->imageURL = "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName;
                }
                return $ad;
            });
        }

        $currentTime = Carbon::now('Asia/Karachi')->format('H:i:s');

        $sortedAds['adsdata'] = collect($sortedAds['adsdata'])->filter(function ($ad) use ($currentTime) {
            if (!empty($ad->start_time) && !empty($ad->end_time)) {
                return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
            }
            return true;
        })->values();


        $groupedAds = $sortedAds['adsdata']->groupBy('type');

        $uniqueAds = collect();
        foreach ($groupedAds as $group) {
            $uniqueAds->push($group->sortBy('created_at')->first());
        }

        $sortedAds['adsdata'] = $uniqueAds->sortBy('distance')->values();


        return response()->json([
            'message' => 'Location data received successfully',
            'data' => $sortedAds['adsdata'],
            'isLocationBased' => $sortedAds['isLocationBased']
        ]);
    }




    public function index()
    {
        $userId = auth()->id();
        $ads = Advertisement::where('locationBased', false)->take(0);
        $quizzes = Quiz::with(['answers'])->get();
        $independentAd = IndependentAd::where('id', 1)->first();
        return view('users.video', compact('ads', 'quizzes', 'independentAd'));
    }

    // Function to calculate distance between two coordinates using the Haversine formula
    function calculateDistance($latitude1, $longitude1, $latitude2, $longitude2)
    {
        $earthRadius = 6371; // Earth's radius in km
        $dLat = deg2rad($latitude2 - $latitude1);
        $dLon = deg2rad($longitude2 - $longitude1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    // Function to determine if a location is within a specified radius
    function isWithinRadius($adLocation, $currentLocation)
    {
        $distance = $this->calculateDistance(
            $adLocation['latitude'],
            $adLocation['longitude'],
            $currentLocation['latitude'],
            $currentLocation['longitude']
        );

        return $distance <= $adLocation['radius'];
    }

    // Algorithm to determine ad display order
    function getAdDisplayOrder($ads, $currentLocation)
    {
        $adsWithDistance = [];
        $adsWithoutLocation = [];

        foreach ($ads as $ad) {
            if ($ad->latitude && $ad->longitude) {
                $distance = $this->calculateDistance(
                    $ad->latitude,
                    $ad->longitude,
                    $currentLocation['latitude'],
                    $currentLocation['longitude']
                );
                $ad->distance = $distance;
                $adsWithDistance[] = $ad;
            } else {
                $adsWithoutLocation[] = $ad;
            }
        }

        // Sort ALL ads with coordinates by distance
        usort($adsWithDistance, function ($a, $b) {
            return $a->distance <=> $b->distance;
        });

        // Final order: Sorted by distance + ads without location
        $adsdata = array_merge($adsWithDistance, $adsWithoutLocation);

        return [
            'adsdata' => $adsdata,
            'isLocationBased' => !empty($adsWithDistance)
        ];
    }

    public function allAds()
    {
        $ads = Advertisement::with('advertisementView')->get();

        $baseImageUrl = 'https://sty1.devmail-sty.online/ad_display/public/storage/media/';

        // Append imageURL using fileName
        $ads->transform(function ($ad) use ($baseImageUrl) {
            $ad->imageURL = $ad->fileName
                ? $baseImageUrl . $ad->fileName
                : null;

            return $ad;
        });

        return response()->json([
            'status' => 201,
            'success' => true,
            'data' => $ads
        ]);
    }
}
