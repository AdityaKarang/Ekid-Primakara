<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'penelitian_id',
        'pengabdian_id',
        'value',
        'kriteria_penilaian_id'
    ];

    // Relasi dengan Penelitian
    public function penelitian()
    {
        return $this->belongsTo(Penelitian::class);
    }

    // Relasi dengan Pengabdian
    public function pengabdian()
    {
        return $this->belongsTo(Pengabdian::class);
    }
}
