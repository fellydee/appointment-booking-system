@extends('app')

@section('head')
    <script src='/js/jquery-3.2.0.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                        Booking {{$service->title}} at {{$business->name}}
                    <a href="{{ url('/booking') }}" class="pull-right">Cancel</a>
                </div>
                <div class="panel-body">
                    @if(count($service->employees) !=0)
                        <div class="form-group">
                            <label for="employeeSelect">Employee Select</label>
                            <select name="employeeSelect" id="empSelect" class="form-control">
                                @foreach($service->employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->fullName()}}</option>
                                @endforeach
                            </select>
                            <a type="submit" class="btn btn-primary" onclick="loadPage();">Next</a>
                        </div>
                    @else
                        <h3>There are no employees available to complete this service</h3>
                    @endif
                    <script>
                        function loadPage() {
                            location.href = location.href + "/employee/" + document.querySelector("#empSelect").value;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
