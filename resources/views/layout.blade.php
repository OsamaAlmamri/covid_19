<!DOCTYPE html>
<html lang="en">

<head>
    <title>time sheet</title>
    {{--    <title>{{ Setting::get('site_title') }}</title>--}}


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords"
          content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <meta name="google-site-verification" content="M9gUKXm-MlzvyxHTkSxKjI6MkTZsqW-8gd7Tkq3B_po"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="icon" href="{{HostUrl('images\s_logo.png')}}" type="image/x-icon">--}}
    <link rel="shortcut icon" href="{{ Setting::get('site_favicon', asset('favicon.ico')) }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
          href="{{HostUrl('design\assets\icon\font-awesome\css\font-awesome.min.css')}}">
    <!-- Google font-->
{{--    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">--}}
<!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\bootstrap\css\bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\icon\themify-icons\themify-icons.css')}}">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\icon\feather\css\feather.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\data-table\css\buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">
    <link rel=stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\data-table\extensions\responsive\css\responsive.dataTables.css')}}">


@yield('styles')
@yield('dataTablesCss')

<!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\css\style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\css\jquery.mCustomScrollbar.css')}}">
    <link href="{{HostUrl('design\toastr\toastr.css')}}" rel="stylesheet">

    @if((lang() == 'ar'))
        <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\css\extraRTLCSS.css')}}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\css\extraLTRCSS.css')}}">
    @endif


    <style>
        .primary_site_color {
            color: #00bdd4
        }

        .task_description {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: inherit;
        }
        .noActiveMenu {
            color: #92a3b2;

        }



        #loadingDiv {
            top: 50%;
            z-index: 99999999999999999999999999;
            right: 45%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            position: fixed;
        }


        .manage_btns i {
            font-size: 20px;
            margin: 0 7px
        }
    </style>

    <style>

    </style>

</head>

<body dir="{{(lang() == 'ar')?'rtl':'ltr'}}">
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

<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

    @include('includes.HeaderNavbar')

    <!-- Sidebar chat start -->
        @include('includes.Sidebar')

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('includes.menu')
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Main-body start -->
                        <div class="main-body">
                            <div class="page-wrapper">
                            @include('includes.messages')
                            <!-- Page-header start -->
                            @yield('breadcrumb')
                            <!-- Page-header end -->
                                <!-- Page body start -->
                            @yield('content')

                            <!-- Page body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                                                <div id="styleSelector">

                    </div>

                    {{--                        <div id="locationStyleSelector">--}}

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<div id="sound"></div>

<script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery\js\jquery.min.js')}}"></script>
{{--<script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery\js\jquery-3.4.1.min.js')}}"></script>--}}
<script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\popper.js\js\popper.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript"
        src="{{ HostUrl('design\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}"></script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ HostUrl('design\bower_components\modernizr\js\modernizr.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\bower_components\modernizr\js\css-scrollbars.js')}}"></script>


@yield('dataTablesJs')

<script type="text/javascript" src="{{ HostUrl('design\assets\js\modal.js')}}"></script>

<script src="{{ HostUrl('design\assets\js\pcoded.min.js')}}"></script>
@include('layouts.vartical-layout')
<script src="{{ HostUrl('design\assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\assets\js\script.js')}}"></script>
<script src="{{ HostUrl('design/toastr/toastr.min.js')}}"></script>

<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{Setting::get('GOOGLE_MAP_KEY3')}}&libraries=places&callback=initMap"
    async defer></script>


<!-- Custom js -->
@include('includes.notification_sound')
@include('includes.pusher_init')

<!-- Global site tag (gtag.js) - Google Analytics -->
{{--<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>--}}
@yield('js')


<div id='loadingDiv'>
    <img
        src="{{HostUrl('/images/Spinner.svg')}}"
        alt="loading ..."
    />
</div>
@include('includes.spinnerScript')

</body>

</html>
