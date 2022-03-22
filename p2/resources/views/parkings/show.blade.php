@extends('layouts/main')

@section('title')
    {{ $parking ? $parking['lot'] : 'Lot not found' }}
@endsection

@section('head')
    {{-- Parking Page specific CSS includes should be defined here; --}}
    <link href='/css/parkings/show.css' rel='stylesheet'>
@endsection


@section('content')
    @if (!$parking)
        Parking Receipt not found. <a href='/parkings'>Check out the other parking receipts in the current history...</a>
    @else
        <img class='cover' src='{{ $parking['plate_img'] }}' alt='Cover photo for {{ $parking['lot'] }}'>

        <h1>{{ $parking['lot'] }}</h1>

        <a href='{{ $parking['hes_parking_url'] }}'>HES Parking Information...</a>

        <p class='description'>
            {{ $parking['terms'] }}
            <a href='{{ $parking['hes_parking_url'] }}'>Learn more HERE!...</a>
        </p>
    @endif
@endsection
