<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitians';

    protected $appends = ['proposal_url', 'kontrak_url', 'kemajuan_url', 'akhir_url'];
   


    public $incrementing = false;
    protected $keyType = 'string';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function datapenilaian() {
        return $this->hasMany(DataPenilaian::class);
    }
    public function laporankemajuan() {
        return $this->hasOne(LaporanKemajuan::class);
    }
    public function laporanakhir() {
        return $this->hasOne(LaporanAkhir::class);
    }
    public function publishcation() {
        return $this->hasOne(Publishcation::class);
    }


    protected $fillable = [
        'user_id',
        'tahun_akademik',
        'semester',
        'judul',
        'anggota_dosen_1',
        'anggota_dosen_2',
        'mahasiswa_1',
        'mahasiswa_2',
        'bidang_fokus',
        'mitra',
        'bentuk_dana',
        'sumber_dana',
        'jumlah_dana',
        'kontrak',
        'status',
        'proposal',
        'laporan_kemajuan',
        'laporan_akhir',
        'reviewer_1',
        'reviewer_2',
    ];  

    public function getProposalUrlAttribute(){
        return Storage::url('public/penelitian/proposal/'.$this->proposal);
    }
    public function getKontrakUrlAttribute(){
        return Storage::url('public/penelitian/kontrak/'.$this->kontrak);
    }
    public function getKemajuanUrlAttribute(){
        return Storage::url('public/penelitian/laporan'.$this->laporan_kemajuan);
    }
    public function getAkhirUrlAttribute(){
        return Storage::url('public/penelitian/laporan'.$this->laporan_akhir);
    }
}
