<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValueKemajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_penilaian_id',
        'kriteria_penilaian_id',
        'kriteria',
        'bobot',
        'indikator',
        'value',
    ];

    public function datapenilaian() {
        return $this->belongsTo(DataPenilaian::class);
    }
}
