@extends('app')

@section('head')
    <link rel='stylesheet' href='/css/fullcalendar.min.css' />
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src='/js//moment.min.js'></script>
    <script src='/js//fullcalendar.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div id="calendar"></div>
    </div>
    <script>
        $(document).ready(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                defaultView:'month',
                droppable: true,
                eventClick: function(event) {console.log("Event click. Should bring up options Cancel etc")},
                dayClick: function(date, jsEvent, view) {

                    alert('Clicked on: ' + date.format());

                }
            })
        });
    </script>
@stop
