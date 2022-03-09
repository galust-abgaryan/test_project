<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GraphikController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return view('home', compact('users'));
    }
}

