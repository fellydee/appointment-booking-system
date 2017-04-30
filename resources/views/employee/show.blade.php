@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if(request()->session()->has('status'))
                <div class="alert alert-success" role="alert">
                    {{ request()->session()->get('status') }}
                </div>
            @endif
                @if(request()->session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ request()->session()->get('error') }}
                    </div>
                @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $employee->fullName() }}
                    <a href="/employees/{{ $employee->id }}/edit" class="pull-right">Edit</a>
                </div>
                <div class="panel-body">
                    <p>Email: {{ $employee->email }}</p>
                    <p>Phone: {{ $employee->phone }}</p>
                    <p>Address: {{ $employee->address }}</p>
                </div>
            </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Services Provided
                    </div>

                    <div class="panel-body">
                        @foreach($employee->services as $service)
                            <form method="POST" action="{{ url('/services/unassign') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="employee" value="{{ $employee->id }}">
                                <input type="hidden" name="service" value="{{ $service->id }}">
                                <ul>
                                    <li>
                                        {{ $service->title }}
                                        <button type="submit" class="btn btn-danger pull-right"><span class="glyphicon glyphicon-remove"></span></button>
                                    </li>
                                </ul>
                                <br>
                            </form>
                        @endforeach

                        @if(count($employee->business->service) == count($employee->services))
                            <h4>Employee can complete all business services</h4>
                        @else
                            <form action="{{ url('/services/assign') }}" method="POST" >
                                {{ csrf_field() }}
                                <input type="hidden" name="employee" value="{{ $employee->id }}">

                                <div class="form-group">
                                    <select name="service" class="form-control">
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->title }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <button class="btn btn-primary pull-right" type="submit">Assign Service</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            @include('roster.create')
        </div>
    </div>
@stop
