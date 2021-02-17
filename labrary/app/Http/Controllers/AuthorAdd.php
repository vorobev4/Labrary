<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorTables;

class AuthorAdd extends Controller
{
    public function authors_add() {
        $author = AuthorTables::all();
        return view('page.authors_add', compact('author'));
    }
}
