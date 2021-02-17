<?php
use Illuminate\Support\Facades\DB;
?>

@extends('labrary')
{{-- попробовать отправить запрос в бд на сортировку по имени а после сделать вывод данных в таблицу --}}
@section('content')


    <form action="" method="get" class="form_select">
        <select name="select" id="select">
            @foreach($authors as $author)
                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
            @endforeach
        </select>
        <button name="btn" class="btn btn-outline-primary">Применить</button>
    </form>



    <!-- таблица первой загрузки -->
    <table class="table close_this_table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Название</th>
            <th scope="col">Автор(ы)</th>
            <th scope="col">Год издания</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->book_name }}</td>
            <td>
                @foreach($baUnif as $unif)
                    @if($unif->book_id == $book->id)
                        @foreach($authors as $author)
                            @if($unif->author_id == $author->id)
                                <li>{{ $author->author_name }}</li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </td>
            <td>{{ $book->book_year }}</td>
            <td>
                <form action="" method="get" style="display: flex">
                    <button name="edit" id="edit" value="{{ $book->id }}" class="btn btn-outline-primary">Редактировать</button>
                    <button name="delete" id="delete" value="{{ $book->id }}" class="btn btn-outline-primary">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <!-- таблица первой загрузки -->


    <!-- блок таблицы -->
    @php
        if (isset($_GET['btn'])) {

            $author_name_id = $_GET['select'];
        @endphp
            <script type="text/javascript">
                $('.close_this_table').css('display', 'none');
            </script>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Автор(ы)</th>
                        <th scope="col">Год издания</th>
                        <th scope="col">Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        @foreach($baUnif as $unif)
                            @if($unif->book_id == $book->id && $unif->author_id == $author_name_id)
                                <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->book_name }}</td>
                                    <td>
                                        @foreach($baUnif as $unif)
                                            @if($unif->book_id == $book->id)
                                                @foreach($authors as $author)
                                                    @if($author->id == $unif->author_id)
                                                        <li>{{ $author->author_name }}</li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $book->book_year }}</td>
                                    <td>
                                        <form action="" method="get">
                                            <button name="edit" id="edit" value="{{ $book->id }}" class="btn btn-outline-primary">Редактировать</button>
                                            <button name="delete" id="delete" value="{{ $book->id }}" class="btn btn-outline-primary">Удалить</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <hr>
        @php
        }
        if(isset($_GET['edit'])) {
            header("Refresh: 0; URL=/books_editing/".$_GET['edit']);
        }
        if(isset($_GET['delete'])) {
            DB::delete('DELETE FROM `books_tables` WHERE `books_tables`.`id` = ?', [$_GET['delete']]);
            DB::delete('DELETE FROM `book_auth_unifs` WHERE `book_auth_unifs`.`book_id` = ?', [$_GET['delete']]);
            header('Refresh: 0; URL='.$_SERVER['HTTP_REFERER']);
        }
    @endphp
    <!-- блок таблицы -->





    <form action="" method="get">
        <button name="add" id="add" class="btn btn-outline-primary">Добавить книгу</button>
    </form>
    <?php
        if (isset($_GET['add'])) {
            header("Refresh: 0; URL=/book_add");
        }
    ?>


@endsection



