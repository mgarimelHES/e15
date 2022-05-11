@extends('layouts/main')

@section('head')
    <link href='/css/list/show.css' rel='stylesheet'>
@endsection

@section('title')
    Your Parking List
@endsection

@section('content')

    @if ($parkings->count() == 0)
        <p test='no-parkings-message'>You have not added any of your parkings to your list yet.</p>
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

                <form method='POST' action='/list/{{ $parking->slug }}/update'>
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <textarea class='comments' name='comments'
                        test='{{ $parking->slug }}-comments-textarea'>{{ $parking->pivot->comments }}</textarea>
                    <button type='submit' class='btn btn-primary' test='{{ $parking->slug }}-update-button'>Update
                        comments</button>
                </form>

                <p class='added'>
                    Added {{ $parking->pivot->created_at->diffForHumans() }}
                </p>
                @include('includes/remove-from-list')
            </div>
        @endforeach
    @endif

@endsection
