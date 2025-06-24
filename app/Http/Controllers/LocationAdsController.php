<?php

namespace App\Http\Controllers;

use App\Models\LocationAds;
use Illuminate\Http\Request;

class LocationAdsController extends Controller
{
    public function index()
    {
        // return view('geo-target-ads');
        $advertisement = LocationAds::paginate(10);
        return view('geo-target-ads', compact('advertisement'));
    }
    public function add()
    {
        return view('geo-target-ads-add');
    }

    public function addAds(Request $request)
    {

                $request->validate([
                    'latitude'=>'required',
                    'longitude'=>'required',
                    'fileName.*' => 'required|mimes:png,jpg,jpeg,mp4|max:2000',
                ]);
                $mediaData = [];
                if ($files = $request->file('fileName')) {
                    foreach ($files as $file) {
                        $fileName = time() . $file->getClientOriginalName();
                        $path = 'media/';
                        $file->move($path, $fileName);
                        $mediaData[] = [
                            'latitude'=>$request->latitude,
                            'longitude'=>$request->longitude,
                            'fileName' => $fileName,
                        ];
                    }
                }
                LocationAds::insert($mediaData);
                return redirect('geo-target-ads')->with(['status' => 'Advertisement Added successfully!']);
          
       
    }


    public function edit($id)
    {
        $advertisements = LocationAds::find($id);

        if ($advertisements !=null) {
            return view('geo-target-ads-edit', compact('advertisements'));
        }
        return redirect()->route('geotargetads')->with(['error' => 'Advertisement not found']);
    }

    public function editAds(Request $request, $id)
    {
        $advertisements = LocationAds::find($id);

        if ($advertisements !=null) {
            if( $file = $request->file('fileName')){
                
                $fileName = time() . $file->getClientOriginalName();
                $path = 'media/';
                $file->move($path, $fileName);
                $advertisements->update([
                    'latitude'=>$request->latitude,
                    'longitude'=>$request->longitude,
                    'fileName' => $fileName,
                ]);
                
                return redirect()->route('geotargetads')->with(['Status' => 'Advertisement Updated']);
            }
        }
        return redirect()->route('geotargetads')->with(['error' => 'Advertisement not found']);
    }
    

    public function delete($id)
    {
        $ads = LocationAds::find($id);
// dd($ads);
       if($ads!=null){
        $ads->delete();

        $imgPath = public_path("media/") . $ads->fileName;
        if (file_exists($imgPath)) {
            @unlink($imgPath);
        }


    return redirect()->back()->with(['status' => 'Advertisement Deleted']);
       }
       else
       return redirect()->back()->with(['status' => 'Advertisement Not Deleted']);
    }

}
