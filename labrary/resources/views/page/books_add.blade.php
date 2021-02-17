<?php
    use Illuminate\Support\Facades\DB;
?>
@extends('labrary')

@section('content')

    <form action="" method="get">
        <div style="display: flex;">
            <div>
                <p>Название книги</p>
                <input type="text" name="name"></div>
            <div>
                <p>Год издания</p>
                <input type="number" name="year">
            </div>
        </div>
        <br>
        <p>Выберите авторa(ов)</p>
        <select multiple="multiple" name="select[]" id="select">
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
            @endforeach
        </select>
        <hr>
        <button name="add" id="add" class="btn btn-outline-primary">Добавить</button>
    </form>
    <?php
        if (isset($_GET['add'])) {
            if ($_GET['name'] != '' && $_GET['year'] != '') {
                DB::update('INSERT INTO `books_tables` (book_name, book_year) VALUES (?, ?)', [$_GET['name'], $_GET['year']]);
                $limit_id = DB::select('SELECT id FROM books_tables ORDER BY id DESC LIMIT 1');

                if (!empty($_GET['select'])) {
                    $last = ($limit_id[0]->id);
                    foreach ($_GET['select'] as $elem) {
                        DB::update('INSERT INTO `book_auth_unifs` (book_id, author_id) VALUE (?, ?)', [$last, $elem]);
                    }
                }
            } else {
                echo 'Error';
            }
            header('Refresh: 0; URL='.$_SERVER['HTTP_REFERER']);
        }
    ?>
@endsection
