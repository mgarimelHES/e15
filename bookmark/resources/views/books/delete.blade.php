@extends('layouts/main')

@section('head')
    <link href='/css/books/delete.css' rel='stylesheet'>
@endsection

@section('title')
    Confirm deleting a book {{ $book->title }}
@endsection

@section('content')
    <h1>Confirm deletion!</h1>

    <p>Are you sure you want to delete <strong>{{ $book->title }}</strong>?</p>

    <form method='POST' action='/books/{{ $book->slug }}'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}
        {{ method_field('delete') }}

        <button type='submit' class='btn btn-danger btn-small'>Yes, delete it!!</button>
    </form>

    <p class='cancel'>
        <a href='/books/{{ $book->slug }} '>No, I want to keep it.</a>
    @endsection
