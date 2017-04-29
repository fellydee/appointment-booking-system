@extends('app')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Select a service
                    <a href="{{url('/home') }}" class="pull-right">Cancel</a>
                </div>
                <div class="panel-body">
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
                                <a class="btn btn-primary" href="/booking/service/{{$service->id}}">Book {{$service->title}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@stop
