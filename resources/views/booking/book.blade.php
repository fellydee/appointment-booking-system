@extends('app')

@section('head')
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src="/js/moment.min.js"></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Booking {{$service->title}} at {{$service->business->name}} with {{$employee->fullName()}}
                    <a href="{{ url()->previous() }}" class="pull-right">Back</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Availability
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>From</th>
                                    <th>To</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employee->timeslots as $timeslot)
                                    <tr>

                                        <td>{{$timeslot->getDay()}}</td>
                                        <td>{{$timeslot->getStartTime()}}</td>
                                        <td>{{$timeslot->getEndTime()}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Appointment Details
                    </h3>
                </div>
                <form method="POST" action="/booking">
                    {{ csrf_field() }}
                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                    <input type="hidden" name="service_id" value="{{$service->id}}">
                    <input type="hidden" name="business_id" value="{{$service->business->id}}">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="date">Booking Date</label>
                            <input name="date" type="date" id="dateSelect" class="form-control">
                        </div>
                        <div class="form-group" id="time">
                            <label for="time">Booking Time</label>
                            <select name="time" id="timeSelect" class="form-control" disabled></select>
                        </div>
                    </div>
                    <div class="panel-body">
                        <button type="submit" id="bookbtn" class="btn btn-primary pull-right" disabled>Make Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Only future dates
        var dateSelect = document.querySelector("#dateSelect")
        dateSelect.setAttribute('min', moment().format("YYYY-MM-DD"));
        if (dateSelect.value != "") {
            processChange();
        }
        dateSelect.addEventListener('change', function (e) {
            processChange();
        })

        function processChange() {
            $.ajax({
                'url': '/api/getAvailableTimes/{{$employee->id}}/{{$service->id}}/' + document.querySelector("#dateSelect").value,
                'datatype': 'json'
            }).done(function (data) {
                if (data.error) {
                    alert(data.error)
                    document.getElementById("bookbtn").disabled = true;
                    return;
                }
                data.forEach(function (item) {
                    addOption(document.querySelector("#timeSelect"), item, item);
                })
                if(document.querySelector("#timeSelect").options.length > 0){
                    document.querySelector("#timeSelect").disabled = false;
                    document.getElementById("bookbtn").disabled = false;
                }
            })

        }
        function addOption(combo, value, text) {
            var option = document.createElement('option');
            option.value = value;
            option.text = text;
            combo.add(option);
        }
    </script>
@stop
