<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function getNotification()
    {
        $data = Information::where('create_by', '!=', auth()->user()->id)->with('user')->get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }
}
