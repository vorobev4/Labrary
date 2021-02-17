@extends('labrary')
<?php
    use Illuminate\Support\Facades\DB;
?>
@section('content')



    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">ФИО</th>
            <th scope="col">Кол-во книг</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>

        @foreach($authors as $author)

            <?php
            $quantity = 0;
            ?>

            <tr>
                <th scope="row">{{$author->id}}</th>
                <td>{{$author->author_name}}</td>
                <td>

                    @foreach($baUnif as $unif)
                        @if($unif->author_id == $author->id)
                            <?php
                                $quantity++;
                            ?>
                        @endif

                    @endforeach
                        {{$quantity}}
                </td>
                <td>
                    <form action="" method="get">
                        <button name="author_edit" value="{{ $author->id }}" class="btn btn-outline-primary">Редактировать</button>
                        <button name="author_del" value="{{ $author->id }}" class="btn btn-outline-primary">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>

    <form action="" method="get">
        <button name="add" class="btn btn-outline-primary">Добавить автора</button>
    </form>
@endsection
<?php
    if (isset($_GET['author_edit'])) {
        header("Refresh: 0; URL=/authors_editing/".$_GET['author_edit']);
    }
    if (isset($_GET['add'])) {
        header("Refresh: 0; URL=/authors_add");
    }
    if (isset($_GET['author_del'])) {
        DB::delete('DELETE FROM `author_tables` WHERE `author_tables`.`id` = ?', [$_GET['author_del']]);
        DB::delete('DELETE FROM `book_auth_unifs` WHERE `book_auth_unifs`.`author_id` = ?', [$_GET['author_del']]);
        header('Refresh: 0; URL='.$_SERVER['HTTP_REFERER']);
    }
?>
