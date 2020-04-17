<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Hr</title>
        <title>{{ Setting::get('site_title') }}</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    {{--    <link rel="icon" href="images\favicon.ico" type="image/x-icon">--}}
    <link rel="shortcut icon" href="{{ Setting::get('site_favicon', asset('favicon.ico')) }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
          href="{{HostUrl('design\assets\icon\font-awesome\css\font-awesome.min.css')}}">
    <!-- Google font-->
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">--}}
<!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\bootstrap\css\bootstrap.min.css')}}">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{HostUrl('design\404\css\style.css')}}">
</head>
<body style="background: #482878">
<div id="container" class="container">
    <ul id="scene" class="scene">
        <li class="layer" data-depth="1.00"><img src="{{HostUrl('design\404\images\404-01.png')}}"></li>
        <li class="layer" data-depth="0.60"><img src="{{HostUrl('design\404\images\shadows-01.png')}}"></li>
        <li class="layer" data-depth="0.20"><img src="{{HostUrl('design\404\images\monster-01.png')}}"></li>
        <li class="layer" data-depth="0.40"><img src="{{HostUrl('design\404\images\text-01.png')}}"></li>
        <li class="layer" data-depth="0.10"><img src="{{HostUrl('design\404\images\monster-eyes-01.png')}}"></li>
    </ul>
    <h1>Page not found</h1>

    <a href="{{route('home')}}" class="btn">Back to home</a>
</div>
<!-- Scripts -->
<script src="{{HostUrl('design\404\js\parallax.js')}}"></script>
<script>
    // Pretty simple huh?
    var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
</script>

</body>
</html>
