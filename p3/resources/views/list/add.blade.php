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

        <label for='comments'>YOUR COMMENTS ON THIS PARKING</label>
        <textarea test='comments-textarea' name='comments'>{{ old('comments') }}</textarea>

        <button type='submit' test='add-to-list-button' class='btn btn-primary'>Add to list</button>
    </form>
@endsection
