@extends('app')

@section('head')
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src='/js//moment.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(request()->session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ request()->session()->get('error') }}
                </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Open Hours
                    <a href="{{ url('/admin') }}" class="pull-right">Back</a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/hours') }}">
                        {{ csrf_field() }}

                        <div class="form-group startFinishSelector" >
                            <label for="monday_start" class="col-md-2 control-label">Monday</label>
                            <div class="col-md-5">
                                <select name="monday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="monday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="tuesday_start" class="col-md-2 control-label">Tuesday</label>
                            <div class="col-md-5">
                                <select name="tuesday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="tuesday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="wednesday_start" class="col-md-2 control-label">Wednesday</label>
                            <div class="col-md-5">
                                <select name="wednesday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="wednesday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="thursday_start" class="col-md-2 control-label">Thursday</label>
                            <div class="col-md-5">
                                <select name="thursday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="thursday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="friday_start" class="col-md-2 control-label">Friday</label>
                            <div class="col-md-5">
                                <select name="friday_start" class="form-control startSelector" >
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="friday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="saturday_start" class="col-md-2 control-label">Saturday</label>
                            <div class="col-md-5">
                                <select name="saturday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="saturday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group startFinishSelector">
                            <label for="sunday_start" class="col-md-2 control-label">Sunday</label>
                            <div class="col-md-5">
                                <select name="sunday_start" class="form-control startSelector">
                                    <option value="null">Closed</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select name="sunday_end" class="form-control finishSelector" disabled>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </div>
                        </div>
                    </form>
                <script>
                    var startCombos = document.querySelectorAll('.startFinishSelector .startSelector');
                    var finishCombos = document.querySelectorAll('.startFinishSelector .finishSelector');
                    // Get a list of times spaced 30 mins apart
                    var time = moment("2017-01-01 00:00:00");
                    var times = [];
                    for (var i = 0; i < 48; i++) {
                        times.push(time.format("LT"))

                        for (var k = 0; k < startCombos.length; k++) {
                            addOption(startCombos[k], times[i])
                        }

                        time.add(30, 'm');
                    }

                    // Add the event listeners
                    for (var i = 0; i < startCombos.length; i++) {
                        startCombos[i].addEventListener('change', function (e) {
                            var finishCombo = e.target.parentNode.parentNode.querySelector('.finishSelector');
                            finishCombo.options.length = 0;
                            if (e.target.selectedIndex == 0) {
                                finishCombo.selectedIndex = 0;
                                finishCombo.disabled = true;
                                return;
                            }
                            var selected = e.target.selectedIndex;
                            for (var i = selected; i < times.length; i++) {
                                addOption(finishCombo, times[i])
                            }
                            finishCombo.disabled = false;
                        })
                    }

                    function addOption(combo, value) {
                        var option = document.createElement("option");
                        option.text = value;
                        option.value = value;
                        combo.add(option)
                    }

                    // Select hours if they are already present;
                    $.ajax({
                        url: "/api/getBusinessInfo/{{$user->business_id}}",
                        dataType:'json'
                    }).done(function(data) {
                        var hours = data[0].businesshours;
                        for(var i =0; i<hours.length;i++){
                            var businessDay = hours[i];
                            businessDay.open_time = moment(businessDay.open_time, 'H:m:s').format('LT');
                            businessDay.close_time = moment(businessDay.close_time, 'H:m:s').format('LT');
                            console.log(businessDay)
                            startCombos[businessDay.day].selectedIndex = times.indexOf(businessDay.open_time)+1;
                            // Add time values past the selected
                            for (var k = times.indexOf(businessDay.close_time); k < times.length; k++) {
                                addOption(finishCombos[businessDay.day], times[k])
                            }
                            finishCombos[businessDay.day].disabled = false;
                        }

                    });
                </script>
            </div>
        </div>
    </div>
@stop
