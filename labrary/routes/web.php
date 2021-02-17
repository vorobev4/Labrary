<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LabraryController@labrary');


Route::get('/books', 'Pagination@books');
Route::get('/books_editing_show', 'Editing@books_editing_show');
Route::get('/books_editing/{id}', 'Editing@books_editing_show');
Route::get('/book_add', 'BookAdd@book_add');


Route::get('/authors', 'Pagination@authors');
Route::get('/authors_editing_show', 'Editing@authors_editing_show');
Route::get('/authors_editing/{id}', 'Editing@authors_editing_show');
Route::get('/authors_add', 'AuthorAdd@authors_add');





