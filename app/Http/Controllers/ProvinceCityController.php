<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceCityController extends Controller
{
    public function getProvince()
    {
        $data = Province::get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }

    public function getCity(Request $request)
    {   
        $search = $request->only(['province_id','name']);
        $data = City::where($search)->get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }
}
