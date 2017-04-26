@extends('app')

@section('head')

@stop

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
                    Service Configuration
                    <a href="{{ url('/admin') }}" class="pull-right">Back</a>
                </div>
            </div>
            @foreach($services as $service)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="/employees/{{ $service->id }}">
                            {{ $service->title }}
                        </a>
                    </div>
                    <div class="panel-body">
                        <p>{{$service->id}}</p>
                        <p>{{$service->title}}</p>
                        <p>{{$service->description}}</p>
                        <p>{{$service->length}}</p>
                    </div>
                    <div class="panel-body">
                            <div class="pull-left">
                                <form method="POST" action="/services/{{$service->id}}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary">Delete</button>
                                </form>
                            </div>
                        <a href="/service/{{$service->id}}" class="btn btn-primary pull-right">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-8 col-md-offset-2">
            <a href="/services/create" class="btn btn-primary pull-right">New Service</a>
        </div>
    </div>

@stop