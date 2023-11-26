<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penelitian;
use App\Http\Resources\PenelitianResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PenelitianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $penelitians = Penelitian::with("user")->get();
        foreach($penelitians as $key => $value){
            $penelitians[$key]["name_user"] = $value->user->name;
            $penelitians[$key]["prodi"] = $value->user->prodi;
        }


        //return collection of posts as a resource
        return new PenelitianResource(true, 'List Data Penelitians', $penelitians);
    }

        public function store(Request $request)
        {
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
            $proposal->storeAs('public/penelitian/proposal/', $proposalName);
        
            // Create Penelitian
            $penelitians = Penelitian::create([
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
            return new PenelitianResource(true, 'Data Penelitian Berhasil Ditambahkan!', $penelitians);
        }
        
        public function update(Request $request, $id)
        {
            $oldFiles = Penelitian::find($id)->delete();
    
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
                    $proposal->storeAs('public/penelitian/proposal/', $proposalName);
                
                    // Create Penelitian
                    $penelitians = Penelitian::create([
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
                    return new PenelitianResource(true, 'Data Penelitian Berhasil Ditambahkan!', $penelitians);
    }


        
        

    /**
     * show
     *
     * @param  mixed $penelitians
     * @return void
     */
    public function show($id)
    {
        $penelitians = Penelitian::with('laporankemajuan', 'laporanakhir')->find($id);
        //return single jenis publikasi as a resource
        return new PenelitianResource(true, 'Data Penelitian Ditemukan!', $penelitians);
    }
    

    
    //add laporan kemajuan
    public function storeLaporanKemajuan(Request $request, $id)
    {
        $penelitians = Penelitian::findOrFail($id);

        $request->validate([
            'laporan_kemajuan' => 'required',
        ]);

        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = time() . '_' . $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/penelitian/laporan', $laporanKemajuanName);

        $penelitians->laporan_kemajuan = $laporanKemajuanName;
        $penelitians->save();

        return new PenelitianResource(true, 'Laporan Kemajuan Berhasil Ditambahkan!', $penelitians);
    }

    //update laporan kemajuan
    public function updateLaporanKemajuan(Request $request, $id)
    {
        // dd($penelitians);
        $penelitians = Penelitian::findOrFail($id);
    
        $request->validate([
            'laporan_kemajuan' => 'required',
        ]);
    
        $laporanKemajuan = $request->file('laporan_kemajuan');
        $laporanKemajuanName = time() . '_' . $laporanKemajuan->getClientOriginalName();
        $laporanKemajuan->storeAs('public/penelitian/laporan', $laporanKemajuanName);
    
        // Hapus file laporan sebelumnya jika ada
        if ($penelitians->laporan_kemajuan) {
            Storage::delete('public/penelitian/laporan/' . $penelitians->laporan_kemajuan);
        }
    
        $penelitians->laporan_kemajuan = $laporanKemajuanName;
        $penelitians->save();
    
        return new PenelitianResource(true, 'Laporan Kemajuan Berhasil Diperbarui!', $penelitians);
    }
    
    
    
    

    //add laporan akhir
    public function storeLaporanAkhir(Request $request, $id)
    {
        $penelitians = Penelitian::findOrFail($id);

        $request->validate([
            'laporan_akhir' => 'required',
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = time() . '_' . $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('public/penelitian/laporan', $laporanAkhirName);
        $penelitians->laporan_akhir = $laporanAkhirName;
        $penelitians->save();

        return new PenelitianResource(true, 'Laporan Akhir Berhasil Ditambahkan!', $penelitians);
    }

    //update laporan akhir
    public function updateLaporanAkhir(Request $request, $id)
    {
        $penelitians = Penelitian::findOrFail($id);

        $request->validate([
            'laporan_akhir' => 'required',
        ]);

        $laporanAkhir = $request->file('laporan_akhir');
        $laporanAkhirName = time() . '_' . $laporanAkhir->getClientOriginalName();
        $laporanAkhir->storeAs('penelitian/laporan', $laporanAkhirName);

        $oldLaporanAkhir = $penelitians->laporan_akhir;
        if ($oldLaporanAkhir) {
            // hapus file laporan akhir lama
            Storage::delete('penelitian/laporan/' .$oldLaporanAkhir);
        }

        $penelitians->laporan_akhir = $laporanAkhirName;
        $penelitians->save();

        return new PenelitianResource(true, 'Laporan Akhir Berhasil Diubah!', $penelitians);
    }
    //add Kontrak
    public function storeKontrak(Request $request, $id)
    {
        $penelitians = Penelitian::findOrFail($id);

        $request->validate([
            'kontrak' => 'required',
            'status' => 'required'
        ]);
        $penelitians->status = $request->status;

        $kontrak = $request->file('kontrak');
        $kontrakName = time() . '_' . $kontrak->getClientOriginalName();
        $kontrak->storeAs('public/penelitian/kontrak', $kontrakName);
        $penelitians->kontrak = $kontrakName;
        $penelitians->save();

        return new PenelitianResource(true, 'Kontrak Berhasil Ditambahkan!', $penelitians);
    }
    public function updateStatus(Request $request, $id)
    {
        $penelitians = Penelitian::findOrFail($id);

        $request->validate([
            'status' => 'required'
        ]);
        $penelitians->status = $request->status;
        $penelitians->save();

        return new PenelitianResource(true, 'Kontrak Berhasil Ditambahkan!', $penelitians);
    }

    //update Kontrak
    public function updateKontrak(Request $request, $id)
    {
        // Define validation rules for update
        $validator = Validator::make($request->all(), [
            'status' => 'required',
            'kontrak' => 'nullable|file|mimes:pdf',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Get the Penelitian record
        $penelitian = Penelitian::find($id);
    
        if (!$penelitian) {
            return response()->json(['message' => 'Penelitian not found'], 404);
        }
    
        // Update status
        $penelitian->status = $request->status;
    
        // Handle kontrak file upload
        if ($request->hasFile('kontrak')) {
            $kontrak = $request->file('kontrak');
            $kontrakName = time() . '_' . $kontrak->getClientOriginalName();
            $kontrak->storeAs('public/penelitian/kontrak/', $kontrakName);
            $penelitian->kontrak = $kontrakName;
        }
    
        $penelitian->save();
    
        // Return response
        return new PenelitianResource(true, 'Data Penelitian Berhasil Diperbarui!', $penelitian);
    }

    public function updateReviewer(Request $request, $id)
    {
        $penelitians = Penelitian::find($id);

            $penelitians->update([
                'reviewer_1'     => $request->reviewer_1,
                'reviewer_2'     => $request->reviewer_2,
            ]);
        //return response
        return new PenelitianResource(true, 'reviewer berhasil ditambahkan!', $penelitians);
    }

    public function showPenilaianProposal($id) {
        $combinedData = Penelitian::with([
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
    public function showPenilaianKemajuan($id) {
        $combinedData = Penelitian::with([
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
    public function showPenilaianAkhir($id) {
        $combinedData = Penelitian::with([
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
    
    // public function getValueProposal() {
    //     $combinedData = Penelitian::with(['datapenilaian.valuepenelitian', 'laporankemajuan', 'laporanakhir', 'user'])->get();
    
    //     foreach($combinedData as $key => $value){
    //         $combinedData[$key]["name_user"] = $value->user->name;
    //         $combinedData[$key]["prodi"] = $value->user->prodi;
    //     }
    
    //     return $combinedData;
    // }
    public function getValueProposal() {
        $combinedData = Penelitian::with([
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
        $combinedData = Penelitian::with([
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
        $combinedData = Penelitian::with([
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
        $combinedData = Penelitian::with([
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
        $combinedData = Penelitian::with([
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
        $combinedData = Penelitian::with([
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
    
    
    public function showValueKemajuan($id) {
        $combinedData = Penelitian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Kemajuan')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user' // Include 'user' relationship
        ])->where('id', $id)->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }
    public function showValueAkhir($id) {
        $combinedData = Penelitian::with([
            'datapenilaian' => function($query) {
                $query->where('jenis', 'Akhir')->with('valuepenilaian');
            },
            'laporankemajuan', 
            'laporanakhir',
            'user' // Include 'user' relationship
        ])->where('id', $id)->get();
    
        foreach($combinedData as $key => $value){
            $combinedData[$key]["name_user"] = $value->user->name;
            $combinedData[$key]["prodi"] = $value->user->prodi;
        }
    
        return $combinedData;
    }


    public function showValue($id) {
        $combinedData = Penelitian::with([
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

