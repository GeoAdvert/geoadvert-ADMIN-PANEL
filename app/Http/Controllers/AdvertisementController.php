<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\User;
use App\Models\QuizAns;
use Illuminate\Http\Request;
use App\Models\ViewAdvertisement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdvertisementController extends Controller
{


    public function myedit($id)
    {
        // dd($id);
        $ads = Advertisement::where('id', $id)->get();

        foreach ($ads as $ad) {
            $ad->delete();

            $imgPath = public_path("media/") . $ad->fileName;
            if (file_exists($imgPath)) {
                @unlink($imgPath);
            }
        }

        if ($ads->isEmpty()) {
            return response()->json([
                'message' => 'ID not found',
                'data' => $id
            ], 500);
        }

        return response()->json([
            'message' => 'Deleted',
            'data' => $id
        ]);
    }

    public function index()
    {
        $advertisement = Advertisement::with(['tablet' , 'advertisementView'])->get();
        return view('ads-management', compact('advertisement'));
    }

    public function add()
    {
        $selectedTab = old('tabName', '');
        $tablet = User::role('tablet')->get();
        return view('ads-management-add', compact('tablet', 'selectedTab'));
    }
    public function addAds(Request $request)
    {

        // dd($request->all());
        $tablet = User::role('tablet')->get();

        $user = User::find($request->tabName);
        if (!$user) {
            return redirect()->back()->with(['error' => 'User not found']);
        }

        $request->validate([
            'tabName' => 'required',
            'radius' => 'required|numeric|between:1,99.99',
            'videoDuration' => 'required|numeric|min:1000',
            'latitude' => 'numeric|between:-90,90|nullable',
            'longitude' => 'numeric|between:-180,180|nullable',
            'status' => 'required',
            'type' => 'required',
            'start_time' => 'nullable',
            'end_time' => [
                'required_with:start_time',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->start_time && $value <= $request->start_time) {
                        $fail('End time must be after the start time.');
                    }
                },
            ],
            'views' => 'required|numeric',
            'tag' => [
            'required',
            'regex:/^\S*$/u'  // No whitespace allowed
            ]
        ,
            'display_frequency' => 'required|numeric|min:1000',
            'fileType' => 'required',
            'fileName' => [
                'required',
                'max:30720', // 30MB
                Rule::when($request->fileType === 'image', 'mimes:png,jpg,jpeg'),
                Rule::when($request->fileType === 'video', 'mimes:mp4,mov,webm'),
            ],
        ], [
            'tabName.required' => 'The Tab Name is required.',
            'radius.required' => 'The Radius is required.',
            'radius.numeric' => 'The Radius must be a number.',
            'radius.between' => 'The Radius must be between 1 and 99.99.',
            'videoDuration.required' => 'The Video Duration is required.',
            'videoDuration.numeric' => 'The Video Duration must be a number.',
            'videoDuration.min' => 'The Video Duration must be at least 1000 ms.',
            'latitude.numeric' => 'The latitude must be a number.',
            'latitude.between' => 'The latitude must be between 0 and 99.99.',
            'longitude.numeric' => 'The longitude must be a number.',
            'longitude.between' => 'The longitude must be between 0 and 99.99.',
            'status.required' => 'The status is required.',
            'tag.regex' => "The tag may not contain any whitespace characters.",
            'fileName.max' => 'The File size must be less than 30MB.',
            'fileType.required' => 'The file type is required.',
            'fileName.required' => 'No file selected. Please upload a file.',
            'end_time.after' => 'End time must be after the start time.',
            'end_time.required_if' => 'End time is required when start time is provided.',
            'display_frequency.required' => 'The display frequency is required.',
            'display_frequency.numeric' => 'The display frequency must be a number.',
            'display_frequency.min' => 'The display frequency must be at least 1000 ms.',
            'fileName.mimes' => 'You selected ' . $request->fileType . ' input field so only ' . ($request->fileType === 'image' ? 'jpg, png, and jpeg' : 'mp4, mov and webm') . ' files are allowed.',
        ]);

        $file = $request->file('fileName');
        $fileName = time() . $file->getClientOriginalName();
        $path = 'storage/media/';
        $file->move($path, $fileName);
        // dd($request->display_frequency);
        Advertisement::create([
            'tab_Id' => $user->id,
            'radius' => $request->radius,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'videoDuration' => $request->videoDuration,
            'locationBased' => (bool)$request->locationBased,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => $request->status,
            'tag' => $request->tag,
            'type' => $request->type,
            'views' => $request->views,
            'display_frequency' => $request->display_frequency,
            'fileType' => $request->fileType,
            'fileName' => $fileName,
        ]);

        return redirect()->route('adsmanagement')->with(['success' =>  'Advertisement added successfully!']);
    }


    public function edit($id)
    {

        $tablets = User::role('tablet')->get();
        $advertisements = Advertisement::find($id);
        // dd($advertisements);
        if ($advertisements != null) {
            return view('ads-management-edit', compact('advertisements', 'tablets'));
        }

        return redirect()->route('adsmanagement')->with(['error' => 'Advertisement not found']);
    }

    public function editAds(Request $request, $id)
    {
        $user = User::find($request->tabName);
        if (!$user) {
            return redirect()->back()->with(['error' => 'User not found']);
        }

        $viewAdvertisement = ViewAdvertisement::where('advertisment_id' , $id)->get();

        if(count($viewAdvertisement) > $request->views){
            return redirect()->back()->with('error' , "View count cannot be lower than the times the ad has been played.");
        }


        $request->validate([
            'tabName' => 'required',
            'radius' => 'required|numeric|between:1,99.99',
            'videoDuration' => 'required|numeric|min:1000',
            'latitude' => 'numeric|between:-90,90|nullable',
            'longitude' => 'numeric|between:-180,180|nullable',
            'type' => 'required',
            'status' => 'required',
            'start_time' => 'nullable',
            'end_time' => [
                'required_with:start_time',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->start_time && $value <= $request->start_time) {
                        $fail('End time must be after the start time.');
                    }
                },
            ],
            'views' => 'required|numeric',
            'tag' => [
            'required',
            'regex:/^\S*$/u'  // No whitespace allowed
            ]
        ,
            'display_frequency' => 'required|numeric|min:1000',
            'fileType' => 'required',
            'fileName' => [
                'max:30720', // 5MB
                Rule::when($request->fileType === 'image', 'mimes:png,jpg,jpeg'),
                Rule::when($request->fileType === 'video', 'mimes:mp4,mov,webm'),
            ],
        ], [
            'tabName.required' => 'The Tab Name is required.',
            'radius.required' => 'The Radius is required.',
            'radius.numeric' => 'The Radius must be a number.',
            'radius.between' => 'The Radius must be between 1 and 99.99.',
            'videoDuration.required' => 'The Video Duration is required.',
            'videoDuration.numeric' => 'The Video Duration must be a number.',
            'videoDuration.min' => 'The Video Duration must be at least 1000 ms.',
            'latitude.numeric' => 'The latitude must be a number.',
            'latitude.between' => 'The latitude must be between 0 and 99.99.',
            'longitude.numeric' => 'The longitude must be a number.',
            'longitude.between' => 'The longitude must be between 0 and 99.99.',
            'status.required' => 'The status is required.',

            'end_time.required_if' => 'End time is required when start time is provided.',
            'end_time.after' => 'End time must be after the start time.',
            'tag.regex' => "The tag may not contain any whitespace characters.",
            'fileName.max' => 'The File size must be less than 30MB',
            'fileType.required' => 'The file type is required.',
            'fileName.required' => 'No file selected. Please upload a file.',
            'display_frequency.required' => 'The display frequency is required.',
            'display_frequency.numeric' => 'The display frequency must be a number.',
            'display_frequency.min' => 'The display frequency must be at least 1000 ms.',
            'fileName.mimes' => 'You selected ' . $request->fileType . ' input field so only ' . ($request->fileType === 'image' ? 'jpg, png, and jpeg' : 'mp4, mov and webm') . ' files are allowed.',
        ]);

        $advertisements = Advertisement::find($id);

        // foreach ($tablet as $tab) {
        //     $tabname = $tab->name;
        //     $selectname = $request->tabName;
        //     if ($tabname == $selectname) {
        //         $tabid = $tab->id;
        // dd($tabid);
        if ($request->file('fileName')) {
            // $imgPath = storage_path("media/") . $advertisements->fileName;
            // dd($imgPath);
            // unlink($imgPath);
            $filePath = 'media/' . $advertisements->fileName;
            Storage::disk('public')->delete($filePath);

            $files = $request->file('fileName');
            $fileName = time() . $files->getClientOriginalName();
            $path = 'storage/media/';
            $files->move($path, $fileName);
        }
        if ($advertisements) {
            $advertisements->update([
                'tab_Id' => $user->id,
                'radius' => $request->radius,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'videoDuration' => $request->videoDuration,
                'locationBased' => (bool)$request->locationBased,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => $request->status,
                'type' => $request->type,
                'tag' => $request->tag,
                'views' => $request->views,
                'display_frequency' => $request->display_frequency,
                'fileType' => $request->fileType,
                'fileName' => $fileName ?? $advertisements->fileName,
            ]);
            return redirect('ads-management')->with(['success'=> 'Advertisement Updated successfully!']);
        } else {
            return redirect()->route('adsmanagement');
        }
        // }
        // }
    }

    public function delete($id)
    {
        $ads = Advertisement::find($id);

        $assignedQuizAns = QuizAns::whereRaw("FIND_IN_SET(?, advertisement_id)", [$id])->first();

        if ($assignedQuizAns) {
            return redirect()->back()->with('error', 'This advertisement is assigned to a quiz. Please replace it before deleting.');
        }

        $ads->delete();

        $imgPath = public_path("storage/media/") . $ads->fileName;
        if (file_exists($imgPath)) {
            @unlink($imgPath);
        }

        return redirect()->back()->with('success', 'Advertisement Deleted Successfully!');
    }

}
