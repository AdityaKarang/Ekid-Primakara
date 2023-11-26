<?php

namespace App\Http\Controllers\Api;

use App\Models\SumberDana;
use App\Http\Resources\SumberDanaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SumberDanaController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get sumber_danas
        $sumber_danas = SumberDana::all();

        //return collection of sumber_danas as a resource
        return new SumberDanaResource(true, 'List Data Sumber Dana', $sumber_danas);
    }

     /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'sumber_dana'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create sumber dana
        $sumber_danas = SumberDana::create([
            'sumber_dana'   => $request->sumber_dana,
        ]);

        //return response
        return new SumberDanaResource(true, 'Data Sumber Dana Berhasil Ditambahkan!', $sumber_danas);
    }

    /**
     * show
     *
     * @param  mixed $sumber_danas
     * @return void
     */
    public function show($id)
    {
        $sumber_danas = SumberDana::find($id);
        //return single sumber dana as a resource
        return new SumberDanaResource(true, 'Data Bidang Fokus Ditemukan!', $sumber_danas);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'sumber_dana'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data bentuk dana yang akan diupdate
        $sumber_danas = SumberDana::find($id);

        // update data bentuk dana
        $sumber_danas->sumber_dana = $request->input('sumber_dana');
        $sumber_danas->save();

        //return response
        return new SumberDanaResource(true, 'Data sumber dana Berhasil Diubah!', $sumber_danas);
    }

    public function destroy($id)
    {
        // mencari data sumber dana yang akan dihapus
        $sumber_danas = SumberDana::find($id);

        // jika data sumber dana tidak ditemukan, kembalikan pesan error
        if (!$sumber_danas) {
            return response()->json([
                'success' => false,
                'message' => 'sumber dana tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data sumber dana
        $sumber_danas->delete();

        //return response
        return new SumberDanaResource(true, 'Data sumber dana Berhasil Dihapus!', $sumber_danas);
    }
}
