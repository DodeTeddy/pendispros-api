<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Support\Facades\Validator;

class UserVerificationController extends Controller
{
    public function disability(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:user_disability',
            'city_id'  => 'required|exists:city,id',
            'province_id'  => 'required|exists:province,id',
            'age'  => 'required',
            'address'  => 'required',
            'phone_number'  => 'required',
            'disability'  => 'required|in:Tangan,Kaki',
            'explanation'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Verification Failed!'
            ]
            ,422);
        }

        if (auth()->user()->role == 'disability') {
            $user_disability = UserDisability::create([
                'user_id' => auth()->user()->id,
                'name'  => $request->name,
                'city_id'  => $request->city_id,
                'province_id'  => $request->province_id,
                'age'  => $request->age,
                'address'  => $request->address,
                'phone_number'  => $request->phone_number,
                'disability'  => $request->disability,
                'explanation'  => $request->explanation
            ]);
    
            User::where('id',auth()->user()->id)->update(['verified_as' => auth()->user()->role]);
    
            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }
        return response()->json([
            'message' => 'Verification Failed!'
        ]
        ,422);
    }

    public function workshop(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'workshop_name' => 'required|unique:user_workshop',
            'city_id'  => 'required|exists:city,id',
            'province_id'  => 'required|exists:province,id',
            'address' => 'required',
            'phone_number' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Verification Failed!'
            ]
            ,422);
        }

        if (auth()->user()->role == 'prosthetic') {
            $user_disability = UserWorkshop::create([
                'user_id' => auth()->user()->id,
                'workshop_name'  => $request->workshop_name,
                'city_id'  => $request->city_id,
                'province_id'  => $request->province_id,
                'address'  => $request->address,
                'phone_number'  => $request->phone_number
            ]);
    
            User::where('id',auth()->user()->id)->update(['verified_as' => auth()->user()->role]);
    
            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }
        return response()->json([
            'message' => 'Verification Failed!'
        ]
        ,422);
    }
}
