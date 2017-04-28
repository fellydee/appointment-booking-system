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
                    <a href="{{ url('/employees') }}">Employee Management</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/hours') }}">Business Hours</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/services') }}">Business Services</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Employee Avalibility
                    </h3>
                </div>
                <div class="panel-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            $('#calendar').fullCalendar({
                defaultView: 'agendaWeek',
                height: 700,
                businessHours:[
                    @foreach($business->businessHours as $day)
                        {
                            dow: [{{$day->day+1}}],
                            start: "{{$day->open_time}}",
                            end: "{{$day->close_time}}"
                        },
                    @endforeach
                ],
                events: {
                    url: '/api/getEmployeeHours/{{$business->id}}',
                    success: function (json) {
                        // Make all employees have different colours
                        var names = {};
                        json.forEach(function (item) {
                            if (names[item.title] == null) {
                                names[item.title] = '#' + (0x1000000 + (Math.random()) * 0xffffff).toString(16).substr(1, 6);
                            }
                            item.color = names[item.title];
                        })
                    }
                }
            })

        });


    </script>
@stop