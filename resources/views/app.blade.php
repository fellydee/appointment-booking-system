<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ config('app.name') }}</title>
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('head')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}
    </script>
</head>
<body>
    @include('layout.nav')
    <div class="container">
        @yield('content')
    </div>
    
    <script src="{{ mix('js/app.js') }}"></script>

</body>
<style>

body {
    @if(empty(Auth::user()->business->bg_img))
        background-image: url("/img/background.jpg");
    @else
        background-image: url({{Auth::user()->business->bg_img}});
    @endif
    background-size: cover;
    background-attachment: fixed;
    background-position: center center;
}
</style>

</html>
