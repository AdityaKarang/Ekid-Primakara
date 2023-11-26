<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'penelitians_id',
        'pengabdians_id',
        'tahun_akademik',
        'prodi',
        'nama',
        'judul',
        'bidang_fokus',
        'proposal',
        'laporan_kemajuan',
        'laporan akhir',
        'type',
        'status'
    ];
}
