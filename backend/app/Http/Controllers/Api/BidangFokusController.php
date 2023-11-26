<?php

namespace App\Http\Controllers\Api;

use App\Models\BidangFokus;
use App\Http\Resources\BidangFokusResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BidangFokusController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get bidang_fokus
        $bidang_fokuses = BidangFokus::all();

        //return collection of bidang_fokuses as a resource
        return new BidangFokusResource(true, 'List Data Bidang Fokus', $bidang_fokuses);
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
            'bidang_fokus'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $bidang_fokuses = BidangFokus::create([
            'bidang_fokus'   => $request->bidang_fokus,
        ]);

        //return response
        return new BidangFokusResource(true, 'Data Bidang Fokus Berhasil Ditambahkan!', $bidang_fokuses);
    }

      /**
     * show
     *
     * @param  mixed $bidangfokuses
     * @return void
     */
    public function show($id)
    {
        $bidang_fokuses = BidangFokus::find($id);
        //return single bidang fokus as a resource
        return new BidangFokusResource(true, 'Data Bidang Fokus Ditemukan!', $bidang_fokuses);
    }

    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'bidang_fokus'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // mencari data bidang fokus yang akan diupdate
        $bidang_fokuses = BidangFokus::find($id);

        // update data bidang fokus
        $bidang_fokuses->bidang_fokus = $request->input('bidang_fokus');
        $bidang_fokuses->save();

        //return response
        return new BidangFokusResource(true, 'Data Bidang Fokus Berhasil Diubah!', $bidang_fokuses);
    }

    public function destroy($id)
    {
        // mencari data bidang fokus yang akan dihapus
        $bidang_fokuses = BidangFokus::find($id);

        // jika bidang fokus tidak ditemukan, kembalikan pesan error
        if (!$bidang_fokuses) {
            return response()->json([
                'success' => false,
                'message' => 'Bidang fokus tidak ditemukan',
                'data' => null
            ], 404);
        }

        // hapus data bidang fokus
        $bidang_fokuses->delete();

        //return response
        return new BidangFokusResource(true, 'Data Bidang Fokus Berhasil Dihapus!', $bidang_fokuses);
    }
}
