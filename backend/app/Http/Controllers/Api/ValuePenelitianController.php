<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ValuePenelitian;
use Illuminate\Http\Request;

class ValuePenelitianController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $item) {
            $valuepenelitian = new ValuePenelitian([
                'penelitian_id' => $item['penelitian_id'], // Sesuaikan dengan nama kolom di formulir
                'value' => $item['value'],
                'kriteria_penilaian_id' => $item['kriteria_penilaian_id']
            ]);
            $valuepenelitian->save();
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
}
