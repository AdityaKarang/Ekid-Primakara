<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublikasiResource;
use App\Models\Publikasi;
use App\Models\ValuePublikasi;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function storePublikasiPenelitian(Request $request)
    {
        $publikasi = $request->input('publikasi');
        $value = $request->input('value');

        // Proses data penilaian
        $publikasi = Publikasi::create([
            'penelitian_id' => $dataPenilaian['penelitian_id'],
            'pengabdian_id' => $dataPenilaian['pengabdian_id'] ?? null,
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'jenis_publikasi' => $dataPenilaian['jenis_publikasi'],
        ]);

        $file_jurnal = $request->file('file_jurnal');
        $jurnalName = time() . '_' . $file_jurnal->getClientOriginalName();
        $file_jurnal->storeAs('public/penelitian/publikasi/', $jurnalName);

        foreach ($value as $item) {
            ValuePublikasi::create([
                'publikasi_id' => $publikasi->id,
                'tahun_publikasi' => $item['tahun_publikasi'],
                'jenis_publikasi_jurnal' => $item['jenis_publikasi_jurnal'],
                'judul_publikasi' => $item['judul_publikasi'],
                'nama_jurnal' => $item['nama_jurnal'],
                'issn_jurnal' => $item['issn_jurnal'],
                'volume' => $item['volume'],
                'nomor' => $item['nomor'],
                'halaman' => $item['halaman'],
                'url' => $item['url'],
                'file_jurnal' => $jurnalName,
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
}
