<?php

namespace App\Http\Controllers\Api;

use App\Models\LaporanAkhir;
use App\Http\Resources\LaporanAkhirResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LaporanAkhirController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'penelitian_id' => 'required',
            // 'pengabdian_id' => 'required',
            'laporan_akhir' => 'required',
            'status' => 'required',
            // 'catatan' => 'required',
            
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('public/penelitian/laporan', $laporanAkhirName);

        $laporanakhirs = LaporanAkhir::create([
            'penelitian_id' => $request->penelitian_id,
            'pengabdian_id' => $request->pengabdian_id,
            'laporan_akhir' => $laporanAkhirName,
            'catatan' => $request->catatan,
            'judul' => $request->judul,
            'status' => $request->status,
        ]);

        return new LaporanAkhirResource(true, 'Laporan Akhir Berhasil Ditambahkan!', $laporanakhirs);
    }

    
    public function updateStatusAkhir(Request $request, $id)
    {
        $akhirs = LaporanAkhir::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);
        $akhirs->status = $request->status;
        $akhirs->save();

        return new LaporanAkhirResource(true, 'Kontrak Berhasil Ditambahkan!', $akhirs);
    }

    public function showAkhirPenelitian($penelitian_id)
    {
        $akhirs = LaporanAkhir::where('penelitian_id', $penelitian_id)->get();
    
        return new LaporanAkhirResource(true, 'Data Laporan Kemajuan Berdasarkan Penelitian ID', $akhirs);
    }
    public function showAkhirPengabdian($pengabdian_id)
    {
        $akhirs = LaporanAkhir::where('pengabdian_id', $pengabdian_id)->get();
    
        return new LaporanAkhirResource(true, 'Data Laporan Kemajuan Berdasarkan Pengabdian ID', $akhirs);
    }

    public function storeAkhirPengabdian(Request $request)
    {
        $request->validate([
            // 'penelitian_id' => 'required',
            // 'pengabdian_id' => 'required',
            'laporan_akhir' => 'required',
            'status' => 'required',
            // 'catatan' => 'required',
            
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('public/pengabdian/laporan', $laporanAkhirName);

        $laporanakhirs = LaporanAkhir::create([
            'penelitian_id' => $request->penelitian_id,
            'pengabdian_id' => $request->pengabdian_id,
            'laporan_akhir' => $laporanAkhirName,
            'catatan' => $request->catatan,
            'judul' => $request->judul,
            'status' => $request->status,
        ]);

        return new LaporanAkhirResource(true, 'Laporan Akhir Berhasil Ditambahkan!', $laporanakhirs);
    }
}
