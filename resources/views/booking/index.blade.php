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
                    Business Select
                </div>
                <div class="panel-body">
                    <div class="form-group startFinishSelector">
                        <label for="business_select" class="col-md-2 control-label">Businesses</label>
                        <div class="col-md-10">
                            <select name="business_select" class="form-control startSelector">
                                @foreach($businesses as $bus)
                                    <option value="{{$bus->id}}">{{$bus->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                    <a href="{{ url('/home') }}" class="pull-right">Back</a>
                </div>
                <div class="panel-body">
                    <div id="calendar"></div>
                </div>

            </div>
        </div>

    </div>
    <script>

        //        $(document).ready(function () {
        //            $('#calendar').fullCalendar({
        //                defaultView: 'agendaWeek',
        //                height: 600,
        //                events: 'api/myBookings'
        //            })
        //        });

    </script>
@stop
