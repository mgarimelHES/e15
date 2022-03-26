@extends('layouts/main')

@section('title')
    All Parking Receipts
@endsection

@section('head')
    <link href='/css/parkings/index.css' rel='stylesheet'>
@endsection

@section('content')
    <h1>All Parking Receipts</h1>

    @if (count($parkings) == 0)
        <p>No parkings have been occupied yet...</p>
    @else
        <div id='parkings'>
            @foreach ($parkings as $slug => $parking)
                <a class='parking' href='/parkings/{{ $slug }}'>
                    <h3>{{ $parking['lot'] }}</h3>
                    <img class='cover' src='{{ $parking['plate_img'] }}'>
                </a>
            @endforeach
        </div>
    @endif
@endsection
