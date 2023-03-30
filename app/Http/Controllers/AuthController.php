<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        // $this->validate($request, [
        //     'login'    => 'required',
        //     'password' => 'required',
        // ]);
    
        // $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ) 
        //     ? 'email' 
        //     : 'username';
    
        // $request->merge([
        //     $login_type => $request->input('login')
        // ]);
       
        // if (Auth::attempt($request->only($login_type, 'password'))) {
        //     $user = Auth::user();
        //     $token =  $user->createToken('my-token')->plainTextToken;
        //     return response()->json([
        //         'message' => 'Login Success!',
        //         'token' => $token
        //     ],200);
        // }else{
        //     return response()->json([
        //         'message' => 'Login Failed!',
        //         'token' => null
        //     ],422);
        // }
        if (! Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Login Failed!',
                'token' => null
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
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
