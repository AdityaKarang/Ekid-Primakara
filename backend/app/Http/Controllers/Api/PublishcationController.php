<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publishcation;
use App\Http\Resources\PublishcationResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PublishcationController extends Controller
{
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
        'user_id' => 'required',
        'jenis'=> 'required',
        'tahun_publikasi'=> 'required',
        'jenis_publikasi_jurnal'=> 'required',
        'judul_publikasi'=> 'required',
        'nama_jurnal'=> 'required',
        'issn_jurnal'=> 'required',
        'volume'=> 'required',
        'nomor'=> 'required',
        'halaman'=> 'required',
        'url'=> 'required',
        'status'=> 'required',
        'file_jurnal'=> 'required|file|mimes:pdf',

        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Upload proposal file
        $file_jurnal = $request->file('file_jurnal');
        $jurnalName = time() . '_' . $file_jurnal->getClientOriginalName();
        $file_jurnal->storeAs('public/penelitian/publikasi/', $jurnalName);

        // Create Penelitian
        $publishcations = Publishcation::create([
            'user_id' => $request->user_id,
            'penelitian_id' => $request->penelitian_id,
            'pengabdian_id' => $request->pengabdian_id,
            'jenis' => $request->jenis,
            'tahun_publikasi' => $request->tahun_publikasi,
            'jenis_publikasi_jurnal' => $request->jenis_publikasi_jurnal,
            'judul_publikasi' => $request->judul_publikasi,
            'nama_jurnal' => $request->nama_jurnal,
            'issn_jurnal' => $request->issn_jurnal,
            'volume' => $request->volume,   
            'nomor' => $request->nomor,
            'halaman' => $request->halaman,
            'url' => $request->url,
            'status' => $request->status,
            'file_jurnal' => $jurnalName,
        ]);
    
        // Return response
        return new PublishcationResource(true, 'Data Publikasi Berhasil Ditambahkan!', $publishcations);
    }
    
}
