<?php

namespace App\Http\Controllers\Api;

use App\Models\RubrikPenilaian;
use App\Http\Resources\RubrikPenilaianResource;
use App\Http\Controllers\Controller;
use App\Models\KriteriaPenilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaPenilaianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $kriteriaPenilaians = KriteriaPenilaian::with('indikatorPenilaians')->get();
    
        return response()->json($kriteriaPenilaians);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    // public function store(Request $request)
    // {
    //     //define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'kriteria_penilaian'     => 'required',
    //         'type'     => 'required',
    //     ]);

    //     //check if validation fails
    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     //create bentuk dana
    //     $rubrik_penilaians = RubrikPenilaian::create([
    //         'kriteria_penilaian'   => $request->kriteria_penilaian,
    //         'type'   => $request->type,
    //     ]);

    //     //return response
    //     return new RubrikPenilaianResource(true, 'Data Bentuk Dana Berhasil Ditambahkan!', $rubrik_penilaians);
    // }
    public function store(Request $request)
    {
        $request->validate([
            'kriteria' => 'required',
            'type' => 'required|in:proposal,kemajuan,monev,akhir',
            'indikators' => 'required|array|min:1',
            'indikators.*.indikator' => 'required|string',
            'indikators.*.bobot' => 'required|integer',
        ]);

        $kriteria = KriteriaPenilaian::create([
            'kriteria' => $request->input('kriteria'),
            'type' => $request->input('type'),
        ]);

        foreach ($request->input('indikators') as $indikatorData) {
            $kriteria->indikatorPenilaians()->create([
                'indikator' => $indikatorData['indikator'],
                'bobot' => $indikatorData['bobot'],
            ]);
        }

        return response()->json(['message' => 'Kriteria penilaian berhasil ditambahkan'], 201);
    }

    /**
     * show
     *
     * @param  mixed $rubrik_penilaians
     * @return void
     */
    public function show($id)
    {
        $kriteriaPenilaian = KriteriaPenilaian::findOrFail($id);
    
        // Memuat indikator penilaian terkait
        $kriteriaPenilaian->load('indikatorPenilaians');
    
        return response()->json($kriteriaPenilaian);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kriteria' => 'required',
            'type' => 'required|in:proposal,kemajuan,monev,akhir',
            'indikators' => 'required|array|min:1',
            'indikators.*.indikator' => 'required|string',
            'indikators.*.bobot' => 'required|integer',
        ]);
    
        $kriteriaPenilaian = KriteriaPenilaian::findOrFail($id);
        $kriteriaPenilaian->kriteria = $request->input('kriteria');
        $kriteriaPenilaian->type = $request->input('type');
        $kriteriaPenilaian->save();
    
        // Menghapus indikator penilaian yang ada terlebih dahulu
        $kriteriaPenilaian->indikatorPenilaians()->delete();
    
        // Menambahkan indikator penilaian yang baru
        foreach ($request->input('indikators') as $indikatorData) {
            $kriteriaPenilaian->indikatorPenilaians()->create([
                'indikator' => $indikatorData['indikator'],
                'bobot' => $indikatorData['bobot'],
            ]);
        }
    
        return response()->json(['message' => 'Kriteria penilaian berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $kriteriaPenilaian = KriteriaPenilaian::findOrFail($id);
    
        // Menghapus indikator penilaian terkait
        $kriteriaPenilaian->indikatorPenilaians()->delete();
    
        // Menghapus kriteria penilaian
        $kriteriaPenilaian->delete();
    
        return response()->json(['message' => 'Kriteria penilaian berhasil dihapus']);
    }

    public function getValuePengabdian() {
        $combinedData = KriteriaPenilaian::with('valuepengabdian')->get();
        return $combinedData;
    }
}

