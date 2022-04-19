@extends('layouts/main')

@section('head')
    <link href='/css/welcome.css' rel='stylesheet'>
@endsection

@section('content')

@if(Auth::user())
<h2>
    Hello {{ Auth::user()->name }}!
</h2>
@endif

    <p>
        Welcome to YourParking&mdash; an online parking lot that lets you track and share a history of parkings with
        us.
    </p>

    <form method='GET' action='/search'>

        <h2>Search for a parking request to add to your list</h2>

        <fieldset>
            <label for='searchTerms'>
                Search terms:
                <input type='text' name='searchTerms' id='searchTerms' value='{{ old('searchTerms') }}'>
            </label>
        </fieldset>

        <fieldset>
            <label>
                Search type:
            </label>

            <input type='radio' name='searchType' id='lot' value='lot'
                {{ old('searchType', 'lot') == 'lot' ? 'checked' : '' }}>
            <label for='lot'> Parking Lot</label>

            <input type='radio' name='searchType' id='license_plate' value='license_plate'
                {{ old('searchType') == 'license_plate' ? 'checked' : '' }}>
            <label for='license_plate'> License Plate</label>

        </fieldset>

        <button type='submit' class='btn btn-primary'>Search</button>

        @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

    </form>

    @if (!is_null($searchResults))
        @if (count($searchResults) == 0)
            <div class='results alert alert-warning'>
                No results found.
            </div>
        @else
            <div class='results alert alert-primary'>

                {{ count($searchResults) }}
                {{ Str::plural('Result', count($searchResults)) }}:

                <ul class='clean-list'>
                    @foreach ($searchResults as $slug => $parking)
                        <li><a href='/parkings/{{ $slug }}'> {{ $parking['lot'] }}</a></li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
@endsection
