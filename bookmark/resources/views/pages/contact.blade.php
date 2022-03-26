@extends('layouts/main')

@section('title')
    Contact
@endsection

@section('content')
    {{-- }} <h1>Contact us at mail@bookmark.com</h1> --}}
    <h1>Contact</h1>
    <p>Contact us at {{ config('mail.contact_email') }} .</p>
@endsection
