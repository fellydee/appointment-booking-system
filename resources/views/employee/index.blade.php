@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Employee List
                    <a href="{{ url('/admin') }}" class="pull-right">Back</a>
                </div>
            </div>
            @foreach($employees as $employee)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/employees/{{ $employee->id }}">
                            {{ $employee->fullName() }}
                        </a>
                    </div>
                    <div class="panel-body">
                        <p>Email:   {{ $employee->email }}</p>
                        <p>Phone:   {{ $employee->phone }}</p>
                        <p>Address: {{ $employee->address }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 col-md-offset-2">
            <a href="/employees/create" class="btn btn-primary pull-right">New Employee</a>
        </div>
    </div>
@stop
