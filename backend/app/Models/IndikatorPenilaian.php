<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria_penilaian_id',
        'indikator',
        'bobot'
    ];

    public function kriteriaPenilaian()
    {
        return $this->belongsTo(KriteriaPenilaian::class);
    }
    /**
     * fillable
     *
     * @var array
     */

}
