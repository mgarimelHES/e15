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
        <img class='cover' src='{{ $parking->plate_img }}' alt='Parking lot photo for {{ $parking->lot }}'>

        <h1>{{ $parking->lot }}</h1>
        <p class='make'> Make & Model = {{ $parking->make }} && {{ $parking->model }} </p>
        <p class='plate'> License Plate = {{ $parking->license_plate }} </p>

        <a href='{{ $parking->hes_parking_url }}'>HES Parking Information...</a>

        <p class='description'>
            {{ $parking->terms }}
            <a href='{{ $parking->hes_parking_url }}'>Learn more HERE!...</a>
        </p>


        <ul class='bookActions'>

            <li><a test='edit-button' href='/parkings/{{ $parking->slug }}/edit' dusk='edit-button'><i
                        class="fa fa-edit"></i> Edit</a>
            <li><a test='delete-button' href='/parkings/{{ $parking->slug }}/delete' dusk='delete-button'><i
                        class="fa fa-trash"></i>
                    Delete</a>
                @if ($onList)
            <li>
                @include('includes/remove-from-list')
            </li>
        @else
            <li><a test='add-to-list-button' href='/list/{{ $parking->slug }}/add' dusk='add-button'><i
                        class="fa fa-plus"></i> Add to your
                    parking list</a>
            </li>
    @endif
    </ul>
    @endif
@endsection
