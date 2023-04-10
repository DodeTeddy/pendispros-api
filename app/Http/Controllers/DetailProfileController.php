<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailProfileController extends Controller
{
    public function getDetailProfile()
    {   
        if (auth()->user()->role == 'disability') {
            $data = UserDisability::where('user_id', auth()->user()->id)->first();
            return response()->json([
                'user_id' => auth()->user()->id,
                'role' => auth()->user()->role,
                'username' => auth()->user()->username,
                'name' => $data->name ?? null,
                'phone' => $data->phone_number ?? null,
                'email' => auth()->user()->email,
                'verified_as' => auth()->user()->verified_as,
                'disability' => $data->disability ?? null
            ],200);
        }else {
            $data = UserWorkshop::where('user_id', auth()->user()->id)->first();
            return response()->json([
                'user_id' => auth()->user()->id,
                'role' => auth()->user()->role,
                'username' => auth()->user()->username,
                'name' => $data->workshop_name ?? null,
                'phone' => $data->phone_number ?? null,
                'email' => auth()->user()->email,
                'verified_as' => auth()->user()->verified_as,
                'disability' => null
            ],200);
        }
    }

    public function editProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Update Failed!'
            ]);
        }
        
        if (auth()->user()->role == 'disability') {
            $user_update = User::where('id', auth()->user()->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);
            
            $userdis_update = UserDisability::where('user_id',auth()->user()->id)->update([
                'name' => $request->name,
                'phone_number' => $request->phone,
            ]);

            if ($user_update || $userdis_update || $validator) {
                return response()->json([
                    'message' => 'Update Success!',
                ]);
            }else {
                return response()->json([
                    'message' => 'Update Failed!'
                ]);
            }
        }else {
            $user_update = User::where('id', auth()->user()->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);
    
            $userpros_update = UserWorkshop::where('user_id',auth()->user()->id)->update([
                'workshop_name' => $request->name,
                'phone_number' => $request->phone,
            ]);

            if ($user_update || $userpros_update || $validator) {
                return response()->json([
                    'message' => 'Update Success!'
                ]);
            }else {
                return response()->json([
                    'message' => 'Update Failed!'
                ]);
            }
        }
    }
}
