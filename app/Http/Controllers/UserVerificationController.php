<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Support\Facades\Validator;

class UserVerificationController extends Controller
{
    public function changeVerifiedAs(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required',
            'user_role'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Change Verification Failed!'
            ]
            ,422);
        }else{
            User::where('id',$request->user_id)->update(['verified_as' => $request->user_role]);
            return response()->json([
                'message' => 'Change Verification Success!'
            ]
            ,200);
        }
    }

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
            'jenis_amputasi_kiri' => 'required',
            'jenis_amputasi_kanan' => 'required',
            'jenis_prostetik' => 'required'
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
                'jenis_amputasi_kiri' => $request->jenis_amputasi_kiri,
                'jenis_amputasi_kanan' => $request->jenis_amputasi_kanan,
                'jenis_prostetik' => $request->jenis_prostetik
            ]);
    
            User::where('id',auth()->user()->id)->update(['verified_as' => 'waiting']);
    
            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }else if (auth()->user()->role == 'admin') {
            $user_disability = UserDisability::create([
                'user_id' => auth()->user()->id,
                'name'  => $request->name,
                'city_id'  => $request->city_id,
                'province_id'  => $request->province_id,
                'age'  => $request->age,
                'address'  => $request->address,
                'phone_number'  => $request->phone_number,
                'disability'  => $request->disability,
                'jenis_amputasi_kiri' => $request->jenis_amputasi_kiri,
                'jenis_amputasi_kanan' => $request->jenis_amputasi_kanan,
                'jenis_prostetik' => $request->jenis_prostetik
            ]);

            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }else{
            return response()->json([
                'message' => 'Verification Failed!'
            ]
            ,422);
        }
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
    
            User::where('id',auth()->user()->id)->update(['verified_as' => 'waiting']);
    
            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }else if (auth()->user()->role == 'admin') {
            $user_disability = UserWorkshop::create([
                'user_id' => auth()->user()->id,
                'workshop_name'  => $request->workshop_name,
                'city_id'  => $request->city_id,
                'province_id'  => $request->province_id,
                'address'  => $request->address,
                'phone_number'  => $request->phone_number
            ]);

            if ($user_disability) {
                return response()->json([
                    'message' => 'Verification Success!'
                ]
                ,200);
            }
        }else{
            return response()->json([
                'message' => 'Verification Failed!'
            ]
            ,422);
        }
    }
}
