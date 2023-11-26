<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        //get bentuk_danas
        $mahasiswa = Mahasiswa::all();

        //return collection of bentuk_danas as a resource
        return new MahasiswaResource(true, 'List mahasiswa', $mahasiswa);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'nim' => 'required',
            'prodi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors(), 'data' => null], 409);
        }
        // dd($request->all());
        DB::beginTransaction();

        try {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'nim' => $request->nim,
                'prodi' => $request->prodi,
            ];

            $mahasiswa = Mahasiswa::create($data);

            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Roles added successfullly', 'data' => $mahasiswa], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json(['success' => false, 'msg' => $e->getMessage(), 'data' => null], 409);
        }
    }
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return response()->json($mahasiswa);
    }
}
