@extends('layouts/main')

@section('title')
    Create a Parking Ticket
@endsection

@section('content')
    <h1>Create a parking ticket</h1>

    <p>Want to create a parking ticket for your vehicle? Not a problem- follow the procedure below
    </p>
    {{-- <form method='POST' action='/books'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title'>

        <label for='author'>* Author</label>
        <input type='text' name='author' id='author'>

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year'>

        <label for='cover_url'>Cover URL</label>
        <input type='text' name='cover_url' id='cover_url' value='http://'>

        <label for='info_url'>* Wikipedia URL</label>
        <input type='text' name='info_url' id='info_url' value='http://'>

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' value='http://'>

        <label for='description'>Description</label>
        <textarea name='description'></textarea>

        <button type='submit' class='btn btn-primary'>Get a Parking Receipt</button>
    </form> --}}

    <form method='POST' action='/parkings'>
        {{-- <form method='GET' action='/process'> --}}
        <div class='myDiv'>
            {{ csrf_field() }}
            <fieldset>
                <p>Open from <time>06:00</time> to <time>22:00</time> every weekday.</p>

                <label for="parkingDay">Date:</label>
                <input type="date" id="parkingDay" name="parkingDay" value='{{ old('parkingDay', $parkingDay) }}'>
                <label for="appt">Parking from time:</label>
                <input type="time" id="fromTime" name="fromTime" min="08.00" max="18.00"
                    value='{{ old('fromTime', $fromTime) }}'>
                <label for="appt">Parking to time:</label>
                <input type="time" id="toTime" name="toTime" min="08.00" max="18.00" value='{{ old('toTime', $toTime) }}'>
                <label for='input'>Parking Rates:</label>
                <textarea readonly id='conditions' name='condiitons' rows='5' cols='80' wrap>

                        *** Please aware of hourly rates, no paritial rates. ***
                        *** Please note the hourly parking rate is $10.00 USD for visitors ***
                        *** Discount: For Students, Staff and Faculty!!  ***
                        </textarea>
                <label for='input'>Are you a visitor or current student, staff or faculty?</label>
                <input type='radio' test='student-option' name='discountType' value='student' id='student'
                    {{ $discountType == 'student' ? 'checked' : '' }}>
                <label for='student'>Student</label>
                <input type='radio' test='staff-option' name='discountType' value='staff' id='staff'
                    {{ $discountType == 'staff' ? 'checked' : '' }}>
                <label for='staff'>Staff</label>
                <input type='radio' test='faculty-option' name='discountType' value='faculty' id='faculty'
                    {{ $discountType == 'faculty' ? 'checked' : '' }}>
                <label for='faculty'>Faculty</label>
                <input type='radio' test='visitor-option' name='discountType' value='visitor' id='visitor'
                    {{ $discountType == 'visitor' ? 'checked' : '' }}>
                <label for='visitor'>Visitor</label>
                <label>Vehicle Information</label>


                <label for='input'>License Plate:</label>
                <input type='text' name='plate' id='plate' value='{{ old('plate', $plate) }}'>

                <label for='input'>Vehicle Make:</label>
                <input type='text' name='make' id='make' value='{{ old('make', $make) }}'>
                <label for='input'>Vehicle Model:</label>
                <input type='text' name='model' id='model' value='{{ old('model', $model) }}'>

                <p>Parking Agreement</p>

                <input type='checkbox' name='terms' id='terms' value='terms'>

                <textarea readonly id='rules' name='rules' rows='7' cols='80' wrap>
                                                                                                                              It is important that you should follow our parking lot rules in order to keep our parking lot safe and clean. We expect that you will respect our parking lot and treat it with the same care that you would any other space in our building. You shall not: litter, shall not speed and follow the parking lot limit of 5 miles/hr, shall respect others’ property and vehicles, shall not park overnight.
                                                                                                                            Overnight parked vehciles will be towed at the owner's expense.

                                                                                                                             If there are any specific challenges in your surroundings, such as others walking their dog through the parking lot and leaving a mess, you may want to address those issues in the parking lot rules section as well
                                                                                                                            You may also want to outline rules against certain types of parking, such as ‘diagonal parking,’ when someone parks diagonally in order to take up two spaces and reduce the chance of another vehicle parking beside their car
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                                                                                                                            If you have access control systems such as keypads or barrier gates, you may want to include any rules about their use in this section (e.g. ‘staff employees are not permitted to share access control codes with anyone outside the workplace’)
                                                                                                                            </textarea>
                <p>---->Please place the parking receipt on your car dashboard <---- </p>
                        <label>Get Your Parking Receipt</label>


                        <button type='submit' class='btn btn-primary'>Get a Parking Receipt</button>

            </fieldset>
        </div>
    </form>
    @if (count($errors) > 0)
        <ul class='alert alert-danger'>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (is_null($myVariable))
        <div class='results alert alert-warning'>
            Issue with the Parking Calculation!
        </div>
    @else
        <div class='results alert alert-primary'>


            <p class='receipt'> Parking Ticket Receipt!! </p>

            <ul class='clean-list'>
                <p> {{ $myVariable }} </p>

            </ul>

        </div>
    @endif

    <?php
    dump($myVariable);
    ?>
@endsection
