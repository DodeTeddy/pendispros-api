<?php

namespace App\Http\Controllers;

use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Http\Request;

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
                'verified_as' => auth()->user()->verified_as,
                'disability' => $data->disability
            ],200);
        }else {
            $data = UserWorkshop::where('user_id', auth()->user()->id)->first();
            return response()->json([
                'user_id' => auth()->user()->id,
                'role' => auth()->user()->role,
                'username' => auth()->user()->username,
                'name' => $data->workshop_name ?? null,
                'phone' => $data->phone_number ?? null,
                'verified_as' => auth()->user()->verified_as,
                'disability' => null
            ],200);
        }
    }
}
