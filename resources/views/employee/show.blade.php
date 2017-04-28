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

                    @foreach($employee->services as $service)
                        <form method="POST" action="{{ url('/services/unassign') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="employee" value="{{ $employee->id }}">
                            <input type="hidden" name="service" value="{{ $service->id }}">

                            <ul>
                                <li>
                                    {{ $service->title }}
                                    <button type="submit" class="btn"><span class="glyphicon glyphicon-remove"></span></button>
                                </li>
                            </ul>
                        </form>
                    @endforeach

                    <form action="{{ url('/services/assign') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="employee" value="{{ $employee->id }}">

                        <select name="service">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->title }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-primary" type="submit">Assign Service</button>
                    </form>
                </div>

            @include('roster.create')
        </div>
    </div>
@stop
