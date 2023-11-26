<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'kriteria',
        'type',
    ];

    public function indikatorPenilaians()
    {
        return $this->hasMany(IndikatorPenilaian::class);
    }
    public function valuepengabdian()
    {
        return $this->hasMany(ValuePengabdian::class);
    }
    /**
     * fillable
     *
     * @var array
     */

}
