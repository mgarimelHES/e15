@extends('layouts/main')

@section('title')
    Your Parking List
@endsection

@section('content')

    @if ($parkings->count() == 0)
        <p>You have not added any of your parkings to your list yet.</p>
        <p><a href='/parkings'>Find all parkings to add in our garage...</a></p>
    @else
        @foreach ($parkings as $parking)
            <div class='parking'>
                <a href='/parkings/{{ $parking->slug }}'>
                    <h2>{{ $parking->license_plate }}</h2>
                </a>

                @if ($parking->customer)
                    <p>By {{ $parking->customer->first_name . ' ' . $parking->customer->last_name }}</p>
                @endif

                {{-- In the following two paragraphs, observe how `$parking->pivot` is used to access 
            details (`created_at` and `comments`) from the parking to user relationship --}}
                <p class='comments'>
                    {{ $parking->pivot->comments }}
                </p>

                <p class='added'>
                    Added {{ $parking->pivot->created_at->diffForHumans() }}
                </p>
            </div>
        @endforeach
    @endif

@endsection
