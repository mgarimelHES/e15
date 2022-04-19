@extends('layouts/main')

@section('head')
    <link href='/css/parkings/delete.css' rel='stylesheet'>
@endsection

@section('title')
    Confirm deleting a spefic parking slot {{ $parking->plate }}
@endsection

@section('content')
    <h1>Confirm deletion!!</h1>

    <p>Are you sure you want to delete <strong>{{ $parking->plate }}</strong>?</p>
    <p>Please aware that once you delete or exit, you have to pay again to park.</p>

    <form method='POST' action='/parkings/{{ $parking->slug }}'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}
        {{ method_field('delete') }}

        <button type='submit' class='btn btn-danger btn-small'>Yes, delete it!!</button>
    </form>

    <p class='cancel'>
        <a href='/parkings/{{ $parking->slug }} '>No, I want to keep it.</a>
    @endsection
