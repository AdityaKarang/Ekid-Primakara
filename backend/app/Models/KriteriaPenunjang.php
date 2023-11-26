<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaPenunjang extends Model
{
    use HasFactory;

    protected $fillable = [
        'peran',
        'nilai',
        'angka_kredit'
    ];
}
