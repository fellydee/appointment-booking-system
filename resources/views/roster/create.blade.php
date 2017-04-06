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

                <div class="form-group">
                    <label for="monday_start" class="col-md-2 control-label">Monday</label>
                    <div class="col-md-5">
                        <select name="monday_start" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="monday_end" class="form-control">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="monday_start" class="col-md-2 control-label">Tuesday</label>
                    <div class="col-md-5">
                        <select name="tuesday_start" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="tuesday_end" class="form-control">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="monday_start" class="col-md-2 control-label">Wednesday</label>
                    <div class="col-md-5">
                        <select name="wednesday_start" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="wednesday_end" class="form-control">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="monday_start" class="col-md-2 control-label">Thursday</label>
                    <div class="col-md-5">
                        <select name="thursday_start" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="thursday_end" class="form-control">

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="monday_start" class="col-md-2 control-label">Friday</label>
                    <div class="col-md-5">
                        <select name="friday_start" class="form-control">

                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="friday_end" class="form-control">

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
