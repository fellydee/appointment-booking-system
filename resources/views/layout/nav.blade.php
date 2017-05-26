<script src="js/bootstrap.min.js"></script>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="{{ url('') }}">
                @if(empty(Auth::user()->business->logo_img))
                    Appointment Booking System
                @else
                    <img src="{{Auth::user()->business->logo_img}}" class="img-responsive" style="max-height:100%">
                @endif
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ route('register') }}"><span class="glyphicon glyphicon-user"></span>
                                Register</a></li>
                        <li><a href="{{ route('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        </li>
                    </ul>
                @else
                    <li><a href="{{ url('/home') }}"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false"><span class="glyphicon glyphicon-user"></span>
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('logout') }}">Logout</a>
                            </li>
                            @if (Auth::user()->role === 0)
                                <li>
                                    <a href="{{ url('employees') }}">Employees</a>
                                </li>
                                <li>
                                    <a href="{{ url('hours') }}">Hours</a>
                                </li>
                                <li>
                                    <a href="{{ url('services') }}">Services</a>
                                </li>
                                <li>
                                    <a href="{{ url('business') }}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{ url('booking') }}">Make Booking</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>