@extends('layouts/main')

@section('title')
    {{ $vehicle }}
@endsection

@section('head')
    {{-- Parking Page specific CSS includes should be defined here; --}}
    <link href='/css/parkings/show.css' rel='stylesheet'>
@endsection

@section('content')
    <link href='/css/parkings/show.css' rel='stylesheet'>
    @if ($parkingFound)
        <h1>{{ $vehicle }}</h1>

        <p>
            Details about the parking will go here...
        </p>
        <form method='POST' action='/process'>
            <fieldset>
                <p>Open from <time>06:00</time> to <time>22:00</time> every weekday.</p>

                <label for="parkingday">Date:</label>
                <input type="date" id="parkingday" name="parkingday">
                <label for="appt">Select a from time:</label>
                <input type="time" id="fromtime" name="fromtime">
                <label for="appt">Select a to time:</label>
                <input type="time" id="totime" name="totime">
                <label for='input'>Hours Parked:</label>
                <input type='text' test='hours' name='hours' value=0 id='hours'><label for='hours'>
                    <label for='input'>Please aware of hourly rates, no paritial rates!!</label>
                    <p>Discount: For Students, Staff and Faculty!</p>
                    <input type='radio' test='student-option' name='selection' value='Student' id='student'><label
                        for='student'>Student</label>
                    <input type='radio' test='staff-option' name='selection' value='Staff' id='staff'><label
                        for='staff'>Staff</label>
                    <input type='radio' test='faculty-option' name='selection' value='Faculty' id='faculty'><label
                        for='faculty'>Faculty</label>
                    <input type='radio' test='visitor-option' name='selection' value='Vistor' id='visitor'><label
                        for='visitor'>Visitor</label>
                    <p>Vehicle Information</p>


                    <label for='input'>License Plate:</label>
                    <input type='text' name='plate' id='plate' required value='abc123'>

                    <label for='input'>Vehicle Make:</label>
                    <input type='text' name='make' id='make' required value='xyz'>
                    <label for='input'>Vehicle Model:</label>
                    <input type='text' name='model' id='model' required value='aaa'>

                    <p>Parking Agreement</p>

                    <input type='checkbox' name='terms' id='terms' required value='terms'>

                    <textarea readonly id='rules' name='rules' rows='7' cols='80' wrap>
                                    It is important that you should follow our parking lot rules in order to keep our parking lot safe and clean. We expect that you will respect our parking lot and treat it with the same care that
                                    you would any other space in our building. You shall not: litter, shall not speed and follow the parking lot limit of [5 miles/hr], shall respect others’ property and vehicles, shall not park overnight. Overnight parked vehciles will be towed at the owner's expense.

                                    If there are any specific challenges in your surroundings, such as others walking their dog through the parking lot and leaving a mess, you may want to address those issues in the parking lot rules section as well
                                    You may also want to outline rules against certain types of parking, such as ‘diagonal parking,’ when someone parks diagonally in order to take up two spaces and reduce the chance of another vehicle parking beside their car
                                                                                                                                            
                                    If you have access control systems such as keypads or barrier gates, you may want to include any rules about their use in this section (e.g. ‘staff employees are not permitted to share access control codes with anyone outside the workplace’)
                                        </textarea>
                    <p>Please place the parking receipt on your car dashboard</p>
                    <label>Get Your Parking Receipt</label>

                    <button test='submit-button' type='submit'>Get Receipt!</button>

            </fieldset </form>
        @else
            Parking Reciept not found! <a href='/parkings'>View all the parkings</a>
    @endif
@endsection
