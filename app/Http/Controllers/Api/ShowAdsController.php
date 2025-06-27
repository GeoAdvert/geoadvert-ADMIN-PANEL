<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViewAdvertisement;
use Illuminate\Support\Facades\Storage;
use App\Models\Quiz;
use App\Models\IndependentAd;
use App\Models\Advertisement;
use DB;
use Carbon\Carbon;

class ShowAdsController extends Controller
{
    public function views(Request $request)
    {
        $advertisement = Advertisement::where('id', $request->id)->first();

        if ($advertisement) {
            // Check current view count
            $currentViewCount = ViewAdvertisement::where('advertisment_id', $request->id)->count();

            // Check if views limit has been reached
            if ($currentViewCount >= $advertisement->views) {
                // return response()->json([
                //     'status' => 400,
                //     'success' => false,
                //     'message' => 'Advertisement view limit has been reached',
                //     'current_views' => $currentViewCount,
                //     'view_limit' => $advertisement->views
                // ], 400);
                return response()->json([
                    'status' => 201,
                    'success' => true,
                    'message' => 'View created',
                    // 'current_views' => $currentViewCount + 1,
                    // 'view_limit' => $advertisement->views,
                    // 'remaining_views' => $advertisement->views - ($currentViewCount + 1)
                ], 201);
            }

            // Create new view if limit not reached
            $viewAdvertisement = ViewAdvertisement::create([
                'advertisment_id' => $request->id,
            ]);

            return response()->json([
                'status' => 201,
                'success' => true,
                'message' => 'View created',
                // 'current_views' => $currentViewCount + 1,
                // 'view_limit' => $advertisement->views,
                // 'remaining_views' => $advertisement->views - ($currentViewCount + 1)
            ], 201);
        } else {
            return response()->json([
                'status' => 404,
                'success' => false,
                'message' => '404 not found',
            ], 404);
        }
    }
    public function viewsBulk(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json([
                'status' => 400,
                'success' => false,
                'message' => 'No advertisement IDs provided or invalid format',
            ], 400);
        }

        // Fetch all relevant advertisements in one query
        $advertisements = Advertisement::whereIn('id', $ids)->get()->keyBy('id');

        // Fetch current view counts in one query
        $viewCounts = ViewAdvertisement::whereIn('advertisment_id', $ids)
            ->selectRaw('advertisment_id, COUNT(*) as count')
            ->groupBy('advertisment_id')
            ->pluck('count', 'advertisment_id');

        $responses = [];
        $viewsToInsert = [];

        foreach ($ids as $id) {
            $ad = $advertisements->get($id);

            if (!$ad) {
                $responses[] = [
                    'id' => $id,
                    'status' => 404,
                    'success' => false,
                    'message' => 'Advertisement not found',
                ];
                continue;
            }

            $currentViews = $viewCounts->get($id, 0);

            if ($currentViews >= $ad->views) {
                $responses[] = [
                    'id' => $id,
                    'status' => 200,
                    'success' => true,
                    'message' => 'View limit reached, not incremented',
                ];
            } else {
                $viewsToInsert[] = ['advertisment_id' => $id, 'created_at' => now(), 'updated_at' => now()];

                $responses[] = [
                    'id' => $id,
                    'status' => 201,
                    'success' => true,
                    'message' => 'View created',
                ];
            }
        }

        // Bulk insert all new views at once
        if (!empty($viewsToInsert)) {
            ViewAdvertisement::insert($viewsToInsert);
        }

