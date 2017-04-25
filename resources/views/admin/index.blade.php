@extends('app')

@section('head')
    <link rel='stylesheet' href='/css/fullcalendar.min.css' />
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src='/js//moment.min.js'></script>
    <script src='/js//fullcalendar.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(request()->session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ request()->session()->get('status') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Admin Dashboard
                    <a href="{{ url('/logout') }}" class="pull-right">Logout</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/employees') }}" >Employee Management</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/hours') }}" >Business Hours</a>
                </div>
                <div class="panel-body">
                    <h3>Upcoming bookings</h3>
                    <div id="calendar"></div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                defaultView:'listYear',
                height: 300,
                events: 'api/myBookings'
                // put your options and callbacks here
            })

        });
    </script>
@stop