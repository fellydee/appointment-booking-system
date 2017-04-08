<script src="/js/moment.min.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        Roster
        @if($employee->roster_id)
            <a href="/rosters/{{ $employee->roster_id }}/edit" class="pull-right">Edit</a>
        @endif
    </div>
    @if(! $employee->roster_id)
        <div class="panel-body">
            <p>This employee does not currently have an active roster</p>
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/rosters') }}">
                {{ csrf_field() }}

                <div class="form-group startFinishSelector" >
                    <label for="monday_start" class="col-md-2 control-label">Monday</label>
                    <div class="col-md-5">
                        <select name="monday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="monday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Tuesday</label>
                    <div class="col-md-5">
                        <select name="tuesday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="tuesday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Wednesday</label>
                    <div class="col-md-5">
                        <select name="wednesday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="wednesday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Thursday</label>
                    <div class="col-md-5">
                        <select name="thursday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="thursday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Friday</label>
                    <div class="col-md-5">
                        <select name="friday_start" class="form-control startSelector" >
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="friday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Saturday</label>
                    <div class="col-md-5">
                        <select name="saturday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="saturday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group startFinishSelector">
                    <label for="monday_start" class="col-md-2 control-label">Sunday</label>
                    <div class="col-md-5">
                        <select name="sunday_start" class="form-control startSelector">
                            <option value="null">Not Working</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="sunday_end" class="form-control finishSelector" disabled>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right">Create Roster</button>
                    </div>
                </div>
            </form>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>Day</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($employee->roster->timeslots as $timeslot)
                            <tr>
                                <td>{{ $timeslot->day }}</td>
                                <td>{{ $timeslot->start_time }}</td>
                                <td>{{ $timeslot->end_time }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    @endif
</div>
<script>
    var startCombos = document.querySelectorAll('.startFinishSelector .startSelector');

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
</script>