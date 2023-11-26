<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ValuePublikasi extends Model
{
    use HasFactory;
    protected $table = 'value_publikasies';

    protected $appends = ['jurnal_url'];

    public function publikasi()
    {
        return $this->belongsTo(Publikasi::class);
    }
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'publikasi_id',
        'tahun_publikasi',
        'jenis_publikasi_jurnal',
        'judul_publikasi',
        'nama_jurnal',
        'issn_jurnal',
        'volume',
        'halaman',
        'nomor',
        'url',
        'file_jurnal',
    ];

    public function getJurnalUrlAttribute(){
        return Storage::url('public/penelitian/publikasi/'.$this->file_jurnal);
    }
}
