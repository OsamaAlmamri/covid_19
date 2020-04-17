<!DOCTYPE html>
<html lang="en">

<head>
    <title>HR </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords"
          content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{HostUrl('images\s_logo.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\bower_components\bootstrap\css\bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\icon\themify-icons\themify-icons.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\icon\icofont\css\icofont.css')}}">
    <!-- Style.css -->
    @yield('style')
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\css\style.css')}}">

</head>


<body class="fix-menu">
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->

@yield('content')
<!-- Warning Section Starts -->
<!-- Older IE warning message -->
<!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers
        to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="{{ HostUrl('/design/assets/images/browser/chrome.png')}}" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="{{ HostUrl('/design/assets/images/browser/firefox.png')}}" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="{{ HostUrl('/design/assets/images/browser/opera.png')}}" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="{{ HostUrl('/design/assets/images/browser/safari.png')}}" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="{{ HostUrl('/design/assets/images/browser/ie.png')}}" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery\js\jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\popper.js\js\popper.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript"
        src="{{ HostUrl('design\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ HostUrl('design\bower_components\modernizr\js\modernizr.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\modernizr\js\css-scrollbars.js')}}"></script>
<!-- i18next.min.js -->
@yield('script')
<script type="text/javascript" src="{{ HostUrl('design\bower_components\i18next\js\i18next.min.js')}}"></script>
<script type="text/javascript"
        src="{{ HostUrl('design\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js')}}"></script>
<script type="text/javascript"
        src="{{ HostUrl('design\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js')}}"></script>
<script type="text/javascript"
        src="{{ HostUrl('design\bower_components\jquery-i18next\js\jquery-i18next.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\assets\js\common-pages.js')}}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>
</body>

</html>
