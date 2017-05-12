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

                        <div class="form-group">
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

                        <div class="form-group">
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
