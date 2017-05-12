@extends('app')

@section('content')
    <div class="title col-md-6 col-md-offset-3">
        <h1 id="title">
            @if(empty(Auth::user()->business->main_title))
                Online appointment booking system for your business
            @else
                {{Auth::user()->business->main_title}}
            @endif</h1>
    </div>

    <div class="introText col-md-6 col-md-offset-3">
        <p>
            @if(empty(Auth::user()->business->main_text))
                Appointment booking system can be used for free by any business.
                Millions of people around the world all use Appointment Booking system
                to organise appointments with hundreds of different businesses such as
                hairdressers, gyms, dentists and veterinary clinics
            @else
                {{Auth::user()->business->main_text}}
            @endif
        </p>
    </div>

    <div class="Login col-md-6  col-md-offset-3">
    @if (Auth::guest())
        <!--<a id = "Login" href="{{ url('/login') }}"><button class= "btn btn-primary">Login</button></a>-->
            <a id="Register" href="{{ url('/register') }}">
                <button class="btn btn-primary btn-lg">Register Now</button>
            </a>
        @else
            <a id="Register" href="{{ url('/home') }}">
                <button class="btn btn-primary btn-lg">View Dashboard</button>
            </a>
        @endif
    </div>

    <style>


        #title {
            margin: auto;
            text-align: center;
            color: White;
            font-Family: Arial Black
            font-size: 20px;
        }

        .title {
            padding-top: 40px;
        }

        .introText {
            text-align: center;
            padding-top: 90px;
            padding-bottom: 80px;
            color: white;
            font-size: 15px;
        }

        #Login {
            display: inline-block;
        }

        #Register {
            display: inline-block;
        }

        .Login {
            text-align: center;
            padding: 50px, 50px, 50px, 50px;
        }
    </style>
@stop
