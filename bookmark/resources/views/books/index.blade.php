@extends('layouts/main')

@section('title')
    All Books
@endsection

@if (session('flash-alert'))
    <div class='flash-alert'>
        {{ session('flash-alert') }}
    </div>
@endif

@section('head')
    <link href='/css/books/index.css' rel='stylesheet'>
@endsection

@section('content')
    <h1 test='all-books-heading'>All Books</h1>

    @if (count($books) != 0)
        <div id='newBooks'>
            <h2>New Books</h2>
            <ul class='clean-list'>
                @foreach ($newBooks as $book)
                    <li><a test='new-book-link' href='/books/{{ $book->slug }}'>{{ $book->title }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (count($books) == 0)
        <p>No books have been added yet...</p>
    @else
        <div id='books'>
            @foreach ($books as $book)
                <a test='book-link-{{ $book->slug }}' class='book' href='/books/{{ $book->slug }}'>
                    <h3>{{ $book->title }}</h3>
                    <img class='cover' src='{{ $book->cover_url }}'>
                </a>
            @endforeach
        </div>
    @endif
@endsection
