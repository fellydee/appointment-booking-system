@extends('app')

@section('head')
    <link rel='stylesheet' href='/css/fullcalendar.min.css'/>
    <script src='/js/jquery-3.2.0.min.js'></script>
    <script src='/js//moment.min.js'></script>
    <script src='/js//fullcalendar.min.js'></script>
@stop

@section('content')
    <div class="row">
        @foreach($businesses as $business)
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{$business->name}}</h3>
                </div>
                <div class="panel-body">
                    <p>Address: {{$business->address}}</p>
                    <p>Phone: {{$business->phone}}</p>
                    <p>Email: {{$business->email}}</p>
                </div>
                <ul class="list-group">
                   @foreach($business->service as $service)
                        <li class="list-group-item">
                                <h5>{{$service->title}}</h5>
                            <p>{{$service->description}}</p>
                                <a class="btn btn-primary" href="/booking/service/{{$service->id}}">Book {{$service->title}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
    </div>
@stop
