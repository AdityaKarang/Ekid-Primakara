<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenilaian extends Model
{

    use HasFactory;
    protected $table = 'data_penilaians';

    public function valuepenelitian() {
        return $this->hasMany(ValuePenelitian::class);
    }
    public function valuepengabdian() {
        return $this->hasMany(ValuePengabdian::class);
    }
    public function valuekemajuan() {
        return $this->hasMany(ValueKemajuan::class);
    }
    public function valueakhir() {
        return $this->hasMany(ValueAkhir::class);
    }
    public function valuepenilaian() {
        return $this->hasMany(ValuePenilaian::class);
    }

    public function penelitian() {
        return $this->belongsTo(Penelitian::class);
    }
    public function pengabdian() {
        return $this->belongsTo(Pengabdian::class);
    }


    protected $fillable = [
        'penelitian_id',
        'pengabdian_id',
        'user_id',
        'status',
        'total',
        'catatan',
        'jenis',
    ];
}
