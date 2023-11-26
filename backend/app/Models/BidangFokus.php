<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangFokus extends Model
{
    use HasFactory;


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'bidang_fokus',
    ];
}
