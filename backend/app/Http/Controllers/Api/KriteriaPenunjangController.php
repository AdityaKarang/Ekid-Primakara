<?php

namespace App\Http\Controllers\Api;

use App\Models\KriteriaPenunjang;
use App\Http\Resources\KriteriaPenunjangResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaPenunjangController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get kriteria_penunjangs
        $kriteria_penunjangs = KriteriaPenunjang::all();

        //return collection of kriteria_penunjangs as a resource
        return new KriteriaPenunjangResource(true, 'List Data Kriteria Penunjang', $kriteria_penunjangs);
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
            'peran'     => 'required',
            'nilai'     => 'required',
            'angka_kredit'     => 'required',

        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create Kriteria Penunjang
        $kriteria_penunjangs = KriteriaPenunjang::create([
            'peran'   => $request->peran,
            'nilai'   => $request->nilai,
            'angka_kredit'   => $request->angka_kredit,
        ]);

        //return response
        return new KriteriaPenunjangResource(true, 'Data Kriteria Penunjang Berhasil Ditambahkan!', $kriteria_penunjangs);
    }

    /**
     * show
     *
     * @param  mixed $kriteria_penunjangs
     * @return void
     */
    public function show($id)
    {
        $kriteria_penunjangs = KriteriaPenunjang::find($id);
        //return single bentuk as a resource
        return new KriteriaPenunjangResource(true, 'Data Bidang Fokus Ditemukan!', $kriteria_penunjangs);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'peran'     => 'required',
            'nilai'     => 'required',
            'angka_kredit'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data Kriteria Penunjang yang akan diupdate
        $kriteria_penunjangs = KriteriaPenunjang::find($id);

        // update data Kriteria Penunjang
        $kriteria_penunjangs->peran = $request->input('peran');
        $kriteria_penunjangs->nilai = $request->input('nilai');
        $kriteria_penunjangs->angka_kredit = $request->input('angka_kredit');
        $kriteria_penunjangs->save();

        //return response
        return new KriteriaPenunjangResource(true, 'Data Kriteria Penunjang Berhasil Diubah!', $kriteria_penunjangs);
    }

    public function destroy($id)
    {
        // mencari data Kriteria Penunjang yang akan dihapus
        $kriteria_penunjangs = KriteriaPenunjang::find($id);

        // jika data Kriteria Penunjang tidak ditemukan, kembalikan pesan error
        if (!$kriteria_penunjangs) {
            return response()->json([
                'success' => false,
                'message' => 'Kriteria Penunjang tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data Kriteria Penunjang
        $kriteria_penunjangs->delete();

        //return response
        return new KriteriaPenunjangResource(true, 'Data Kriteria Penunjang Berhasil Dihapus!', $kriteria_penunjangs);
    }
}
