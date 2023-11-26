<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Penunjang extends Model
{
    use HasFactory;

    protected $table = 'penunjangs';
    protected $appends = ['bukti_url'];

    
    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected $fillable = [
        'user_id',
        'tahun_akademik',
        'nama_kegiatan',
        'peran',
        'nilai',
        'bukti_kegiatan',
        'keterangan',
        'status',
    ];  

    public function getBuktiUrlAttribute(){
        return Storage::url('public/penunjang/'.$this->bukti_kegiatan);
    }
}
