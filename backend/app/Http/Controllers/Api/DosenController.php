<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DosenResource;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        //get bentuk_danas
        $users = User::where("role", "dosen")->get();

        //return collection of bentuk_danas as a resource
        return new DosenResource(true, 'List Data Dosen', $users);
    }
    public function show($id)
    {
        $users = User::findOrFail($id);
        return response()->json($users);
    }
}
