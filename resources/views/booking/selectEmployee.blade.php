@extends('app')

@section('head')
    <script src='/js/jquery-3.2.0.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Booking {{$service->title}} at {{$business->name}}
                    </h3>
                </div>
                <div class="panel-body">
                        <div class="form-group">
                            <label for="employeeSelect">Employee Select</label>
                            <select name="employeeSelect" id="empSelect" class="form-control">
                                @foreach($service->employee as $employee)
                                    <option value="{{$employee->id}}">{{$employee->fullName()}}</option>
                                @endforeach
                            </select>
                            <a type="submit" class="btn btn-primary" onclick="loadPage();">Next</a>
                        </div>
                    <script>
                        function loadPage(){
                            location.href = location.href + "/employee/"+document.querySelector("#empSelect").value;
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@stop
