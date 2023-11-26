<?php

namespace App\Http\Controllers\Api;

use App\Models\IndikatorPenilaian;
use App\Http\Resources\IndikatorPenilaianResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndikatorPenilaianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get indikator_penilaians
        $indikator_penilaians = IndikatorPenilaian::all();

        //return collection of indikator_penilaians as a resource
        return new IndikatorPenilaianResource(true, 'List Data indikator penilaian', $indikator_penilaians);
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
            'rubrik_penilaians_id'     => 'required',
            'indikator'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create bentuk dana
        $indikator_penilaians = IndikatorPenilaian::create([
            'rubrik_penilaians_id'   => $request->rubrik_penilaians_id,
            'indikator'   => $request->indikator,
        ]);

        //return response
        return new IndikatorPenilaianResource(true, 'Data Bentuk Dana Berhasil Ditambahkan!', $indikator_penilaians);
    }

    /**
     * show
     *
     * @param  mixed $indikator_penilaians
     * @return void
     */
    public function show($id)
    {
        $indikator_penilaians = IndikatorPenilaian::find($id);
        //return single bentuk as a resource
        return new IndikatorPenilaianResource(true, 'Data Bidang Fokus Ditemukan!', $indikator_penilaians);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'rubrik_penilaians_id'     => 'required',
            'indikator'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data bentuk dana yang akan diupdate
        $indikator_penilaians = IndikatorPenilaian::find($id);

        // update data bentuk dana
        $indikator_penilaians->rubrik_penilaians_id = $request->input('rubrik_penilaians_id');
        $indikator_penilaians->indikator = $request->input('indikator');

        $indikator_penilaians->save();

        //return response
        return new IndikatorPenilaianResource(true, 'Data Bentuk Dana Berhasil Diubah!', $indikator_penilaians);
    }


    public function destroy($id)
    {
        // mencari data bentuk dana yang akan dihapus
        $indikator_penilaians = IndikatorPenilaian::find($id);

        // jika data bentuk dana tidak ditemukan, kembalikan pesan error
        if (!$indikator_penilaians) {
            return response()->json([
                'success' => false,
                'message' => 'Bentuk Dana tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data bentuk dana
        $indikator_penilaians->delete();

        //return response
        return new IndikatorPenilaianResource(true, 'Data Bentuk Dana Berhasil Dihapus!', $indikator_penilaians);
    }
}
