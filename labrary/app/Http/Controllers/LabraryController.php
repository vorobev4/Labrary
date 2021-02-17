<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabraryController extends Controller
{
    public function labrary() {
        return view('labrary');
    }
}
