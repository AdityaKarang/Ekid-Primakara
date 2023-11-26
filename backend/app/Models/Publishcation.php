<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Publishcation extends Model
{
    use HasFactory;
    protected $table = 'publishcations';

    protected $appends = ['jurnal_url'];
   


    public $incrementing = false;
    protected $keyType = 'string';

    public function penelitian() {
        return $this->belongsTo(Penelitian::class);
    }
    public function pengabdian() {
        return $this->belongsTo(Pengabdian::class);
    }



    protected $fillable = [
        'user_id',
        'penelitian_id',
        'pengabdian_id',
        'jenis',
        'tahun_publikasi',
        'jenis_publikasi_jurnal',
        'judul_publikasi',
        'nama_jurnal',
        'issn_jurnal',
        'volume',
        'halaman',
        'nomor',
        'status',
        'url',
        'file_jurnal',
    ];  

    public function getJurnalUrlAttribute(){
        return Storage::url('public/penelitian/publikasi/'.$this->file_jurnal);
    }

}
