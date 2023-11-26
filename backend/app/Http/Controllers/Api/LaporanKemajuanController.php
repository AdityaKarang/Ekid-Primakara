<?php

namespace App\Http\Controllers\Api;

use App\Models\LaporanKemajuan;
use App\Http\Resources\LaporanKemajuanResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LaporanKemajuanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'penelitian_id' => 'required',
            // 'pengabdian_id' => 'required',
            'laporan_kemajuan' => 'required',
            'status' => 'required',
            // 'catatan' => 'required',
            
        ]);

        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/penelitian/laporan', $laporanKemajuanName);

        $laporankemajuans = LaporanKemajuan::create([
            'penelitian_id' => $request->penelitian_id,
            'pengabdian_id' => $request->pengabdian_id,
            'laporan_kemajuan' => $laporanKemajuanName,
            'catatan' => $request->catatan,
            'judul' => $request->judul,
            'status' => $request->status,
        ]);

        return new LaporanKemajuanResource(true, 'Laporan Kemajuan Berhasil Ditambahkan!', $laporankemajuans);
    }

    public function updateStatusKemajuan(Request $request, $id)
    {
        $kemajuans = LaporanKemajuan::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);
        $kemajuans->status = $request->status;
        $kemajuans->save();

        return new LaporanKemajuanResource(true, 'Kontrak Berhasil Ditambahkan!', $kemajuans);
    }

    public function showKemajuanPenelitian($penelitian_id)
    {
        $laporankemajuans = LaporanKemajuan::where('penelitian_id', $penelitian_id)->get();
    
        return new LaporanKemajuanResource(true, 'Data Laporan Kemajuan Berdasarkan Penelitian ID', $laporankemajuans);
    }
    
    public function showKemajuanPengabdian($pengabdian_id)
    {
        $laporankemajuans = LaporanKemajuan::where('pengabdian_id', $pengabdian_id)->get();
    
        return new LaporanKemajuanResource(true, 'Data Laporan Kemajuan Berdasarkan Pengabdian ID', $laporankemajuans);
    }
    
    public function storeKemajuanPengabdian(Request $request)
    {
        $request->validate([
            // 'penelitian_id' => 'required',
            // 'pengabdian_id' => 'required',
            'laporan_kemajuan' => 'required',
            'status' => 'required',
            // 'catatan' => 'required',
            
        ]);

        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/pengabdian/laporan', $laporanKemajuanName);

        $laporankemajuans = LaporanKemajuan::create([
            'penelitian_id' => $request->penelitian_id,
            'pengabdian_id' => $request->pengabdian_id,
            'laporan_kemajuan' => $laporanKemajuanName,
            'catatan' => $request->catatan,
            'judul' => $request->judul,
            'status' => $request->status,
        ]);

        return new LaporanKemajuanResource(true, 'Laporan Kemajuan Berhasil Ditambahkan!', $laporankemajuans);
    }


}
