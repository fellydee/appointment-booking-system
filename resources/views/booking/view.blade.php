@extends('app')

@section('head')

@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Viewing Booking
                    <a href="{{ url()->previous() }}" class="pull-right">Back</a>
                </div>
                <div class="panel-body">
                    <p>Your booking was made successfully</p>
                    <p>Where: {{$booking->service->business->name}}</p>
                    <p>What: {{$booking->service->title}}</p>
                    <p>When: From {{$booking->getStartDateTime()}} To {{$booking->getEndDateTime()}}</p>
                    <p>Cost: {{$booking->service->priceFormatted()}}</p>
                </div>

            </div>
        </div>
    </div>
@stop