        return response()->json($responses, 200);
    }
    public function quiz()
    {
        $quizzes = Quiz::with(['answers' => function ($query) {
            $query->inRandomOrder();
        }])->get();

        $independentAd = IndependentAd::where('id', 1)->first();

        return response()->json([
            'status' => 200,
            'quizzes' => $quizzes,
            'independentAd' => $independentAd,
        ]);
    }



    // public function ads(Request $request)
    // {
    //     $currentLocation = [
    //         'latitude' => $request->latitude,
    //         'longitude' => $request->longitude,
    //     ];

    //     // Get quiz-assigned advertisement IDs (dependent ads)
    //     $quizAdsIds = DB::table('quiz_ans')
    //         ->pluck('advertisement_id')
    //         ->flatMap(function ($ids) {
    //             return explode(',', $ids);
    //         })
    //         ->map(function ($id) {
    //             return (int) $id;
    //         })
    //         ->unique()
    //         ->toArray();

    //     $adQuery = Advertisement::query();

    //     if ($request->has('advertisement_id')) {
    //         $advertisementIds = explode(',', $request->advertisement_id);
    //         $adQuery->whereIn('id', $advertisementIds);
    //     } else {
    //         // Don't exclude any ads initially - we'll handle independent/dependent logic separately
    //         $adQuery->where('status', 'active'); // Assuming you want only active ads
    //     }

    //     $ads = $adQuery->with('advertisementView')->get();

    //     // Separate independent and dependent ads
    //     $independentAds = collect();
    //     $dependentAds = collect();

    //     foreach ($ads as $ad) {
    //         // Set imageURL for all ads
    //         $ad->imageURL = !empty($ad->fileName)
    //             ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
    //             : null;

    //         // Check if ad is independent (not in quiz)
    //         $isIndependent = !in_array($ad->id, $quizAdsIds);

    //         if ($isIndependent) {
    //             $independentAds->push($ad);
    //         } else {
    //             $dependentAds->push($ad);
    //         }
    //     }

    //     // Filter independent ads - only by view limits (ignore type and location)
    //     $filteredIndependentAds = $independentAds->filter(function ($ad) {
    //         $viewCount = $ad->advertisementView->count();
    //         $viewLimit = $ad->views;
    //         return $viewCount < $viewLimit;
    //     });

    //     // Filter dependent ads - only if advertisement_id is provided
    //     $filteredDependentAds = collect();
    //     $sortedDependentAds = ['adsdata' => collect(), 'isLocationBased' => false];

    //     if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
    //         // Only process dependent ads if advertisement_id is provided
    //         $filteredDependentAds = $dependentAds->filter(function ($ad) {
    //             $viewCount = $ad->advertisementView->count();
    //             $viewLimit = $ad->views;
    //             return $viewCount < $viewLimit;
    //         });

    //         // Apply location-based sorting for dependent ads only
    //         $sortedDependentAds = $this->getAdDisplayOrder($filteredDependentAds, $currentLocation);
    //     }

    //     // Handle non-location-based dependent ads with current logic (only if advertisement_id provided)
    //     if ($request->has('advertisement_id') && !empty($request->advertisement_id) && !$sortedDependentAds['isLocationBased']) {
    //         $advertisementIds = $request->has('advertisement_id') ? explode(',', $request->advertisement_id) : [];

    //         $sortedDependentAds['adsdata'] = Advertisement::where('locationBased', false)
    //             ->whereIn('id', $quizAdsIds) // Only dependent ads
    //             ->when(!empty($advertisementIds), function ($query) use ($advertisementIds) {
    //                 return $query->whereIn('id', $advertisementIds);
    //             })
    //             ->with(['advertisementView'])
    //             ->get()
    //             ->map(function ($ad) {
    //                 $ad->imageURL = !empty($ad->fileName)
    //                     ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
    //                     : null;
    //                 return $ad;
    //             })
    //             ->filter(function ($ad) {
    //                 $viewCount = $ad->advertisementView->count();
    //                 $viewLimit = $ad->views;
    //                 return ($ad->latitude === null && $ad->longitude === null && $viewCount < $viewLimit);
    //             })
    //             ->sortByDesc('created_at')
    //             ->values();
    //     }

    //     // Apply time filtering to independent ads
    //     $currentTime = Carbon::now('America/New_York')->format('H:i:s');

    //     $filteredIndependentAds = $filteredIndependentAds->filter(function ($ad) use ($currentTime) {
    //         if (!empty($ad->start_time) && !empty($ad->end_time)) {
    //             return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
    //         }
    //         return true;
    //     });

    //     // Apply time filtering to dependent ads (only if they exist)
    //     if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
    //         $sortedDependentAds['adsdata'] = collect($sortedDependentAds['adsdata'])->filter(function ($ad) use ($currentTime) {
    //             if (!empty($ad->start_time) && !empty($ad->end_time)) {
    //                 return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
    //             }
    //             return true;
    //         })->values();
    //     }

    //     // Group dependent ads by type and get unique ads per type (only if advertisement_id provided)
    //     $uniqueDependentAds = collect();

    //     if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
    //         $groupedDependentAds = collect($sortedDependentAds['adsdata'])->groupBy('type');

    //         foreach ($groupedDependentAds as $group) {
    //             $uniqueDependentAds->push($group->sortBy('created_at')->first());
    //         }
    //     }

    //     // For independent ads, don't group by type - show all that pass filters
    //     $sortedIndependentAds = $filteredIndependentAds->sortBy('distance')->values();

    //     // Combine independent ads (higher priority) with dependent ads
    //     $finalAds = $sortedIndependentAds->merge($uniqueDependentAds->sortBy('distance')->values());

    //     return response()->json([
    //         'message' => 'Location data received successfully',
    //         'data' => $finalAds,
    //         'isLocationBased' => $sortedDependentAds['isLocationBased'],
    //         'independent_ads_count' => $sortedIndependentAds->count(),
    //         'dependent_ads_count' => $uniqueDependentAds->count()
    //     ]);
    // }



    public function ads(Request $request)
    {
        $currentLocation = [
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ];

        // dd($request->all());
        // Get quiz-assigned advertisement IDs (dependent ads)
        $quizAdsIds = DB::table('quiz_ans')
            ->pluck('advertisement_id')
            ->flatMap(function ($ids) {
                return explode(',', $ids);
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->toArray();

        $adQuery = Advertisement::query();

        if ($request->has('advertisement_id')) {
            $advertisementIds = explode(',', $request->advertisement_id);
            $adQuery->whereIn('id', $advertisementIds);
        } else {
            // Don't exclude any ads initially - we'll handle independent/dependent logic separately
            $adQuery->where('status', 'active'); // Assuming you want only active ads
        }

        $ads = $adQuery->with('advertisementView')->get();

        // Separate independent and dependent ads
        $independentAds = collect();
        $dependentAds = collect();

        foreach ($ads as $ad) {
            // Set imageURL for all ads
            $ad->imageURL = !empty($ad->fileName)
                ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
                : null;

            // Check if ad is independent (not in quiz)
            $isIndependent = !in_array($ad->id, $quizAdsIds);

            if ($isIndependent) {
                $independentAds->push($ad);
            } else {
                $dependentAds->push($ad);
            }
        }


        // Filter independent ads - only by view limits (ignore type and location)
        $filteredIndependentAds = $independentAds->filter(function ($ad) {
            $viewCount = $ad->advertisementView->count();
            $viewLimit = $ad->views;
            return $viewCount < $viewLimit;
        });



        // Filter dependent ads - only if advertisement_id is provided
        $filteredDependentAds = collect();
        $sortedDependentAds = ['adsdata' => collect(), 'isLocationBased' => false];

        if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
            // Only process dependent ads if advertisement_id is provided
            $filteredDependentAds = $dependentAds->filter(function ($ad) {
                $viewCount = $ad->advertisementView->count();
                $viewLimit = $ad->views;
                return $viewCount < $viewLimit;
            });

            // Apply location-based sorting for dependent ads only
            $sortedDependentAds = $this->getAdDisplayOrder($filteredDependentAds, $currentLocation);
        }
        // dd($sortedDependentAds);


        // Handle non-location-based dependent ads with current logic (only if advertisement_id provided)
        if ($request->has('advertisement_id') && !empty($request->advertisement_id) && !$sortedDependentAds['isLocationBased']) {
            $advertisementIds = $request->has('advertisement_id') ? explode(',', $request->advertisement_id) : [];

            $sortedDependentAds['adsdata'] = Advertisement::where('locationBased', false)
                ->whereIn('id', $quizAdsIds) // Only dependent ads
                ->when(!empty($advertisementIds), function ($query) use ($advertisementIds) {
                    return $query->whereIn('id', $advertisementIds);
                })
                ->with(['advertisementView'])
                ->get()
                ->map(function ($ad) {
                    $ad->imageURL = !empty($ad->fileName)
                        ? "https://sty1.devmail-sty.online/ad_display/public/storage/media/" . $ad->fileName
                        : null;
                    return $ad;
                })
                ->filter(function ($ad) {
                    $viewCount = $ad->advertisementView->count();
                    $viewLimit = $ad->views;
                    return ($ad->latitude === null && $ad->longitude === null && $viewCount < $viewLimit);
                })
                ->sortByDesc('created_at')
                ->values();
        }


        // Apply time filtering to independent ads
        $currentTime = Carbon::now('America/New_York')->format('H:i:s');



        // Apply time filtering to dependent ads (only if they exist)
        if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
            $sortedDependentAds['adsdata'] = collect($sortedDependentAds['adsdata'])->filter(function ($ad) use ($currentTime) {
                if (!empty($ad->start_time) && !empty($ad->end_time)) {
                    return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
                }
                return true;
            })->values();
        }



        // Group dependent ads by type and get unique ads per type (only if advertisement_id provided)
        $uniqueDependentAds = collect();

        if ($request->has('advertisement_id') && !empty($request->advertisement_id)) {
            $groupedDependentAds = collect($sortedDependentAds['adsdata'])->groupBy('type');

            foreach ($groupedDependentAds as $group) {
                $uniqueDependentAds->push($group->sortBy('created_at')->first());
            }
        }

        // $filteredIndependentAds = $filteredIndependentAds->filter(function ($ad) use ($currentTime) {
        //     if (!empty($ad->start_time) && !empty($ad->end_time)) {
        //         return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
        //     }
        //     return true;
        // });

        // For independent ads, don't group by type - show all that pass filters
        $sortedIndependentAds = $filteredIndependentAds->sortBy('distance')->values();


        $sortedIndependentAds = collect($this->getAdDisplayOrder($sortedIndependentAds, $currentLocation)['adsdata']);
        // dd($sortedIndependentAds->toArray(),$uniqueDependentAds->toArray());

        // dd($sortedIndependentAds->toArray());


        // $sortedIndependentAds = $sortedIndependentAds->filter(function ($ad) {
        //     return $ad['distance'] <= $ad['radius'];
        // })->values();

        $sortedIndependentAds = $sortedIndependentAds->filter(function ($ad) use ($currentTime) {
            // Always include if within radius
            if ($ad->distance <= $ad->radius) {
                return true;
            }

            // Otherwise, only include if within time window
            if (!empty($ad->start_time) && !empty($ad->end_time)) {
                return ($currentTime >= $ad->start_time && $currentTime <= $ad->end_time);
            }

            // If no time window, exclude if out of radius
            return false;
        });

        // Combine independent ads (higher priority) with dependent ads
        $finalAds = $sortedIndependentAds->merge($uniqueDependentAds->sortBy('distance')->values());
        // dd($finalAds->toArray());

        return response()->json([
            'message' => 'Location data received successfully',
            'data' => $finalAds,
            'isLocationBased' => $sortedDependentAds['isLocationBased'],
            'independent_ads_count' => $sortedIndependentAds->count(),
            'dependent_ads_count' => $uniqueDependentAds->count()
        ]);
    }



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
        $adsWithLocation = [];
        $adsWithoutLocation = [];

        foreach ($ads as $ad) {
            if ($ad->latitude && $ad->longitude) {
                // If latitude and longitude are present, calculate the distance
                $distance = $this->calculateDistance(
                    $ad->latitude,
                    $ad->longitude,
                    $currentLocation['latitude'],
                    $currentLocation['longitude']
                );
                $ad->distance = $distance;
                $adsWithLocation[] = $ad;
            } else {
                // If latitude and longitude are null, just add it to the adsWithoutLocation array
                $adsWithoutLocation[] = $ad;
            }
        }

        // Sort ads with coordinates by distance
        usort($adsWithLocation, function ($a, $b) {
            return $a->distance <=> $b->distance;
        });

        // Sort ads without location by created_at in descending order
        usort($adsWithoutLocation, function ($a, $b) {
            // Compare by created_at in descending order
            return strtotime($b->created_at) <=> strtotime($a->created_at);
        });

        // Final order: Sorted by distance + ads without location sorted by created_at
        $adsdata = array_merge($adsWithLocation, $adsWithoutLocation);

        return [
            'adsdata' => $adsdata,
            'isLocationBased' => !empty($adsWithLocation)
        ];
    }



    public function allAds()
    {
        $ads = Advertisement::with('advertisementView')->get();

        $quizAnsAds = DB::table('quiz_ans')
            ->pluck('advertisement_id')
            ->flatMap(function ($ids) {
                return explode(',', $ids);
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->toArray();

        $baseImageUrl = 'https://sty1.devmail-sty.online/ad_display/public/storage/media/';

        $ads->transform(function ($ad) use ($baseImageUrl, $quizAnsAds) {
            $ad->imageURL = $ad->fileName
                ? $baseImageUrl . $ad->fileName
                : null;

            // Corrected logic: 
            // If ad IS in quiz (dependent) → isDependent = true
            // If ad is NOT in quiz (independent) → isDependent = false
            $ad->isDependent = in_array($ad->id, $quizAnsAds);

            // Or if you want to keep both properties:
            $ad->independent_ad = !in_array($ad->id, $quizAnsAds); // true if independent
            $ad->dependent_ad = in_array($ad->id, $quizAnsAds);    // true if dependent

            $totalAdView = $ad->advertisementView->sum('views');

            if ($totalAdView >= (int)$ad->views) {
                $ad->display_ad = false;
            } else {
                $ad->display_ad = true;
            }

            return $ad;
        });

        $adsToDisplay = $ads->filter(function ($ad) {
            return $ad->display_ad === true;
        });

        return response()->json([
            'status' => 201,
            'success' => true,
            'data' => $adsToDisplay
        ]);
    }
}
