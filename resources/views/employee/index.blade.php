@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($employees as $employee)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/employees/{{ $employee->id }}">
                            {{ $employee->fullName() }}
                        </a>
                    </div>
                    <div class="panel-body">
                        <p>{{ $employee->email }}</p>
                        <p>{{ $employee->phone }}</p>
                        <p>{{ $employee->address }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 col-md-offset-2">
            <a href="/employees/create" class="btn btn-primary pull-right">New Employee</a>
        </div>
    </div>
@stop
