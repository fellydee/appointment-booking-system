@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
                <a href="{{ url('/logout') }}" class="pull-right">Logout</a>
            </div>
            <div class="panel-body">
                {{ Auth::user()->name }}
            </div>
        </div>
    </div>
</div>
@stop
