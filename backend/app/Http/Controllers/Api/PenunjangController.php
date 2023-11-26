<?php

namespace App\Http\Controllers\Api;
use App\Models\Penunjang;
use App\Http\Resources\PenunjangResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PenunjangController extends Controller
{
     /**
    * index
    *
    * @return void
    */
   public function index()
   {
       //get posts
       $penunjangs = Penunjang::all();

       //return collection of posts as a resource
       return new PenunjangResource(true, 'List Data penunjangs', $penunjangs);
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
            'nama_kegiatan' => 'required',
            'peran' => 'required',
            'nilai' => 'required',
            'bukti_kegiatan' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bukti_kegiatan = $request->file('bukti_kegiatan');
        $buktiKegiatanName = time() . '_' . $bukti_kegiatan->getClientOriginalName();
        $bukti_kegiatan->storeAs('public/penunjang/', $buktiKegiatanName);

        //create Penunjang
        $penunjangs = Penunjang::create([
            'user_id'     => $request->user_id,
            'tahun_akademik'     => $request->tahun_akademik,
            'nama_kegiatan'     => $request->nama_kegiatan,
            'peran'     => $request->peran,
            'nilai'     => $request->nilai,
            'bukti_kegiatan'     => $buktiKegiatanName,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        //return response
        return new PenunjangResource(true, 'Data Penunjang Berhasil Ditambahkan!', $penunjangs);
    }

    /**
     * show
     *
     * @param  mixed $penunjangs
     * @return void
     */
    public function show($id)
    {
        $penunjangs = Penunjang::find($id);
        //return single jenis publikasi as a resource
        return new PenunjangResource(true, 'Data Penunjang Ditemukan!', $penunjangs);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'user_id'     => 'required',
            'tahun_akademik' => 'required',
            'nama_kegiatan' => 'required',
            'peran' => 'required',
            'nilai' => 'required',
            'keterangan' => 'required',
            'status' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data Penunjang yang akan diupdate
        $penunjangs = Penunjang::find($id);

         //check if image is not empty
         if ($request->hasFile('bukti_kegiatan')) {

            //upload image
            $bukti_kegiatan = $request->file('bukti_kegiatan');
            $buktiKegiatanName = time() . '_' . $bukti_kegiatan->getClientOriginalName();
            $bukti_kegiatan->storeAs('public/penunjang/', $buktiKegiatanName);

            //delete old image
            Storage::delete('public/penunjang/'.$penunjangs->bukti_kegiatan);

            //update post with new image
            $penunjangs->update([
            'user_id'     => $request->user_id,
            'tahun_akademik'     => $request->tahun_akademik,
            'nama_kegiatan'     => $request->nama_kegiatan,
            'peran'     => $request->peran,
            'nilai'     => $request->nilai,
            'bukti_kegiatan'     => $buktiKegiatanName,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            ]);

        } else {

            //update post without image
            $penunjangs->update([
                'user_id'     => $request->user_id,
                'tahun_akademik'     => $request->tahun_akademik,
                'nama_kegiatan'     => $request->nama_kegiatan,
                'peran'     => $request->peran,
                'nilai'     => $request->nilai,
                'keterangan' => $request->keterangan,
                'status' => $request->status,
            ]);
        }

        //return response
        return new PenunjangResource(true, 'Penunjang Berhasil Diubah!', $penunjangs);
    }
}
