@extends('layouts/main')

@section('title')
    Add {{ $parking->license_plate }} to your parking list
@endsection

@section('content')
    <h1>Add to your parking list</h1>
    <h2>{{ $parking->license_plate }}</h2>

    <form method='POST' action='/list/{{ $parking->slug }}/save'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='notes'>YOUR COMMENTS ON THIS PARKING</label>
        <textarea name='comments'>{{ old('comments') }}</textarea>

        <button class='btn btn-primary'>Add</button>
    </form>
@endsection
