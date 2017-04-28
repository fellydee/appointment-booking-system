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
            <div class="panel panel-default">
                <div class="panel-heading">

                    Admin Dashboard
                    <a href="{{ url('/logout') }}" class="pull-right">Logout</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/employees') }}" >Employee Management</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/hours') }}" >Business Hours</a>
                </div>
                <div class="panel-body">
                    <a href="{{ url('/services') }}" >Business Services</a>
                </div>
            </div>
        </div>
    </div>
@stop