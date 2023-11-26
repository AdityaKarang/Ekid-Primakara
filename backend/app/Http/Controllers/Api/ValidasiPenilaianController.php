<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ValidasiPenilaian;
use App\Http\Resources\ValidasiPenilaianResource;
use Illuminate\Http\Request;

class ValidasiPenilaianController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get validasi_penilaians
        $validasi_penilaians = ValidasiPenilaian::all();

        //return collection of validasi_penilaians as a resource
        return new ValidasiPenilaianResource(true, 'List Data Validasi Penilaian;', $validasi_penilaians);
    }

}
