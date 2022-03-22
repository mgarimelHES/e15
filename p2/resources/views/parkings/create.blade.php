@extends('layouts/main')

@section('title')
    Create a Parking Ticket
@endsection

@section('content')
    <h1>Create a parking ticket</h1>

    <p>Want to create a parking ticket for your vehicle? Not a problem- follow the procedure below
    </p>

    {{-- <form method='POST' action='/parkings'> --}}
    <form method='GET' action='/process'>
        <div class='myDiv'>
            {{ csrf_field() }}
            <fieldset>
                <p>Open from <time>12:00 AM </time> to <time>11:59 PM</time> every weekday.</p>

                <label for="parkingDay">Date:</label>
                <input type="date" id="parkingDay" name="parkingDay" value='{{ old('parkingDay', $parkingDay) }}'>
                <label for="appt">Parking from time:</label>
                <input type="time" id="fromTime" name="fromTime" min="08.00" max="18.00"
                    value='{{ old('fromTime', $fromTime) }}'>
                <label for="appt">Parking to time:</label>
                <input type="time" id="toTime" name="toTime" min="08.00" max="18.00" value='{{ old('toTime', $toTime) }}'>
                <label for='input'>Parking Rates:</label>

                <ul>
                    <li>*** Please aware of hourly rates, no paritial rates. ***</li>
                    <li>*** Please note the hourly parking rate is $10.00 USD for visitors ***</li>
                    <li>*** Discount: For Students, Staff and Faculty!! ***</li>
                </ul>

                <label for='input'>Are you a visitor or current student, staff or faculty?</label>
                <input type='radio' test='student-option' name='discountType' id='student' value='student'
                    {{ old('discountType', 'student') == 'student' ? 'checked' : '' }}>
                <label for='student'>Student</label>
                <input type='radio' test='staff-option' name='discountType' id='staff' value='staff'
                    {{ old('discountType', 'staff') == 'staff' ? 'checked' : '' }}>
                <label for='staff'>Staff</label>
                <input type='radio' test='faculty-option' name='discountType' id='faculty' value='faculty'
                    {{ old('discountType', 'faculty') == 'faculty' ? 'checked' : '' }}>
                <label for='faculty'>Faculty</label>
                <input type='radio' test='visitor-option' name='discountType' id='visitor' value='visitor'
                    {{ old('discountType', 'visitor') == 'visitor' ? 'checked' : '' }}>
                <label for='visitor'>Visitor</label>
                <label>Vehicle Information</label>


                <label for='input'>License Plate:</label>
                <input type='text' name='plate' id='plate' value='{{ old('plate', $plate) }}'>

                <label for='input'>Vehicle Make:</label>
                <input type='text' name='make' id='make' value='{{ old('make', $make) }}'>
                <label for='input'>Vehicle Model:</label>
                <input type='text' name='model' id='model' value='{{ old('model', $model) }}'>



                <label>Parking Agreement </label>
                <input type='checkbox' name='terms' id='terms' value='terms'>
                <label>I agree with the following parking terms and conditions</label>

                <textarea readonly id='rules' name='rules' rows='7' cols='80' wrap>
                    It is important that you should follow our parking lot rules in order to keep our parking lot safe and clean. We expect that you will respect our parking lot and treat it with the same care that you would any other space in our building. You shall not: litter, shall not speed and follow the parking lot limit of 5 miles/hr, shall respect others’ property and vehicles, shall not park overnight.
                    Overnight parked vehciles will be towed at the owner's expense.

                    If there are any specific challenges in your surroundings, such as others walking their dog through the parking lot and leaving a mess, you may want to address those issues in the parking lot rules section as well
                    You may also want to outline rules against certain types of parking, such as ‘diagonal parking,’ when someone parks diagonally in order to take up two spaces and reduce the chance of another vehicle parking beside their car
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    If you have access control systems such as keypads or barrier gates, you may want to include any rules about their use in this section (e.g. ‘staff employees are not permitted to share access control codes with anyone outside the workplace’)
                    </textarea>

                <label>Get Your Parking Receipt</label>


                <button type='submit' class='btn btn-primary'>Get a Parking Receipt</button>
                <p>---->Please place the parking receipt on your car dashboard <---- </p>

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

    @if ($fromTime > 10)
        <div class='error'>{{ $errors->first('fromTime') }}</div>
    @endif

    @if (!is_null($parkingReceipt))
        <div class='results alert alert-primary'>

            <p class='receipt'> Parking Ticket Receipt!! </p>

            <p> {{ $parkingReceipt }} </p>

        </div>
    @endif

@endsection
