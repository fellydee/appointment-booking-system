@extends('app')

@section('head')
    <link rel='stylesheet' href='/css/fullcalendar.min.css'/>
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src='/js//moment.min.js'></script>
    <script src='/js//fullcalendar.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                    <a href="{{ url('/logout') }}" class="pull-right">Logout</a>
                </div>
                <div class="panel-body text-center">
                    <h3>Upcoming bookings</h3>
                    <div id="calendar"></div>
                </div>
                <div class="panel-body">
                    <a href="/booking" class="btn btn-primary btn-lg pull-right">Make Booking</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                defaultView: 'listYear',
                height: 300,
                events: 'api/myBookings',
                eventClick: function (calEvent, jsEvent, view) {
                    location.href = '/viewBooking/'+calEvent.id;
                }
            })

        });


    </script>
@stop
