<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginStatusController extends Controller
{
    public function loginStatus(Request $request){
        $user = User::where('id' , auth()->user()->id)->update([
            'status' => 'online',
            'login_time' => now(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Login Status Updated'
        ]);
    }
}
