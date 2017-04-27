@extends('app')

@section('head')
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{$service->title}}
                    </h3>
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div>
@stop
