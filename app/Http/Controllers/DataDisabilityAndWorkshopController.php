<?php

namespace App\Http\Controllers;

use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Http\Request;

class DataDisabilityAndWorkshopController extends Controller
{
    public function getDataWorkshop()
    {
        $data = UserWorkshop::Select('id', 'user_id', 'city_id', 'province_id', 'workshop_name', 'address', 'phone_number')->with('user', 'city', 'province')->get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }

    public function getDataDisability()
    {
        $data = UserDisability::Select('id', 'user_id', 'city_id', 'province_id', 'name', 'address', 'phone_number', 'age', 'disability', 'explanation')->with('user', 'city', 'province')->get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }
}
