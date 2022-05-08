@extends('layouts/main')

@section('title')
    {{ $book ? $book['title'] : 'Book not found' }}
@endsection

@section('head')
    <link href='/css/books/show.css' rel='stylesheet'>
@endsection

@section('content')
    @if (!$book)
        Book not found. <a href='/books'>Check out the other books in our library...</a>
    @else
        <img class='cover' src='{{ $book->cover_url }}' alt='Cover photo for {{ $book->title }}'>

        @if ($book->author)
            <p>By {{ $book->author->first_name . ' ' . $book->author->last_name }}</p>
        @endif

        <h1>{{ $book->title }}</h1>
        <p> By {{ $book->author->first_name . ' ' . $book->author->last_name }} ({{ $book->published_year }})</p>

        <a href='{{ $book->purchase_url }}'>Purchase...</a>

        <p class='description'>
            {{ $book->description }}
            <a href='{{ $book->info_url }}'>Learn more...</a>
        </p>
        <ul class='bookActions'>

            <li><a href='/books/{{ $book->slug }}/edit' test='edit-button' dusk='edit-button'><i
                        class="fa fa-edit"></i> Edit</a>
            <li><a href='/books/{{ $book->slug }}/delete' test='delete-button' dusk='delete-button'><i
                        class="fa fa-trash"></i> Delete</a>
                @if ($onList)
            <li>
                @include('includes/remove-from-list')
            </li>
        @else
            <li><a href='/list/{{ $book->slug }}/add' test='add-to-list-button' dusk='add-button'><i
                        class="fa fa-plus"></i> Add to your
                    list</a>
            </li>
    @endif
    </ul>
    @endif
@endsection
