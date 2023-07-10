<?php

namespace App\Http\Controllers;

use App\Models\UserDisability;
use App\Models\UserWorkshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataDisabilityAndWorkshopController extends Controller
{
    public function getDataWorkshop(Request $request)
    {
        $data = UserWorkshop::Select('id', 'user_id', 'city_id', 'province_id', 'workshop_name', 'address', 'phone_number')->with('user', 'city', 'province');
        if ($request->search) {
            return response()->json([
                'message' => 'Get Data Success!',
                'data' => $data->where('workshop_name', 'like', '%'.$request->search.'%')->get()
            ],200);
        }else if ($request->filter) {
            return response()->json([
                'message' => 'Get Data Success!',
                'data' => $data->where('province_id', $request->filter)->get()
            ],200);
        }else {
            return response()->json([
                'message' => 'Get Data Success!',
                'data' => $data->get()
            ],200);
        }
    }

    public function updateDataWorkshop(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'province_id' => 'required',
            'workshop_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Update Failed!'
            ]);
        }else{
            $workshop_update = UserWorkshop::where('id', $id)->update([
                'city_id' => $request->city_id,
                'province_id' => $request->province_id,
                'workshop_name' => $request->workshop_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
            ]);

            if ($workshop_update) {
                return response()->json([
                    'message' => 'Update Success!',
                ]);
            }else{
                return response()->json([
                    'message' => 'Update Success!',
                ]);
            }
        }
    }

    public function deleteDataWorkshop($id)
    {
        $deleteWorkshop = UserWorkshop::where('id', $id)->delete();

        if ($deleteWorkshop) {
            return response()->json([
                'message' => 'Delete Success!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Delete Failed!'
            ],422);
        }
    }

    public function getDataDisability(Request $request)
    {
        $data = UserDisability::Select(
            'id', 'user_id', 'city_id', 'province_id', 'name', 'address', 'phone_number', 'age', 'disability', 
            'jenis_amputasi_kiri',
            'jenis_amputasi_kanan',
            'jenis_prostetik'
            )->with('user', 'city', 'province');
            if ($request->search) {
                return response()->json([
                    'message' => 'Get Data Success!',
                    'data' => $data->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('disability', 'like', '%'.$request->search.'%')
                    ->orWhere('jenis_prostetik', 'like', '%'.$request->search.'%')
                    ->get()
                ],200);
            }else if ($request->filter) {
                return response()->json([
                    'message' => 'Get Data Success!',
                    'data' => $data->where('disability', $request->filter)->get()
                ],200);
            }else {
                return response()->json([
                    'message' => 'Get Data Success!',
                    'data' => $data->get()
                ],200);
            }
    }

    public function updateDataDisability(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required',
            'province_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'age' => 'required',
            'disability' => 'required|in:Tangan,Kaki',
            'jenis_amputasi_kiri' => 'required',
            'jenis_amputasi_kanan' => 'required',
            'jenis_prostetik' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Update Failed!'
            ]);
        }else{
            $disability_update = UserDisability::where('id', $id)->update([
                'city_id' => $request->city_id,
                'province_id' => $request->province_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'age' => $request->age,
                'disability' => $request->disability,
                'jenis_amputasi_kiri' => $request->jenis_amputasi_kiri,
                'jenis_amputasi_kanan' => $request->jenis_amputasi_kanan,
                'jenis_prostetik' => $request->jenis_prostetik
            ]);

            if ($disability_update) {
                return response()->json([
                    'message' => 'Update Success!',
                ]);
            }else{
                return response()->json([
                    'message' => 'Update Success!',
                ]);
            }
        }
    }

    public function deleteDataDisability($id)
    {
        $deleteDisabilitiy = UserDisability::where('id', $id)->delete();

        if ($deleteDisabilitiy) {
            return response()->json([
                'message' => 'Delete Success!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Delete Failed!'
            ],422);
        }
    }
}
