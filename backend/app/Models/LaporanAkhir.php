<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $table = 'laporan_akhirs';
    protected $appends = ['akhir_url'];



    public function penelitian() {
        return $this->belongsTo(Penelitian::class);
    }
    public function pengabdian() {
        return $this->belongsTo(Pengabdian::class);
    }
    // public function pengabdian() {
    //     return $this->belongsTo(Pengabdian::class);
    // }

    protected $fillable = [
        'penelitian_id',
        'pengabdian_id',
        'laporan_akhir',
        'status',
        'catatan',
    ];

    public function getAkhirUrlAttribute(){
        return Storage::url('public/penelitian/laporan'.$this->laporan_akhir);
    }
    public function getAkhirPengabdianUrlAttribute(){
        return Storage::url('public/pengabdian/laporan'.$this->laporan_akhir);
    }
}
