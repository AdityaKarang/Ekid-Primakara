<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengabdian;
use Illuminate\Http\Request;

class DiagramPengabdianController extends Controller
{
    public function countPengabdian(Request $request){
        $data = Pengabdian::join('users', 'pengabdians.user_id', '=', 'users.id')
        ->select('pengabdians.*', 'users.prodi')
        ->where('bidang_fokus', $request->bidang_fokus)
        ->where('tahun_akademik', $request->tahun_akademik)
        ->where('semester', $request->semester)
        ->where('prodi', $request->prodi)
        ->count();
        return response()->json($data);
    }}
