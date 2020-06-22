@extends('auth.authLayout')

<!-- Main Content -->
@section('content')
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form role="form" method="POST" class="md-float-material form-material"
                          action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="text-center">
                            <img src="{{ HostUrl('images\logo2.png')}}" width="300px" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left">Recover your password</h3>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                    <div class="form-group form-primary">
                                        <input type="email" name="email" class="form-control" required=""
                                               placeholder="Your Email Address">
                                        <span class="form-bar"></span>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                    class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">
                                                Reset Password
                                            </button>
                                        </div>

                                    </div>
                                    <p class="f-w-600 text-right">Back to <a href="{{route('login')}}">Login.</a></p>
                                    <div class="row">


                                    </div>
                                    <p style="text-align: center;">
                                        <img src="{{ HostUrl('images\logo3.png')}}" width="300px" alt="small-logo.png">
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--<div class="login-card card-block auth-body mr-auto ml-auto">-->
                    <!--<form class="md-float-material form-material">-->
                    <!--<div class="text-center">-->
                    <!--<img src="../files/assets/images/logo.png" alt="logo.png">-->
                    <!--</div>-->
                    <!--<div class="auth-box">-->
                    <!---->
                    <!--</div>-->
                    <!--</form>-->
                    <!--&lt;!&ndash; end of form &ndash;&gt;-->
                    <!--</div>-->
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>

@endsection
