@extends('app')

@section('content')
    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Business Configuration</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="/business" files="true"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="image" class="col-md-4 control-label">Background Image</label>
                            <div class="col-md-6">
                                <input type="file" name="image" accept=".png,.jpg,.jpeg">
                            </div>
                        <!--<img src="{{$business->bg_img}}" alt="" class="col-md-6">-->
                        </div>
                        <div class="form-group">
                            <label for="logo" class="col-md-4 control-label">Logo</label>
                            <div class="col-md-6">
                                <input type="file" name="logo" accept=".png,.jpg,.jpeg">
                            </div>
                        <!--<img src="{{$business->logo_img}}" alt="" class="col-md-6">-->
                        </div>

                        <div class="form-group {{ $errors->has('main_title') ? ' has-error' : '' }}">
                            <label for="main_title" class="col-md-4 control-label">Home Page Title Text</label>
                            <div class="col-md-6">
                                <textarea class="form-control"
                                          name="main_title"
                                          required autofocus>{{$business->main_title}}</textarea>
                                @if ($errors->has('main_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('main_text') ? ' has-error' : '' }}">
                            <label for="main_text" class="col-md-4 control-label">Home Page Title Description</label>
                            <div class="col-md-6">
                                <textarea class="form-control"
                                          name="main_text"
                                          required
                                          autofocus>{{$business->main_text}}</textarea>
                                @if ($errors->has('main_text'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Business Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="name" value="{{$business->name}}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Business Phone</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="phone" value="{{$business->phone}}" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Business email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="email" value="{{$business->email}}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Business Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control"
                                       name="address" value="{{$business->address}}" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">Update Business</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
