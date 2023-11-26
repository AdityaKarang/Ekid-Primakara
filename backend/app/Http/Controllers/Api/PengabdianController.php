<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengabdian;
use App\Http\Resources\PengabdianResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class PengabdianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pengabdians = Pengabdian::with("user")->get();
        foreach($pengabdians as $key => $value){
            $pengabdians[$key]["name_user"] = $value->user->name;
            $pengabdians[$key]["prodi"] = $value->user->prodi;
        }



        //return collection of posts as a resource
        return new PengabdianResource(true, 'List Data pengabdians', $pengabdians);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'user_id'     => 'required',
            'tahun_akademik' => 'required',
            'semester' => 'required',
            'judul' => 'required',
            'anggota_dosen_1' => 'required',
            'mahasiswa_1' => 'required',
            'mahasiswa_2' => 'required',
            'bidang_fokus' => 'required',
            'mitra' => 'required',
            'bentuk_dana' => 'required',
            'sumber_dana' => 'required',
            'jumlah_dana' => 'required',
            'status' => 'required',
            'proposal' => 'required',
        ]);


        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload_pdf
        $proposal = $request->file('proposal');
        $proposalName = time() . '_' . $proposal->getClientOriginalName();
        $proposal->storeAs('public/pengabdian/proposal/', $proposalName);

        //create Pengabdian
        $pengabdians = Pengabdian::create([
            'user_id'     => $request->user_id,
            'tahun_akademik'     => $request->tahun_akademik,
            'semester'     => $request->semester,
            'judul'     => $request->judul,
            'anggota_dosen_1'     => $request->anggota_dosen_1,
            'anggota_dosen_2'     => $request->anggota_dosen_2,
            'mahasiswa_1' => $request->mahasiswa_1,
            'mahasiswa_2' => $request->mahasiswa_2,
            'bidang_fokus' => $request->bidang_fokus,
            'mitra' => $request->mitra,
            'bentuk_dana' => $request->bentuk_dana,
            'sumber_dana' => $request->sumber_dana,
            'jumlah_dana' => $request->jumlah_dana,
            'status' => $request->status,
            'proposal' => $proposalName,
        ]);

        //return response
        return new PengabdianResource(true, 'Data Pengabdian Berhasil Ditambahkan!', $pengabdians);
    }

    public function update(Request $request, $id)
    {
        $oldFiles = Pengabdian::find($id)->delete();

                  // Define validation rules
                  $validator = Validator::make($request->all(), [
                    'user_id' => 'required',
                    'tahun_akademik' => 'required',
                    'semester' => 'required',
                    'judul' => 'required',
                    'anggota_dosen_1' => 'required',
                    'mahasiswa_1' => 'required',
                    'mahasiswa_2' => 'required',
                    'bidang_fokus' => 'required',
                    'mitra' => 'required',
                    'bentuk_dana' => 'required',
                    'sumber_dana' => 'required',
                    'jumlah_dana' => 'required',
                    'status' => 'required',
                    'proposal' => 'required|file|mimes:pdf',
                ]);
            
                // Check if validation fails
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }
            
                // Upload proposal file
                $proposal = $request->file('proposal');
                $proposalName = time() . '_' . $proposal->getClientOriginalName();
                $proposal->storeAs('public/pengabdian/proposal/', $proposalName);
            
                // Create Pengabdian
                $pengabdians = Pengabdian::create([
                    'user_id' => $request->user_id,
                    'tahun_akademik' => $request->tahun_akademik,
                    'semester' => $request->semester,
                    'judul' => $request->judul,
                    'anggota_dosen_1' => $request->anggota_dosen_1,
                    'anggota_dosen_2' => $request->anggota_dosen_2,
                    'mahasiswa_1' => $request->mahasiswa_1,
                    'mahasiswa_2' => $request->mahasiswa_2,
                    'bidang_fokus' => $request->bidang_fokus,
                    'mitra' => $request->mitra,
                    'bentuk_dana' => $request->bentuk_dana,
                    'sumber_dana' => $request->sumber_dana,
                    'jumlah_dana' => $request->jumlah_dana,
                    'status' => $request->status,
                    'proposal' => $proposalName,
                ]);
            
                // Return response
                return new PengabdianResource(true, 'Data Penelitian Berhasil Ditambahkan!', $pengabdians);
    }
    /**
     * show
     *
     * @param  mixed $pengabdians
     * @return void
     */
    public function show($id)
    {
        $pengabdians = Pengabdian::with('laporankemajuan', 'laporanakhir')->find($id);
        //return single jenis publikasi as a resource
        return new PengabdianResource(true, 'Data Pengabdian Ditemukan!', $pengabdians);
    }

    //add laporan kemajuan
    public function storeLaporanKemajuan(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'laporan_kemajuan' => 'required',
        ]);

        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = time() . '_' . $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/pengabdian/laporan', $laporanKemajuanName);

        $pengabdians->laporan_kemajuan = $laporanKemajuanName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Laporan Kemajuan Berhasil Ditambahkan!', $pengabdians);
    }

    //update laporan kemajuan
    public function updateLaporanKemajuan(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'laporan_kemajuan' => 'required',
        ]);

        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = time() . '_' . $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/pengabdian/laporan/', $laporanKemajuanName);

        $oldLaporanKemajuan = $pengabdians->laporan_kemajuan;
        if ($oldLaporanKemajuan) {
            // hapus file laporan kemajuan lama
            Storage::delete('public/pengabdian/laporan/' .$oldLaporanKemajuan);
        }

        $pengabdians->laporan_kemajuan = $laporanKemajuanName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Laporan Kemajuan Berhasil Diubah!', $pengabdians);
    }

    //add laporan akhir
    public function storeLaporanAkhir(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'laporan_akhir' => 'required',
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = time() . '_' . $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('public/pengabdian/laporan', $laporanAkhirName);

        $pengabdians->laporan_akhir = $laporanAkhirName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Laporan Akhir Berhasil Ditambahkan!', $pengabdians);
    }

    //update laporan akhir
    public function updateLaporanAkhir(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'laporan_akhir' => 'required',
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = time() . '_' . $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('public/pengabdian/laporan/', $laporanAkhirName);

        $oldLaporanAkhir = $pengabdians->laporan_akhir;
        if ($oldLaporanAkhir) {
            // hapus file laporan akhir lama
            Storage::delete('public/pengabdian/laporan/' .$oldLaporanAkhir);
        }

        $pengabdians->laporan_akhir = $laporanAkhirName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Laporan Akhir Berhasil Diubah!', $pengabdians);
    }

    public function updateStatus(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);
        $pengabdians->status = $request->status;
        $pengabdians->save();

        return new PengabdianResource(true, 'Berhasil!', $pengabdians);
    }
    public function storeKontrak(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'kontrak' => 'required',
            'status' => 'required'
        ]);
        
        $pengabdians->status = $request->status;

        $kontrak = $request->file('kontrak');
        $kontrakName = time() . '_' . $kontrak->getClientOriginalName();
        $kontrak->storeAs('public/pengabdian/kontrak', $kontrakName);
        $pengabdians->kontrak = $kontrakName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Kontrak Berhasil Ditambahkan!', $pengabdians);
    }

    //update Kontrak
    public function updateKontrak(Request $request, $id)
    {
        $pengabdians = Pengabdian::findOrFail($id);

        $request->validate([
            'kontrak' => 'required',
        ]);

        $kontrak = $request->file('kontrak');
        $kontrakName = time() . '_' . $kontrak->getClientOriginalName();
        $kontrak->storeAs('penelitian/kontrak', $kontrakName);

        $oldkontrak = $pengabdians->kontrak;
        if ($oldkontrak) {
            // hapus file Kontrak lama
            Storage::delete('penelitian/kontrak/' .$oldkontrak);
        }

        $pengabdians->laporan_akhir = $kontrakName;
        $pengabdians->save();

        return new PengabdianResource(true, 'Kontrak Berhasil Diubah!', $pengabdians);
    }

    public function updateReviewer(Request $request, $id)
    {
        $pengabdians = Pengabdian::find($id);

            $pengabdians->update([
                'reviewer_1'     => $request->reviewer_1,
                'reviewer_2'     => $request->reviewer_2,
            ]);
        //return response
        return new PengabdianResource(true, 'reviewer berhasil ditambahkan!', $pengabdians);
    }

    public function showValueProposal($id) {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Proposal')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])
        ->where('reviewer_1', $id)
        ->orWhere('reviewer_2', $id)
        ->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    public function showValueKemajuan($id) {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Kemajuan')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])
        ->where('reviewer_1', $id)
        ->orWhere('reviewer_2', $id)
        ->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    public function showValueAkhir($id) {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Akhir')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])
        ->where('reviewer_1', $id)
        ->orWhere('reviewer_2', $id)
        ->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    public function getValueProposal() {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Proposal')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    
    public function getValueKemajuan() {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Kemajuan')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }

    public function getValueAkhir() {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Akhir')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }

    public function getValuePublikasi() {
        $combinedData = Pengabdian::with([
            'publishcation',
            'user'
        ])->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    public function getValueKemajuanAkhir() {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where(function($q) {
                    $q->where('jenis', 'Kemajuan')->orWhere('jenis', 'Akhir');
                })->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'publishcation',
            'user'
        ])->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }

    public function showValueKemajuanAkhir($id) {
        // Temukan penelitian berdasarkan ID dengan data terkait
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where(function($q) {
                    $q->where('jenis', 'Kemajuan')->orWhere('jenis', 'Akhir');
                })->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'publishcation',
            'user'
        ])->find($id);
    
        // Jika penelitian tidak ditemukan, kembalikan respons sesuai kebutuhan aplikasi
        if (!$combinedData) {
            return response()->json(['message' => 'Data penelitian tidak ditemukan.'], 404);
        }
    
        // Tambahkan informasi tambahan ke dalam data
        $combinedData["name_user"] = $combinedData->user->name;
        $combinedData["prodi"] = $combinedData->user->prodi;
    
        // Kembalikan data penelitian dengan informasi tambahan
        return response()->json(['data' => $combinedData], 200);
    }

    public function showValue($id) {
        $combinedData = Pengabdian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Proposal')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user'
        ])->where('id', $id)->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
}
