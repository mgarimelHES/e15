@extends('layouts/main')

@section('title')
    All Parking Receipts
@endsection

@section('head')
    <link href='/css/parkings/index.css' rel='stylesheet'>
@endsection

@section('content')

    @if (session('flash-alert'))
        <div class='flash-alert'>
            {{ session('flash-alert') }}
    @endif
    <h1>All Parking Receipts</h1>

    @if (count($parkings) != 0)
        <div id='newParkings'>
            <h2>New Parkings</h2>
            <ul class='clean-list'>
                @foreach ($newParkings as $parking)
                    <li><a test='new-parking-link'
                            href='/parkings/{{ $parking->slug }}'>{{ $parking->license_plate }}</a></li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (count($parkings) == 0)
        <p>No parkings have been occupied yet...</p>
    @else
        <div id='parkings'>
            @foreach ($parkings as $parking)
                <a class='parking' href='/parkings/{{ $parking->slug }}'>
                    <h3>{{ $parking->lot }}</h3>
                    <img class='cover' src='{{ $parking->plate_img }}'>
                </a>
            @endforeach
        </div>
    @endif
@endsection
