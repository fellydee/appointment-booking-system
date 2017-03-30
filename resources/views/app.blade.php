<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>{{ config('app.name') }}</title>
    
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>

<style>

body {
    background-image: url("http://senamalancha.com/(S(nlannpjrpoo3ajpflx5hfb2t))/logindata/bg-8.jpg");
    background-size: cover;
    background-color: rgba(0,0,0,.45);
    background-blend-mode: multiply;
}
</style>

</html>
