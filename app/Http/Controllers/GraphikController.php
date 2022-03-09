<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GraphikController extends BaseController
{
    public function index()
    {
        return view('home');
    }
}

