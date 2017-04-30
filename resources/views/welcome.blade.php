@extends('app')

@section('content')
<div class="title">
    <h1 id="title" >Online appointment booking system <br> for your business</h1>
</div>

<div class="introText">
    <p>
    Appointment booking system can be used for free by any business. 
    <br> 
    Millions of people around the world all use Appointment Booking system
    <br>
    to organise appointments with hundreds of different businesses such as
    <br>
    hairdressers, gyms, dentists and veterinary clinics 
    </p>
</div>

<div class="Login">
    @if (Auth::guest())
    <!--<a id = "Login" href="{{ url('/login') }}"><button class= "btn btn-primary">Login</button></a>-->
    <a id = "Register" href="{{ url('/register') }}"><button class= "btn btn-primary btn-lg">Register Now</button></a>
    @else
    <a id = "Register" href="{{ url('/home') }}"><button class= "btn btn-primary btn-lg">View Dashboard</button></a>    
    @endif
</div>

<style>



#title {
    margin: auto;
    text-align: center;
    color:White;
    font-Family:Arial Black
    font-size:20px;
}

.title{
    padding-top: 40px;
}

.introText {
    text-align: center;
    padding-top: 90px;
    padding-bottom: 80px;
    color:white;
    font-size:15px;
}

#Login {
    display:inline-block;
}

#Register {
    display:inline-block;
}

.Login {
    text-align: center;
    padding: 50px,50px,50px,50px;
}
</style>
@stop
