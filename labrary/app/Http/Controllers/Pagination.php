<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BooksTable;
use App\Models\AuthorTables;
use App\Models\BookAuthUnif;

class Pagination extends Controller
{
    public function books() {
        $books = BooksTable::orderBy('book_name')->get();
        $authors = AuthorTables::all();
        $baUnif = BookAuthUnif::all();
        return view('page.books', compact('books','authors','baUnif'));
    }

    public function authors() {
        $books = BooksTable::all();
//        $authors = AuthorTables::all();
        $authors = AuthorTables::orderBy('author_name')->get();
        $baUnif = BookAuthUnif::all();
        return view('page.authors', compact('books','authors','baUnif'));
    }


}
