<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BooksTable;
use App\Models\AuthorTables;
use App\Models\BookAuthUnif;
use Illuminate\Support\Facades\DB;


class Editing extends Controller
{
    public function books_editing_show($id) {
        $books = BooksTable::all();
        $authors = AuthorTables::all();
        $baUnif = BookAuthUnif::all();
        return view('page.books_editing_show', ['this_book' => BooksTable::findOrFail($id)], compact('books',
            'authors','baUnif'));
    }
    public function authors_editing_show($id) {
        return view('page.authors_editing_show', ['this_author' => AuthorTables::findOrfail($id)]);
    }
}
