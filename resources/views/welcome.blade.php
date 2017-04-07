@extends('app')

@section('content')
<h1 id="title" >Appointment Booking System</h1>

<div class="introText">
    <p>Appointment booking system text</p>
</div>

<div class="button">
    <a id = "Login" href="{{ url('/login') }}"><button class= "btn btn-primary">Login</button></a>
    <a id = "Register" href="{{ url('/register') }}"><button class= "btn btn-primary">Register</button></a>
</div>

<style>

body {
    background-image: url("http://senamalancha.com/(S(nlannpjrpoo3ajpflx5hfb2t))/logindata/bg-8.jpg");
    background-size: cover;
    background-color: rgba(0,0,0,.45);
    background-blend-mode: multiply;
}

#title {
    margin: auto;
    text-align: center;
    color:White;
    font-Family:Arial Black
}

.introText {
    text-align: center;
    padding-top: 90px;
    padding-bottom: 150px;
    color:white;
}

#Login {
    display:inline-block;
}

#Register {
    display:inline-block;
}

.button {
    text-align: center;
    padding: 50px,50px,50px,50px;
}
</style>
@stop
