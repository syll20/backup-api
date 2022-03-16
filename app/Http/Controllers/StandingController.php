<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StandingController extends Controller
{
    public function index()
    {
        return view('admin.standings');
    }
}
