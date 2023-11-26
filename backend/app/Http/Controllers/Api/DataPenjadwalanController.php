<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPenjadwalan;
use App\Http\Resources\DataPenjadwalanResource;
use Illuminate\Support\Facades\Validator;

class DataPenjadwalanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get indikator_penilaians
        $data_penjadwalans = DataPenjadwalan::all();

        //return collection of data_penjadwalans as a resource
        return new DataPenjadwalanResource(true, 'List Data indikator penilaian', $data_penjadwalans);
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
            // 'tahun_akademik'     => 'required',
            'jenis'     => 'required',
            'waktu_buka'     => 'required',
            'waktu_tutup'     => 'required',
            'type'     => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Penjadwalan
        $data_penjadwalans = DataPenjadwalan::create([
            // 'tahun_akademik'     => $request->tahun_akademik,
            'jenis'     => $request->jenis,
            'waktu_buka'     => $request->waktu_buka,
            'waktu_tutup'     => $request->waktu_tutup,
            'type'     => $request->type,
        ]);

        //return response
        return new DataPenjadwalanResource(true, 'Data Penjadwalan Berhasil Ditambahkan!', $data_penjadwalans);
    }

    /**
     * show
     *
     * @param  mixed $data_penjadwalans
     * @return void
     */
    public function show($id)
    {
        $data_penjadwalans = DataPenjadwalan::find($id);
        //return single bentuk as a resource
        return new DataPenjadwalanResource(true, 'Data Bidang Fokus Ditemukan!', $data_penjadwalans);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            // 'tahun_akademik'     => 'required',
            'jenis'     => 'required',
            'waktu_buka'     => 'required',
            'waktu_tutup'     => 'required',
            'type'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data Penjadwalan yang akan diupdate
        $data_penjadwalans = DataPenjadwalan::find($id);

        // update data Penjadwalan
        // $data_penjadwalans->tahun_akademik = $request->input('tahun_akademik');
        $data_penjadwalans->jenis = $request->input('jenis');
        $data_penjadwalans->waktu_buka = $request->input('waktu_buka');
        $data_penjadwalans->waktu_tutup = $request->input('waktu_tutup');
        $data_penjadwalans->type = $request->input('type');

        $data_penjadwalans->save();

        //return response
        return new DataPenjadwalanResource(true, 'Data Penjadwalan Berhasil Diubah!', $data_penjadwalans);
    }


    public function destroy($id)
    {
        // mencari data Penjadwalan yang akan dihapus
        $data_penjadwalans = DataPenjadwalan::find($id);

        // jika data Penjadwalan tidak ditemukan, kembalikan pesan error
        if (!$data_penjadwalans) {
            return response()->json([
                'success' => false,
                'message' => 'Penjadwalan tidak ditemukan',
                'data' => null
            ], 404);
        }
        // hapus data Penjadwalan
        $data_penjadwalans->delete();

        //return response
        return new DataPenjadwalanResource(true, 'Data Penjadwalan Berhasil Dihapus!', $data_penjadwalans);
    }
}
