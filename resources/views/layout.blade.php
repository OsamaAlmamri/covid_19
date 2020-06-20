<!DOCTYPE html>
<html lang="en">

<head>
    <title> وزارة الصحة والعامة والسكان </title>
    {{--    <title>{{ Setting::get('site_title') }}</title>--}}


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords"
          content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    {{--    <meta name="google-site-verification" content="M9gUKXm-MlzvyxHTkSxKjI6MkTZsqW-8gd7Tkq3B_po"/>--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{HostUrl('images\logo.png')}}" type="image/x-icon">
    {{--    <link rel="shortcut icon" href="{{ Setting::get('site_favicon', asset('favicon.ico')) }}">--}}

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

                        {{--                                                <div id="styleSelector">--}}

                    </div>

                    {{--                        <div id="locationStyleSelector">--}}

                    <div class="footer" style="background-color: #2196f3;    position: relative; ">
                        <div class="container">
                            <div class="col-md-12 text-center">
                                <div class="footer-text">
                                    <p>
                                        Copyright © 2020 <a target="_blank" href="http://targetsguide.com"
                                                            style="font-size: 14px; color: #000000;"><big>Targets
                                                Guide</big> </a>. All Rights Reserved
                                        <!--                                        --><?php
                                        //                                        $string=exec('getmac');
                                        //                                        $mac=substr($string, 0, 17);
                                        //                                        echo $mac;
                                        //                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div id="appLinkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('menu.edit_app_link')}} </h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="form-group">
                                        <textarea name="app_link" id="new_app_link"
                                                  placeholder="https:\\"
                                                  class="form-control" rows="3">
                                            {{setting('app_link')}}
                                        </textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="empty_record ">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{trans('form.close')}}
                    </button>
                </div>
                <div id="">
                    <button type="button" class="btn btn-default" id="btn_save_new_link"
                            data-dismiss="modal">{{trans('form.save')}}
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="showAppLinkModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('menu.show_app_link')}}</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <div class="form-group">
                        <a href="{{route('download_app') }}" target="_blank"> {{setting('app_link')}}</a>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div id="empty_record ">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{trans('form.close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="sound"></div>

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


@yield('dataTablesJs')

<script type="text/javascript" src="{{ HostUrl('design\assets\js\modal.js')}}"></script>

<script src="{{ HostUrl('design\assets\js\pcoded.min.js')}}"></script>
@include('layouts.vartical-layout')
<script src="{{ HostUrl('design\assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{ HostUrl('design\assets\js\script.js')}}"></script>
<script src="{{ HostUrl('design/toastr/toastr.min.js')}}"></script>

<script>
    $(document).on('click', '#btn_save_new_link', function () {
        var url = "";
            {{--        var url = "{{route('admin.customers.updateInitialAccount')}}";--}}
        var name = 'app_link';
        var link_val = $('#new_app_link').val();

        var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&name=' + encodeURIComponent(name) + '&val=' + encodeURIComponent(link_val);
        var url = '{{route('changeSetting')}}';
        var _this = $(this);
        $.ajax({
            url: url,//   var url=$('#news').attr('action');
            method: 'POST',
            dataType: 'json',// data type that i want to return
            data: data,// var form=$('#news').serialize();
            success: function (data) {
                toastr.success('تم التعديل بنجاح');
                location.reload();

            },
            error: function (xhr, status, error) {
            }
        });


    });


    function showAppModal() {
        $('#showAppLinkModal').modal('show');
    }

    function editAppModal() {

        $('#appLinkModal').modal('show');
    }
</script>

<!-- Custom js -->
{{--@include('includes.notification_sound')--}}
{{--@include('includes.pusher_init')--}}

<!-- Global site tag (gtag.js) - Google Analytics -->
{{--<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>--}}
@yield('js')


</body>

</html>
