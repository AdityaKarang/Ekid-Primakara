<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataPenilaianResource;
use App\Models\DataPenilaian;
use App\Models\ValuePenelitian;
use App\Models\ValuePenilaian;
use App\Models\ValueKemajuan;
use App\Models\ValueAkhir;
use Illuminate\Http\Request;

class DataPenilaianController extends Controller
{
    public function getValuePenelitian() {
        $combinedData = DataPenilaian::with('valuepenelitian')
        ->whereNotNull('penelitian_id')
        ->get();
        return $combinedData;
    }
    public function getValuePengabdian() {
        $combinedData = DataPenilaian::with('valuepengabdian')
        ->whereNotNull('pengabdian_id')
        ->get();
        return $combinedData;
    }

    public function showValuePenelitian($penelitian_id) {
        $combinedData = DataPenilaian::with('valuepenelitian')
                                    ->where('penelitian_id', $penelitian_id)
                                    ->get();
    
        return $combinedData;
    }
    public function showValuePengabdian($pengabdian_id) {
        $combinedData = DataPenilaian::with('valuepengabdian')
                                    ->where('pengabdian_id', $pengabdian_id)
                                    ->get();
    
        return $combinedData;
    }
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data_penilaians
        $data_penilaians = DataPenilaian::all();

        //return collection of data_penilaians as a resource
        return new DataPenilaianResource(true, 'List Data Penilaian', $data_penilaians);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function storePenilaianPenelitian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiPenilaian = $request->input('nilaiPenilaian');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id'],
            'pengabdian_id' => $dataPenilaian['pengabdian_id'] ?? null,
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
            'jenis' => $dataPenilaian['jenis'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiPenilaian as $nilai) {
            ValuePenilaian::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'data_penilaian_id' => $dataPenilaian->id,
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storePenilaianPengabdian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiPenilaian = $request->input('nilaiPenilaian');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id']?? null,
            'pengabdian_id' => $dataPenilaian['pengabdian_id'],
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
            'jenis' => $dataPenilaian['jenis'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiPenilaian as $nilai) {
            ValuePenilaian::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'data_penilaian_id' => $dataPenilaian->id,
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storePenelitian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiPenelitian = $request->input('nilaiPenelitian');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id'],
            'pengabdian_id' => $dataPenilaian['pengabdian_id'] ?? null,
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiPenelitian as $nilai) {
            ValuePenelitian::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'data_penilaian_id' => $dataPenilaian->id,
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storePengabdian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiPenelitian = $request->input('nilaiPenelitian');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id']?? null,
            'pengabdian_id' => $dataPenilaian['pengabdian_id'],
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiPenelitian as $nilai) {
            ValuePengabdian::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'data_penilaian_id' => $dataPenilaian->id,
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storeKemajuanPenelitian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiKemajuan = $request->input('nilaiKemajuan');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id'],
            'pengabdian_id' => $dataPenilaian['pengabdian_id']?? null,
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiKemajuan as $nilai) {
            ValueKemajuan::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'data_penilaian_id' => $dataPenilaian->id,
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storeKemajuanPengabdian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiKemajuan = $request->input('nilaiKemajuan');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id']?? null,
            'pengabdian_id' => $dataPenilaian['pengabdian_id'],
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiKemajuan as $nilai) {
            ValueKemajuan::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'data_penilaian_id' => $dataPenilaian->id,
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storeAkhirPenelitian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiAkhir = $request->input('nilaiAkhir');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id'],
            'pengabdian_id' => $dataPenilaian['pengabdian_id']?? null,
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiAkhir as $nilai) {
            ValueAkhir::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'data_penilaian_id' => $dataPenilaian->id,
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }
    public function storeAkhirPengabdian(Request $request)
    {
        $dataPenilaian = $request->input('dataPenilaian');
        $nilaiAkhir = $request->input('nilaiAkhir');

        // Proses data penilaian
        $dataPenilaian = DataPenilaian::create([
            'penelitian_id' => $dataPenilaian['penelitian_id']?? null,
            'pengabdian_id' => $dataPenilaian['pengabdian_id'],
            'user_id' => $dataPenilaian['user_id'],
            'status' => $dataPenilaian['status'],
            'total' => $dataPenilaian['total'],
            'catatan' => $dataPenilaian['catatan'],
        ]);

        // Proses data nilai penelitian
        foreach ($nilaiAkhir as $nilai) {
            ValueAkhir::create([
                'kriteria_penilaian_id' => $nilai['kriteria_penilaian_id'],
                'kriteria' => $nilai['kriteria'],
                'bobot' => $nilai['bobot'],
                'indikator' => $nilai['indikator'],
                'data_penilaian_id' => $dataPenilaian->id,
                'value' => $nilai['value'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    /**
     * show
     *
     * @param  mixed $data_penilaians
     * @return void
     */
    public function show($id)
    {
        $data_penilaians = DataPenilaian::find($id);
        //return single bentuk as a resource
        return new DataPenilaianResource(true, 'Data Bidang Fokus Ditemukan!', $data_penilaians);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'kriteria_penilaian_id'     => 'required',
            'validasi_penilaian_id'     => 'required',
            'user_id'     => 'required',
            'total'     => 'required',
            'catatan'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data Penilaian yang akan diupdate
        $data_penilaians = DataPenilaian::find($id);

        // update data Penilaian
        $data_penilaians->kriteria_penilaian_id = $request->input('kriteria_penilaian_id');
        $data_penilaians->validasi_penilaian_id = $request->input('validasi_penilaian_id');
        $data_penilaians->user_id = $request->input('user_id');
        $data_penilaians->total = $request->input('total');
        $data_penilaians->catatan = $request->input('catatan');
        $data_penilaians->save();

        //return response
        return new DataPenilaianResource(true, 'Data Penilaian Berhasil Diubah!', $data_penilaians);
    }

    public function destroy($id)
    {
        // mencari data Penilaian yang akan dihapus
        $data_penilaians = DataPenilaian::find($id);

        // jika data Penilaian tidak ditemukan, kembalikan pesan error
        if (!$data_penilaians) {
            return response()->json([
                'success' => false,
                'message' => 'Penilaian tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data Penilaian
        $data_penilaians->delete();

        //return response
        return new DataPenilaianResource(true, 'Data Penilaian Berhasil Dihapus!', $data_penilaians);
    }
}
