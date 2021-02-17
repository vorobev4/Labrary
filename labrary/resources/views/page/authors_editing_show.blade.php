<?php
    use Illuminate\Support\Facades\DB;
?>
@extends('labrary')

@section('content')

    <h4>{{ $this_author->author_name }}</h4>
    <form action="" method="get">
        <p>Введите новое ФИО автора</p>
        <input type="text" name="name" id="name">
        <br>
        <button name="btn" class="btn btn-outline-primary">Изменить</button>
    </form>

@endsection
<?php
    if (isset($_GET['btn'])) {
        if (!empty($_GET['name'])) {
            DB::update('update `author_tables` set `author_name` = ? where `author_tables`.`id` = ?', [$_GET['name'], $this_author->id]);
        }
        ?>
        <script type="text/javascript">
            document.location.href = "/authors_editing/{{ $this_author->id }}";
        </script>
        <?php
    }
?>
