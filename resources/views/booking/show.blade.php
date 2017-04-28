@extends('app')

@section('head')
    <script src='/js/jquery-3.2.0.min.js'></script>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Booking {{$service->title}} at {{$business->name}}
                    </h3>
                </div>
                <div class="panel-body">
                    <input id="datepicker" type="date">

                    // Select day
                    // select show avaliable times
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("#datepicker").addEventListener('change',function(e){
            console.log(e.target.value)
            $.ajax({
                url:'/api/getAvailableTimes/{{$service->id}}/'+e.target.value,
                datatype:'json'
            }).done(function(data){

            })
            // Ajax to get avaliable times for service of ID
        })
    </script>
@stop
