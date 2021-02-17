@extends('labrary')

@section('content')

    <h4>Добавить автора</h4>
    <form action="" method="get">
        <p>Введите ФИО нового автора</p>
        <input type="text" name="name" id="name">
        <br>
        <button type="submit" name="add" class="btn btn-outline-primary">Добавить</button>
    </form>

@endsection
<?php
    if (isset($_GET['add'])) {
        if (!empty($_GET['name'])) {
            DB::update('INSERT INTO `author_tables` (author_name) value (?)', [$_GET['name']]);
        }
        header('Refresh: 0; URL='.$_SERVER['HTTP_REFERER']);
    }


?>
