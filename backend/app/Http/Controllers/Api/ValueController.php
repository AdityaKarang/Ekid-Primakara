<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ValueResource;
use App\Models\Value;
use Illuminate\Http\Request;

class ValueController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        foreach ($data as $item) {
            $value = new Value([
                'penelitian_id' => $item['penelitian_id'], // Sesuaikan dengan nama kolom di formulir
                // 'pengabdian_id' => $item['pengabdian_id'], // Sesuaikan dengan nama kolom di formulir
                'value' => $item['value'],
                'kriteria_penilaian_id' => $item['kriteria_penilaian_id']
            ]);
            $value->save();
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
}
