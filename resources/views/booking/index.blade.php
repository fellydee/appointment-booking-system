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
                        <div>
                            <div class="col-md-2">
                                Address:
                            </div>
                            <div class="col-md-10">
                                {{$business->address}}
                            </div>
                        </div>
                        <div>
                            <div class="col-md-2">
                                Phone:
                            </div>
                            <div class="col-md-10">
                                {{$business->phone}}
                            </div>
                        </div>
                        <div>
                            <div class="col-md-2">
                                Email:
                            </div>
                            <div class="col-md-10">
                                {{$business->email}}
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h3>Services</h3>
                        <ul class="list-group">
                            @foreach($business->service as $service)
                                <li class="list-group-item">
                                    <h4>{{$service->title}}</h4>
                                    <div>
                                        <div class="col-md-2">
                                            Description:
                                        </div>
                                        <div class="col-md-10">
                                            {{$service->description}}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-2">
                                            Cost:
                                        </div>
                                        <div class="col-md-10">
                                            {{$service->priceFormatted()}}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-2">
                                            Duration:
                                        </div>
                                        <div class="col-md-10">
                                            {{$service->duration}}
                                        </div>
                                    </div>
                                    <a class="btn btn-primary"
                                       href="/booking/service/{{$service->id}}">Book {{$service->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
