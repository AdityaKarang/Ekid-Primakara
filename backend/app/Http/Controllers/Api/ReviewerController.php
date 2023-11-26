<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewerResource;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    public function index()
    {
        //get bentuk_danas
        $users = User::where("role", "reviewer")->get();

        //return collection of bentuk_danas as a resource
        return new ReviewerResource(true, 'List Data Reviewer', $users);
    }
}
