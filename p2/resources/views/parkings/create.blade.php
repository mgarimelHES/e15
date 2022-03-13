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
        <div class='myDiv'>
            {{ csrf_field() }}
            <fieldset>
                <p>Open from <time>06:00</time> to <time>22:00</time> every weekday.</p>

                <label for="parkingday">Date:</label>
                <input type="date" id="parkingday" name="parkingday">
                <label for="appt">Parking from time:</label>
                <input type="time" id="fromtime" name="fromtime">
                <label for="appt">Parking to time:</label>
                <input type="time" id="totime" name="totime">
                <label for='input'>Parking Hours:</label>
                <input type='text' test='hours' name='hours' value=0 id='hours'><label for='hours'>
                    <p for='input'>*** Please aware of hourly rates, no paritial rates. ***</p>
                    <p for='input'>*** Please note the hourly parking rate is $10.00 USD for visitors ***</p>
                    <p>Discount: For Students, Staff and Faculty!!</p>
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
                                            you would any other space in our building. You shall not: litter, shall not speed and follow the parking lot limit of 5 miles/hr, shall respect others’ property and vehicles, shall not park overnight. Overnight parked vehciles will be towed at the owner's expense.

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
@endsection
