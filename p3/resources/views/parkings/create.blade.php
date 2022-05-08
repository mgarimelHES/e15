@extends('layouts/main')

@section('title')
    Create a Parking Ticket
@endsection

@section('content')
    @if (session('flash-alert'))
        <div class='flash-alert'>
            {{ session('flash-alert') }}
    @endif

    <h1>Create a Parking Ticket</h1>

    <p>Want to create a parking ticket for your vehicle? Not a problem- follow the procedure below
    </p>

    <form method='POST' action='/parkings'>

        <div class='myDiv'>
            {{ csrf_field() }}
            <fieldset>
                <p>Open from <time>12:00 AM </time> to <time>11:59 PM</time> every weekday.</p>

                <label for='parkingLot'>* Parking Lot</label>
                <input test='lot-input' type='text' name='parkingLot' id='parkingLot' value='{{ old('parkingLot') }}'>
                @include('includes/error-field', ['fieldName' => 'parkingLot'])

                <label for='slug'>* Parking Spot</label>
                <input test='slug-input' type='text' name='slug' id='slug' value='{{ old('slug') }}'>
                @include('includes/error-field', ['fieldName' => 'slug'])

                <label for='customer_id'>* Customer</label>
                <select test='customer-dropdown' name='customer_id'>
                    <option value=''>Choose a customer...</option>
                    @foreach ($customers as $customer)
                        <option value='{{ $customer->id }}' {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->first_name . ' ' . $customer->last_name }}</option>
                    @endforeach
                </select>
                @include('includes/error-field', ['fieldName' => 'customer_id'])

                <label for="parkingDay">Date:</label>
                <input type="date" id="parkingDay" name="parkingDay" value='{{ old('parkingDay') }}'>
                @include('includes/error-field', ['fieldName' => 'parkingDay'])

                <label for="appt">Parking from time:</label>
                <input type="time" id="fromTime" name="fromTime" min="08.00" max="18.00" value='{{ old('fromTime') }}'>
                @include('includes/error-field', ['fieldName' => 'fromTime'])

                <label for="appt">Parking to time:</label>
                <input type="time" id="toTime" name="toTime" min="08.00" max="18.00" value='{{ old('toTime') }}'>
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
                <input test='plate-input' type='text' name='plate' id='plate' value='{{ old('plate') }}'>
                @include('includes/error-field', ['fieldName' => 'plate'])

                <label for='input'>Vehicle Make:</label>
                <input test='make-input' type='text' name='make' id='make' value='{{ old('make') }}'>
                @include('includes/error-field', ['fieldName' => 'make'])

                <label for='input'>Vehicle Model:</label>
                <input test='model-input' type='text' name='model' id='model' value='{{ old('model') }}'>
                @include('includes/error-field', ['fieldName' => 'model'])

                <label for='input'>Vehicle Year: (YYYY)</label>
                <input test='year-input' type='text' name='modelYear' id='modelYear' value='{{ old('modelYear') }}'>
                @include('includes/error-field', ['fieldName' => 'modelYear'])

                <label>Parking Agreement </label>
                <input test='terms-input' type='checkbox' name='terms' id='terms' value='terms'>
                <label>I agree with the following parking terms and conditions</label>

                <textarea test='rules-textarea' readonly id='rules' name='rules' rows='7' cols='80' wrap>
                    It is important that you should follow our parking lot rules in order to keep our parking lot safe and clean. We expect that you will respect our parking lot and treat it with the same care that you would any other space in our building. You shall not: litter, shall not speed and follow the parking lot limit of 5 miles/hr, shall respect others’ property and vehicles, shall not park overnight.
                    Overnight parked vehciles will be towed at the owner's expense.

                    If there are any specific challenges in your surroundings, such as others walking their dog through the parking lot and leaving a mess, you may want to address those issues in the parking lot rules section as well
                    You may also want to outline rules against certain types of parking, such as ‘diagonal parking,’ when someone parks diagonally in order to take up two spaces and reduce the chance of another vehicle parking beside their car
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                    If you have access control systems such as keypads or barrier gates, you may want to include any rules about their use in this section (e.g. ‘staff employees are not permitted to share access control codes with anyone outside the workplace’)
                    </textarea>
                @include('includes/error-field', ['fieldName' => 'terms'])

                <button test='submit-button' type='submit' class='btn btn-primary'>Get a Parking Receipt</button>

                <p>---->Please place the parking receipt on your car dashboard <---- </p>

            </fieldset>
        </div>
    </form>

    @if (count($errors) > 0)
        <div test='global-error-feedback' class='alert alert-danger'>
            Please correct the above errors.
        </div>
    @endif
@endsection
