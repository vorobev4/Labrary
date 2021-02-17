<?php

namespace App\Http\Controllers;

use App\Models\AuthorTables;
use App\Models\BookAuthUnif;
use App\Models\BooksTable;
use Illuminate\Http\Request;

class BookAdd extends Controller
{
    public function book_add() {
        $books = BooksTable::all();
        $authors = AuthorTables::all();
        $baUnif = BookAuthUnif::all();
        return view('page.books_add', compact('books','authors','baUnif'));
    }
}
