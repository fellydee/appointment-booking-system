@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                 <a id = "Back" href="{{ URL::previous() }}"><button class= "btn btn-primary">Back</button></a>

                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">First Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="first_name" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Last Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Phone</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="phone" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="address" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">City</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="city" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">State</label>
                        <div class="col-md-6">
                            <select  class="form-control" name="state" required>
                                <option disabled selected value>Select a State</option>
                                <option value="VIC">Victoria</option>
                                <option value="NSW">New South Wales</option>
                                <option value="QLD">Queensland</option>
                                <option value="TAS">Tasmania</option>
                                <option value="WA">Western Australia</option>
                                <option value="SA">South Australia</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Postal Code</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="post_code" required pattern="\d{4}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}">
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
