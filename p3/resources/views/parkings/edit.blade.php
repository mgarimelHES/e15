@extends('layouts/main')

@section('title')
    Edit a parking {{ $parking->license_plate }}
@endsection

@section('content')

    <h1>Edit a specific parking spot - {{ $parking->license_plate }}</h1>
    <p>Open from <time>12:00 AM </time> to <time>11:59 PM</time> every weekday.</p>

    <form method='POST' action='/parkings/{{ $parking->slug }}'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}
        {{ method_field('put') }}
        <fieldset>

            <label for='parkingLot'>* Parking Lot</label>
            <input type='text' name='parkingLot' id='parkingLot' value='{{ old('parkingLot', $parking->parking_lot) }}'>
            @include('includes/error-field', ['fieldName' => 'parkingLot'])

            <label for='slug'>* Parking Spot</label>
            <input type='text' name='slug' id='slug' value='{{ old('slug', $parking->slug) }}'>
            <div class='details'>
                This is is a unique identifier for the parking, containing only alphanumeric characters and dashes.
                <br>It’s suggested that the slug be based on the parking location, e.g. a floor, row and a number for the
                parking <em>“Lot West first floow with row1
                    is W-100-A”</em> would be <em>“W1001”</em>.
            </div>
            @include('includes/error-field', ['fieldName' => 'slug'])

            <label for="parkingDay">Date:</label>
            <input type="date" id="parkingDay" name="parkingDay" value='{{ old('parkingDay', $parking->created_at) }}'>
            @include('includes/error-field', ['fieldName' => 'parkingDay'])

            <label for="appt">Parking from time:</label>
            <input type="time" id="fromTime" name="fromTime" min="08.00" max="18.00"
                value='{{ old('fromTime', $parking->parking_start_time) }}'>
            @include('includes/error-field', ['fieldName' => 'fromTime'])
            <label for="appt">Parking to time:</label>
            <input type="time" id="toTime" name="toTime" min="08.00" max="18.00"
                value='{{ old('toTime', $parking->parking_end_time) }}'>
            @include('includes/error-field', ['fieldName' => 'toTime'])

            <label for='input'>Parking Rates:</label>

            <ul>
                <li>*** Please aware of hourly rates, no paritial rates. ***</li>
                <li>*** Please note the hourly parking rate is $10.00 USD for visitors ***</li>
                <li>*** Discount: For Students, Staff and Faculty only!! ***</li>
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
            <input type='text' name='plate' id='plate' value='{{ old('plate', $parking->license_plate) }}'>
            @include('includes/error-field', ['fieldName' => 'plate'])

            <label for='input'>Vehicle Make:</label>
            <input type='text' name='make' id='make' value='{{ old('make', $parking->make) }}'>
            @include('includes/error-field', ['fieldName' => 'make'])

            <label for='input'>Vehicle Model:</label>
            <input type='text' name='model' id='model' value='{{ old('model', $parking->model) }}'>
            @include('includes/error-field', ['fieldName' => 'model'])

            <label for='input'>Vehicle Year:</label>
            <input type='text' name='modelYear' id='modelYear' value='{{ old('modelYear', $parking->model_year) }}'>
            @include('includes/error-field', ['fieldName' => 'modelYear'])

            <label for='input'>Customer Name:</label>
            <input type='text' name='owner' id='owner' value='{{ old('owner', $parking->owner) }}'>
            @include('includes/error-field', ['fieldName' => 'owner'])

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
            @include('includes/error-field', ['fieldName' => 'terms'])

            <button type='submit' class='btn btn-primary'>Update a Parking Ticket</button>

            <p>---->Please place the parking receipt on your car dashboard <---- </p>
        </fieldset>

        @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif




    </form>
@endsection
