@extends('app')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
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
                            <input type="text" class="form-control" name="last_name" required autofocus>
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
                            <input type="text" class="form-control" name="phone" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="address" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">City</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="city" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">State</label>
                        <div class="col-md-6">
                            <select  class="form-control" name="state" required autofocus>
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
                            <input type="text" class="form-control" name="post_code" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
