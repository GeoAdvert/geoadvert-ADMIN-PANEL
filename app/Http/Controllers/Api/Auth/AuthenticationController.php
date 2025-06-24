<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:8',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 401,
                'message' => $validate->errors(),
            ], 401);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); // Directly using Auth::user()

            // Check role
            if ($user->hasRole('admin')) {  // Assuming you're using a package like Spatie/laravel-permission
                Auth::logout();
                return response()->json([
                    'status' => 401,
                    'message' => 'You do not have permission to access.',
                ], 401);
            }

            // Generate token
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => 'Login Successfully.',
                'data' => $user,
                'token' => $token,
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Invalid Credentials',
            ], 401);
        }
    }


    public function logout(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized. Please login again.',
            ], 401);
        }

        $request->user()->tokens()->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logged out successfully.'
        ]);
    }

}
