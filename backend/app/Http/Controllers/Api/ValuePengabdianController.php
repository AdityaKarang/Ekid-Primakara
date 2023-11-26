<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ValuePengabdian;
use Illuminate\Http\Request;

class ValuePengabdianController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $item) {
            $valuepengabdian = new ValuePengabdian([
                'pengabdian_id' => $item['pengabdian_id'], // Sesuaikan dengan nama kolom di formulir
                'value' => $item['value'],
                'kriteria_penilaian_id' => $item['kriteria_penilaian_id'],
                'kriteria' => $item['kriteria'],
                'indikator' => $item['kriteria_penilaian_id'],
                'bobot' => $item['kriteria_penilaian_id'],
            ]);
            $valuepengabdian->save();
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
}
