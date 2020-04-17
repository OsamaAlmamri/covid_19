@extends('auth.authLayout')
@section('style')


@endsection

@section('content')


    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    {!! Form::open(['role' => 'form', 'class'=>'md-float-material form-material', 'route' => 'customer.registerPost', 'id' => 'register_form', 'method' => 'post', 'files' => true]) !!}

                    <div class="text-center">
                        <img src="..\files\assets\images\logo.png" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Sign up</h3>
                                </div>
                            </div>
                            {{--                            <div class="row m-b-20">--}}
                            {{--                                <div class="col-md-6">--}}
                            {{--                                    <a href="#!" class="btn btn-facebook m-b-20 btn-block waves-effect waves-light"><i--}}
                            {{--                                            class="icofont icofont-social-facebook"></i>facebook</a>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-6">--}}
                            {{--                                    <a href="#!" class="btn btn-twitter m-b-0 btn-block waves-effect waves-light"><i--}}
                            {{--                                            class="icofont icofont-social-twitter"></i>twitter</a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <p class="text-muted text-center p-b-5">Sign up with your regular account</p>
                            <p class="text-muted text-center p-b-5" id="message"></p>

                            <div id="step1">
                                <div class="print-error-msg common">
                                    <ul class="alert-success list-unstyled">
                                        <li class="error_error"></li>
                                    </ul>
                                </div>

                                <div class="input-group">
                                    <span class="input-group-addon">Phone Number</span>
                                    <input id="phone_number" type="text" class="form-control" name="msg"
                                           placeholder="777555777">
                                </div>
                                <div class="print-error-msg alert-danger error_phone"></div>
                                <input type="hidden" id="login_by" value="" name="login_by"/>
                                <input type="hidden" name="accessToken" value="" id="accessToken"/>

                                <div class="form-group mobile_otp_verfication" style="display: none;">
                                    <label>رمز التحقق</label>
                                    <input type="text" class="form-control " placeholder="Otp" name="otp" id="otp"
                                           value="">
                                </div>
                                <div class="print-error-msg alert-danger error_otp" id="error_otp"></div>
                            </div>


                            <div id="step2" style="display: none">
                                <input type="hidden" id="verified_opt" name="verified_opt" value=""/>
                                <input type="hidden" id="otp_ref" name="otp_ref" value=""/>
                                <input type="hidden" id="otp_phone" name="phone" value=""/>
                                <div class="form-group form-primary">
                                    <input type="text" name="username" class="form-control" required=""
                                           value="{{old('username')}}" placeholder="Choose Username">
                                    <span class="form-bar"></span>
                                    <div class="print-error-msg alert-danger error_username"></div>

                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="name" class="form-control" required=""
                                           value="{{old('name')}}" placeholder="Your fullName">
                                    <span class="form-bar"></span>
                                    <div class="print-error-msg alert-danger error_name"></div>

                                </div>

                                <div class="form-group form-primary">
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}"
                                           required=""
                                           placeholder="Your Email Address">
                                    <span class="form-bar"></span>
                                    <div class="print-error-msg alert-danger error_email"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" name="password" class="form-control" required=""
                                                   placeholder="Password">
                                            <span class="form-bar"></span>
                                            <div class="print-error-msg alert-danger error_password"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   required=""
                                                   placeholder="Confirm Password">
                                            <span class="form-bar"></span>
                                            <div class="print-error-msg alert-danger error_password_confirmation"></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--                            <div class="row m-t-25 text-left">--}}
                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <div class="checkbox-fade fade-in-primary">--}}
                            {{--                                        <label>--}}
                            {{--                                            <input type="checkbox" value="">--}}
                            {{--                                            <span class="cr"><i--}}
                            {{--                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                            {{--                                            <span class="text-inverse">I read and accept <a href="#">Terms &amp; Conditions.</a></span>--}}
                            {{--                                        </label>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <div class="checkbox-fade fade-in-primary">--}}
                            {{--                                        <label>--}}
                            {{--                                            <input type="checkbox" value="">--}}
                            {{--                                            <span class="cr"><i--}}
                            {{--                                                    class="cr-icon icofont icofont-ui-check txt-primary"></i></span>--}}
                            {{--                                            <span class="text-inverse">Send me the <a--}}
                            {{--                                                    href="">Newsletter</a> weekly.</span>--}}
                            {{--                                        </label>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button onclick="smsLogin()"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 mobile_verfication">

                                        {{trans('form.verifyPhone')}}
                                    </button>
                                    <div id="mobile_verfication">

                                    </div>
                                    <button type="button" class="login-btn mobile_otp_verfication" onclick="checkotp();"
                                            value="Verify Otp" style="display: none;">تحقق من رمز التحقق
                                    </button>
                                    <button type="button" onclick="register()" class="login-btn register_btn"
                                            value="Verify Otp" style="display: none;">تسجيل
                                    </button>

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="text-inverse text-left m-b-0">Thank you.</p>
                                    <p class="text-inverse text-left">
                                        <a href="/customer/login" id="gotToLogin"><b class="f-w-600">I have Account</b></a></p>
                                </div>
                                <div class="col-md-2">
                                    <img src="..\files\assets\images\auth\Logo-small-bottom.png" alt="small-logo.png">
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

@endsection

@section('script')
    <script>

        function smsLogin() {
            // $('#gotToLogin').trigger('click');
            // $('#gotToLogin').click();
            // alert('ssssssssssss');
            var countryCode = '+967';
            var phoneNumber = document.getElementById("phone_number").value;
            if (countryCode != '') {
                //var code = $('.selected-dial-code').html();
                //$('#country_code').val(code);
                var countryCode = '+967';
                var phoneNumber = document.getElementById("phone_number").value;
                var accessToken = $("#register_form #accessToken").val();
                var login_by = $("#register_form #login_by").val();
                var phone;
                $('#otp_phone').val(countryCode + '' + phoneNumber);
                if (phoneNumber != '') {
                    phone = countryCode + '' + phoneNumber;
                } else {
                    phone = '';
                }
                $.ajax({
                    url: "{{url('/otp')}}",
                    type: 'POST',
                    data: {
                        phone: phone,
                        '_token': '{{csrf_token()}}',
                        'login_by': login_by,
                        'accessToken': accessToken
                    },
                    success: function (data) {
                        console.log(data);
                        if ($.isEmptyObject(data.error)) {
                            my_otp = data.otp;
                            $('.mobile_otp_verfication').show();
                            $('.mobile_verfication').hide();
                            $('.mobile_verfication').html("<p class='helper'> Please Wait... </p>");
                            $('#phone_number').attr('readonly', true);
                            $('#country_code').attr('readonly', true);
                            <!--$('#otp').val(data.otp);-->
                            <!--$('#otp').attr('readonly',true);-->
                            $("#register_form .common").html('<ul class="list-unstyled"></ul>');
                            $(".alert-danger").css("display", "none");
                            $("#register_form .common").find('ul').removeClass('alert-danger').addClass('alert-success');
                            $("#register_form .common").find("ul").append('<li>' + data.message + '</li>');
                        } else {
                            printErrorMsg(data.error, 'register_form');
                        }
                    },
                    error: function (jqXhr, status) {
                        console.log(jqXhr);
                        if (jqXhr.status === 422) {
                            $(".alert-danger").css("display", "block");
                            $("#register_form .print-error-msg").html('');
                            $("#register_form .common").html('<ul class="list-unstyled"><li class="error_error "></li></ul>');
                            $("#register_form .print-error-msg").show();
                            var errors = jqXhr.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                if (key == 'error') {
                                    $("#register_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                                }
                                $("#register_form").find(".error_" + key).html(value);
                            });
                        }
                    }

                });
            } else {
                $(".alert-danger").css("display", "block");
                $("#register_form").find(".error_phone").html('');
                $("#register_form").find(".error_phone").html('Country code Required');

            }
        }

        function register() {

            var formData = $('form').serialize();
            $.ajax({
                url: "{{url('customers')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data);
                    alert('تم التسجيل بنجاح يمكنك الان تسجيل الدخول ') ;
                    location.replace("/customers/login");


                    // if (data.ok == 1) {
                    //     if ($('#register_form #login_by').val() != '') {
                    //         //$(".register_btn" ).trigger('click');
                    //     }
                    //     $("#register_form .print-error-msg").find("ul").html('');
                    //     $('#mobile_otp_verfication').html("<p class='helper'> Please Wait... </p>");
                    //     $('#phone_number').attr('readonly', true);
                    //     $('#country_code').attr('readonly', true);
                    //     $('.mobile_otp_verfication').hide();
                    //     $('#second_step').fadeIn(400);
                    //     $('#step2').show();
                    //     $('.register_btn').show();
                    //     $('.dm').hide();
                    //     $("#verified_opt").val(data.opt);
                    //     $('#mobile_verfication').show().html("<p class='helper'> * Phone Number Verified </p>");
                    //     my_otp = '';
                    // } else {
                    //     $("#register_form .print-error-msg").html('');
                    //     $("#register_form").find(".error_otp").html('Otp not Matched!');
                    // }


                },
                error: function (jqXhr, status) {
                    console.log(jqXhr);
                    if (jqXhr.status === 422) {
                        $(".alert-danger").css("display", "block");
                        $("#register_form .print-error-msg").html('');
                        $("#register_form .common").html('<ul class="list-unstyled"><li class="error_error"></li></ul>');
                        $("#register_form .print-error-msg").show();
                        var errors = jqXhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            if (key == 'error') {
                                $("#register_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                            }
                            $("#register_form").find(".error_" + key).html(value);
                        });
                    }
                }

            });
        }

        function checkotp() {
            var otp = document.getElementById("otp").value;
            if (otp) {
                $.ajax({
                    url: "{{url('/checkOtp')}}",
                    type: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'otp': otp,
                    },
                    success: function (data) {

                        if (data.ok == 1) {
                            $("#register_form .print-error-msg").find("ul").html('');
                            $('#mobile_otp_verfication').html("<p class='helper'> Please Wait... </p>");
                            $('#phone_number').attr('readonly', true);
                            $('#country_code').attr('readonly', true);
                            $('.mobile_otp_verfication').hide();
                            $('#second_step').fadeIn(400);
                            $('#step2').show();
                            $('.register_btn').show();
                            $('.dm').hide();
                            $("#verified_opt").val(data.opt);
                            $('#mobile_verfication').show().html("<p class='helper'> * Phone Number Verified </p>");
                            my_otp = '';
                        } else {
                            $("#register_form .print-error-msg").html('');
                            $("#error_otp").html(data.error);
                        }


                    },
                    error: function (jqXhr, status) {
                        console.log(jqXhr);
                        if (jqXhr.status === 422) {
                            $(".alert-danger").css("display", "block");
                            $("#register_form .print-error-msg").html('');
                            $("#register_form .common").html('<ul class="list-unstyled"><li class="error_error"></li></ul>');
                            $("#register_form .print-error-msg").show();
                            var errors = jqXhr.responseJSON.errors;

                            $.each(errors, function (key, value) {
                                if (key == 'error') {
                                    $("#register_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                                }
                                $("#register_form").find(".error_" + key).html(value);
                            });
                        }
                    }

                });
            } else {
                $("#register_form .print-error-msg").html('');
                $("#register_form").find(".error_otp").html('Otp field is required');
            }
        }

        function printErrorMsg(msg, form) {
            $("#" + form + ".common").find('ul').html('');
            $("#" + form + ".common").css('display', 'block');
            $("#" + form + ".common").show();
            if (typeof msg === 'string') {
                $("#" + form + ".common").find('ul').removeClass('alert-success').addClass('alert-danger');
                $("#" + form + ".common").find('ul').append('<li>' + msg + '</li>');
            } else {
                $.each(msg, function (key, value) {
                    $("#" + form + ".print-error-msg").find('ul').append('<li>' + value + '</li>');
                });
            }
        }

    </script>

@endsection
