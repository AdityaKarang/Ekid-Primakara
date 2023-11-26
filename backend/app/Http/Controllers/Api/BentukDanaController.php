<?php

namespace App\Http\Controllers\Api;

use App\Models\BentukDana;
use App\Http\Resources\BentukDanaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BentukDanaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get bentuk_danas
        $bentuk_danas = BentukDana::all();

        //return collection of bentuk_danas as a resource
        return new BentukDanaResource(true, 'List Data Bentuk Dana', $bentuk_danas);
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
            'bentuk_dana'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create bentuk dana
        $bentuk_danas = BentukDana::create([
            'bentuk_dana'   => $request->bentuk_dana,
        ]);

        //return response
        return new BentukDanaResource(true, 'Data Bentuk Dana Berhasil Ditambahkan!', $bentuk_danas);
    }

    /**
     * show
     *
     * @param  mixed $bentuk_danas
     * @return void
     */
    public function show($id)
    {
        $bentuk_danas = BentukDana::find($id);
        //return single bentuk as a resource
        return new BentukDanaResource(true, 'Data Bidang Fokus Ditemukan!', $bentuk_danas);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'bentuk_dana'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data bentuk dana yang akan diupdate
        $bentuk_danas = BentukDana::find($id);

        // update data bentuk dana
        $bentuk_danas->bentuk_dana = $request->input('bentuk_dana');
        $bentuk_danas->save();

        //return response
        return new BentukDanaResource(true, 'Data Bentuk Dana Berhasil Diubah!', $bentuk_danas);
    }

    public function destroy($id)
    {
        // mencari data bentuk dana yang akan dihapus
        $bentuk_danas = BentukDana::find($id);

        // jika data bentuk dana tidak ditemukan, kembalikan pesan error
        if (!$bentuk_danas) {
            return response()->json([
                'success' => false,
                'message' => 'Bentuk Dana tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data bentuk dana
        $bentuk_danas->delete();

        //return response
        return new BentukDanaResource(true, 'Data Bentuk Dana Berhasil Dihapus!', $bentuk_danas);
    }
}
