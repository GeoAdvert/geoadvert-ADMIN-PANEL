<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use App\Models\Advertisement;

class TabletsController extends Controller
{

    public function index(){
        $tablet = User::role('tablet')->get();
        return view('dashboard',compact('tablet'));
    }

    public function addTab(Request $request){
        // dd('dd');
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password'=> 'required|min:8',
            'confirmPassword'=> 'required|same:password',
        ]);

        $mytab=User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'hashedPassword'=>$request->password,
        ]);
        $mytab->assignRole('tablet');
        return redirect()->route('dashboard')->with(['success' => 'User Added Successfully']);
    }

    public function edit($id){
        $tablet = User::find($id);
        if($tablet){
            return view('edit-tabs', compact('tablet'));
        }
        return redirect()->route('dashboard')->with(['error' => 'User not found']);
    }

    public function editTab(Request $request, $id){

        $tablet = User::findOrFail($id);

      $rules = [
    'name' => 'required|string',
    'email' => [
        'required',
        'email',
        Rule::unique('users')->ignore($tablet->id),
    ],
];

        if ($request->newPassword) {

            $rules['oldPassword'] = 'required|string|min:8';
            $rules['newPassword'] = 'required|min:8';
        }

        $validatedData = $request->validate($rules);

        if ($request->newPassword != null && $request->oldPassword != $tablet->hashedPassword) {

            // dd("incorrect old password");
            return redirect()->back()->with(['error'=> 'The old password is incorrect.']);
            // return redirect()->back()->with('oldPassword' , 'The old password is incorrect.');
        }

       $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->newPassword) {
            $data['password'] = Hash::make($request->newPassword);
            $data['hashedPassword'] = $request->newPassword;

        }

        User::where('id',$id)->update($data);

        return redirect('dashboard')->with(['success' => 'User Profile Updated Successfully!']);
    }

    public function delete( $id){
        $tablet = User::findOrFail($id);
        $ads_video = Advertisement::where('tab_id',$tablet->id)->get();
        foreach($ads_video as $ads){
        $imgPath = public_path("storage/media/") . $ads->fileName;
            if (file_exists($imgPath)) {
                @unlink($imgPath);
            }
            $ads->delete();
        }
        $tablet->delete();
        return redirect()->back()->with(['success' => 'User Deleted Successfully!']);
    }
}























// public function edit($id){
//     $tablet = User::find($id);
//     if($tablet){
//     return view('edit-tabs',compact('tablet'));
//     }
//     return redirect()->route('dashboard')->with(['error' => 'tablet not found']);
// }
// public function editTab(Request $request ,$id){
//     $tablet = User::findOrFail($id);
//     $request->validate([
//         'name' => 'required|string',
//         'email' => 'required|email',
//         'oldPassword' => 'required|string',
//         'newPassword'=> 'required|min:6',
//     ]);

//     if ($request->oldPassword != $tablet->hashedPassword) {
//         return redirect()->back()->withErrors(['oldPassword' => 'The old password is incorrect.']);
//     }

// //     if (!Hash::check($request->oldPassword, $tablet->hashedPassword)) {
// //     return redirect()->back()->withErrors(['oldPassword' => 'The old password is incorrect.']);
// // }

// $hashedPass = Hash::make($request->newPassword);

// $tablet->update([
//     'name' => $request->name,
//     'email' => $request->email,
//     'hashedPassword' => $request->newPassword,
//     'password'=>$hashedPass,
// ]);


//     return redirect('dashboard')->with(['status' => 'Tablet Updated']);
// }
