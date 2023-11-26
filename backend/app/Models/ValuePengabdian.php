<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValuePengabdian extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_penilaian_id',
        'kriteria_penilaian_id',
        'kriteria',
        'indikator',
        'bobot',
        'value',
    ];

    public function datapenilaian() {
        return $this->belongsTo(DataPenilaian::class);
    }
    public function kriteriapenilaian() {
        return $this->belongsTo(KriteriaPenilaian::class);
    }

    // Relasi dengan Pengabdian
    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class);
    }
}
