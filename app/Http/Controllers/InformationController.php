<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function createInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_information' => 'required|unique:information',
            'detail_information' => 'required|unique:information',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Create Information Failed!'
            ],422);
        }else{
            if (auth()->user()->role == 'admin') {
                $information = Information::create([
                    'create_by' => auth()->user()->id,
                    'title_information' => $request->title_information,
                    'detail_information' => $request->detail_information,
                    'verified_status' => 'verified'
                ]);
    
                if ($information) {
                    return response()->json([
                        'message' => 'Create Information Success!'
                    ],200);
                }
            } else {

                $information = Information::create([
                    'create_by' => auth()->user()->id,
                    'title_information' => $request->title_information,
                    'detail_information' => $request->detail_information,
                    'verified_status' => 'notverified'
                ]);
    
                if ($information) {
                    return response()->json([
                        'message' => 'Create Information Success!'
                    ],200);
                }
            }
        }
    }

    public function updateInformation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title_information' => 'required',
            'detail_information' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Update Information Failed!'
            ],422);
        }else{
            if (auth()->user()->role == 'admin') {
                $information = Information::where('id', $id)->update([
                    'title_information' => $request->title_information,
                    'detail_information' => $request->detail_information,
                    'verified_status' => 'verified'
                ]);
    
                if ($information) {
                    return response()->json([
                        'message' => 'Update Information Success!'
                    ],200);
                }
            }else{
                $information = Information::where('id', $id)->update([
                    'title_information' => $request->title_information,
                    'detail_information' => $request->detail_information,
                    'verified_status' => 'notverified'
                ]);
    
                if ($information) {
                    return response()->json([
                        'message' => 'Update Information Success!'
                    ],200);
                }

            }
        }
    }

    public function deleteInformation($id)
    {
        $information = Information::where('id', $id)->delete();

        if ($information) {
            return response()->json([
                'message' => 'Delete Information Success!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Delete Information Failed!'
            ],422);
        }
    }

    public function getInformation()
    {
        $data = Information::where('create_by', auth()->user()->id)->get();
        return response()->json([
            'message' => 'Get Data Success!',
            'data' => $data
        ],200);
    }

    public function changeStatusInformation(Request $request) {
        $validator = Validator::make($request->all(), [
            'information_id'  => 'required',
            'information_status'  => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Change Verification Failed!'
            ]
            ,422);
        }else{
            Information::where('id',$request->information_id)->update(['verified_status' => $request->information_status]);
            return response()->json([
                'message' => 'Change Verification Success!'
            ]
            ,200);
        }
    }
}
