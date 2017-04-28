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
    background-image: url("http://senamalancha.com/(S(nlannpjrpoo3ajpflx5hfb2t))/logindata/bg-8.jpg");
    background-size: cover;
    background-color: rgba(0,0,0,.55);
    background-blend-mode: multiply;
}
</style>

</html>
