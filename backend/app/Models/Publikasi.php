<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publikasi extends Model
{
    use HasFactory;

    protected $table = 'publikasis';

    public $incrementing = false;
    protected $keyType = 'string';



    public function valuepublikasi()
    {
        return $this->hasMany(ValuePublikasi::class);
    }
    public function pengabdian()
    {
        return $this->belongsTo('App\Models\Pengabdian', 'pengabdians_id');
    }

    public function penelitian()
    {
        return $this->belongsTo('App\Models\Penelitian', 'penelitians_id');
    }

    protected $fillable = [
        'penelitian_id',
        'pengabdian_id',
        'user_id',
        'status',
        'jenis_publikasi',
    ];
 
}
