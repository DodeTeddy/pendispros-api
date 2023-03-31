<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        if (! Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                'message' => 'Login Failed!',
                'token' => null
            ], 401);
        }

        $user = User::where('username', $request->username)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success!',
            'token' => $token
        ], 200);
        
    }
    
    public function profile(){
        return response()->json([
            'id' => auth()->user()->id,
            'role' => auth()->user()->role,
            'verified_as' => auth()->user()->verified_as,
            'username' => auth()->user()->username,
            'email' => auth()->user()->email,
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout Success!'
        ],200);
    }
}
