@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                Register
                <a href="{{ url('/') }}" class="pull-right">Back</a>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="first_name" class="col-md-4 control-label">First Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   name="first_name" value="{{ old('first_name') }}" required autofocus>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="last_name" class="col-md-4 control-label">Last Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   name="last_name" value="{{ old('last_name') }}" required>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control"
                                   name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-4 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   name="phone" value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                                   name="address" value="{{ old('address') }}" required>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}">
                        </div>
                    </div>

                    <input type="hidden" name="role" value="1">

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>

                    <p>Password must be at least 8 characters long, contain at least one upper and lower case letter and at least one digit</p>
                </form>
            </div>
        </div>
    </div>
</div>

<style>

body {
    background-image: url("http://senamalancha.com/(S(nlannpjrpoo3ajpflx5hfb2t))/logindata/bg-8.jpg");
    background-size: cover;
    background-color: rgba(0,0,0,.45);
    background-blend-mode: multiply;
}
</style>
@stop
