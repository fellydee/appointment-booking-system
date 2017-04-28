@extends('app')

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
                    {{ $employee->fullName() }}
                    <a href="/employees/{{ $employee->id }}/edit" class="pull-right">Edit</a>
                </div>
                <div class="panel-body">
                    <p>{{ $employee->email }}</p>
                    <p>{{ $employee->phone }}</p>
                    <p>{{ $employee->address }}</p>
                </div>
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Services Provided
                    </div>
                    <ul>
                        @foreach($employee->service as $service)
                            <li>{{$service->title}}</li>
                        @endforeach
                    </ul>
                </div>

            @include('roster.create')
        </div>
    </div>
@stop
