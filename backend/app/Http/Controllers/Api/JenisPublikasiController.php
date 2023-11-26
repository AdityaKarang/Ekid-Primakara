<?php

namespace App\Http\Controllers\Api;

use App\Models\JenisPublikasi;
use App\Http\Resources\JenisPublikasiResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisPublikasiController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get jenis_publikasis
        $jenis_publikasis = JenisPublikasi::all();

        //return collection of jenis_publikasis as a resource
        return new JenisPublikasiResource(true, 'List Data Publikasi', $jenis_publikasis);
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
            'jenis_publikasi'     => 'required',
            'bobot'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create jenis publikasi
        $jenis_publikasis = JenisPublikasi::create([
            'jenis_publikasi'   => $request->jenis_publikasi,
            'bobot'   => $request->bobot,
        ]);

        //return response
        return new JenisPublikasiResource(true, 'Data Jenis Publikasi Berhasil Ditambahkan!', $jenis_publikasis);
    }

    /**
     * show
     *
     * @param  mixed $jenis_publikasi
     * @return void
     */
    public function show($id)
    {
        $jenis_publikasis = JenisPublikasi::find($id);
        //return single jenis publikasi as a resource
        return new JenisPublikasiResource(true, 'Data Publikasi Ditemukan!', $jenis_publikasis);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'jenis_publikasi'     => 'required',
            'bobot' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data jenis publikasi yang akan diupdate
        $jenis_publikasis = JenisPublikasi::find($id);

        // update data jenis publikasi
        $jenis_publikasis->jenis_publikasi = $request->input('jenis_publikasi');
        $jenis_publikasis->bobot = $request->input('bobot');
        $jenis_publikasis->save();

        //return response
        return new JenisPublikasiResource(true, 'Data jenis publikasi Berhasil Diubah!', $jenis_publikasis);
    }

    public function destroy($id)
    {
        // mencari data jenis publikasi yang akan dihapus
        $jenis_publikasis = JenisPublikasi::find($id);

        // jika data jenis publikasi tidak ditemukan, kembalikan pesan error
        if (!$jenis_publikasis) {
            return response()->json([
                'success' => false,
                'message' => 'jenis publikasi tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data jenis publikasi
        $jenis_publikasis->delete();

        //return response
        return new JenisPublikasiResource(true, 'Data jenis publikasi Berhasil Dihapus!', $jenis_publikasis);
    }
}
