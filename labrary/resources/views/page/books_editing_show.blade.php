<?php
    use Illuminate\Support\Facades\DB;
?>
@extends('labrary')

@section('content')



    <form action="" method="get">
        <h4 style="text-align: center">{{$this_book->book_name}}</h4>
        <h5 style="text-align: center">{{$this_book->book_year}}</h5>
        <hr>
        <div style="display: flex; justify-content: space-around">
            <div>
                <p>Введите новое название</p>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <p>Введите новый год издания</p>
                <input type="number" name="year" id="year">
            </div>
        </div>
        <br>
        <div style="display: flex; justify-content: space-around;">
            <div>
                <p>Добавить автора</p>
                <select multiple="multiple" name="select_add[]" id="select_add">
                    @foreach($authors as $author)
                        <?php
                        $x = DB::select('SELECT * FROM `book_auth_unifs` WHERE `book_id` = ? and `author_id` = ?', [$this_book->id, $author->id]);
                        ?>
                        @if(count($x) == 0)
                            <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div>
                <p>Удалить автора</p>
                <select multiple="multiple" name="select_del[]" id="select_del">
                    @foreach($baUnif as $unif)
                        @if($unif->book_id == $this_book->id)
                            @foreach($authors as $author)
                                @if($author->id == $unif->author_id)
                                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <button type="submit" name="btn" class="btn btn-outline-primary">Изменить</button>
    </form>
    @php
        if(isset($_GET['btn'])) {
            if(!($_GET['name'] === '')) {
                DB::update('UPDATE `books_tables` SET `book_name` = ? WHERE `books_tables`.`id` = ?;', [$_GET['name'], $this_book->id]);
            }
            if(!($_GET['year'] === '')) {
                DB::update('UPDATE `books_tables` SET `book_year` = ? WHERE `books_tables`.`id` = ?;', [$_GET['year'], $this_book->id]);
            }
            if(!empty($_GET['select_add'])) {
                foreach ($_GET['select_add'] as $getAdd) {
                    DB::update('INSERT INTO `book_auth_unifs` (book_id, author_id) value (?, ?)', [$this_book->id, $getAdd]);
                }
            }
            if(!empty($_GET['select_del'])) {
                foreach ($_GET['select_del'] as $getDel) {
                    DB::delete('DELETE FROM `book_auth_unifs` WHERE book_id = (?) AND author_id = (?)', [$this_book->id, $getDel]);
                }
            }
            @endphp
                    <script type="text/javascript">
                        document.location.href = "/books_editing/{{ $this_book->id }}";
                    </script>
            @php
        }
    @endphp
@endsection
