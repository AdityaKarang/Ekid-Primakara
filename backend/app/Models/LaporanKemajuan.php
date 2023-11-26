<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class LaporanKemajuan extends Model
{
    use HasFactory;

    protected $table = 'laporan_kemajuans';
    protected $appends = ['kemajuan_url'];



    public function penelitian() {
        return $this->belongsTo(Penelitian::class);
    }
    public function pengabdian() {
        return $this->belongsTo(Pengabdian::class);
    }


    protected $fillable = [
        'penelitian_id',
        'pengabdian_id',
        'laporan_kemajuan',
        'status',
        'catatan',
    ];

    public function getKemajuanUrlAttribute(){
        return Storage::url('public/penelitian/laporan'.$this->laporan_kemajuan);
    }
    public function getKemajuanPengabdianUrlAttribute(){
        return Storage::url('public/pengabdian/laporan'.$this->laporan_kemajuan);
    }
}
