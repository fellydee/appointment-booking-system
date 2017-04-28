@extends('app')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Booking Complete
                    <a href="{{url('/home') }}" class="pull-right">Home</a>
                </div>
                <div class="panel-body">
                    <p>Your booking was made successfully</p>
                    <p>Where: {{$booking->service->business->name}}</p>
                    <p>What: {{$booking->service->title}}</p>
                    <p>When: {{$booking->getDateTime()}}</p>

                    <a href="{{url('/home') }}" class="pull-right">Home</a>
                </div>
            </div>
        </div>
    </div>
@stop
