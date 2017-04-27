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
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Length (mins)</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="col-md-1">{{$service->id}}</td>
                                    <td class="col-md-2">{{$service->title}}</td>
                                    <td class="col-md-5">{{$service->description}}</td>
                                    <td class="col-md-2">{{$service->duration}}</td>
                                    <td class="col-md-2">
                                        <form method="POST" action="/services/{{$service->id}}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit"><span
                                                        class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </form>
                                        <a href="/services/{{$service->id}}" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8 col-md-offset-2">
            <a href="/services/create" class="btn btn-primary pull-right">New Service</a>
        </div>
    </div>

@stop