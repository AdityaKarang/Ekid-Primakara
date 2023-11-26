<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenjadwalan extends Model
{
    use HasFactory;

    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'tahun_akademik',
        'jenis',
        'waktu_buka',
        'waktu_tutup',
        'type'
    ];

}