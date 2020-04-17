@extends('auth.authLayout')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ url('design\assets\pages\flag-icon\flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('design\assets\pages\menu-search\css\component.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('design\assets\pages\multi-step-sign-up\css\reset.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ url('design\assets\pages\multi-step-sign-up\css\style.css')}}">
@endsection

@section('content')

    <form id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active">Account Setup</li>
            <li>Social Profiles</li>
            <li>Personal Details</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
            <img class="logo" src="{{ url('design\assets\images\logo-blue.png')}}" alt="logo.png">
            <h2 class="fs-title">Sign up</h2>
            <h3 class="fs-subtitle">Let’s have a new beginning. Sign up for new you</h3>
            <div class="input-group">
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="input-group">
                <input type="password" class="form-control" name="pass" placeholder="Password">
            </div>
            <div class="input-group">
                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
            </div>
            <button type="button" name="next" class="btn btn-primary next" value="Next">Next</button>
        </fieldset>
        <fieldset class="">
            <img class="logo" src="{{ url('design\assets\images\logo-blue.png')}}" alt="logo.png">
            <h2 class="fs-title">Social Profiles</h2>
            <h3 class="fs-subtitle">Little bit about your presence on social media</h3>
            <div class="input-group">
                <input type="text" class="form-control" name="twitter" placeholder="Twitter">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="facebook" placeholder="Facebook">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="gplus" placeholder="Google Plus">
            </div>
            <button type="button" name="previous" class="btn btn-inverse btn-outline-inverse previous" value="Previous">
                Previous
            </button>
            <button type="button" name="next" class="btn btn-primary next" value="Next">Next</button>
        </fieldset>
        <fieldset>
            <img class="logo" src="{{ url('design\assets\images\logo-blue.png')}}" alt="logo.png">
            <h2 class="fs-title">Personal Details</h2>
            <h3 class="fs-subtitle">And something about yourself!</h3>
            <div class="input-group">
                <input type="text" class="form-control" name="fname" placeholder="First Name">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="lname" placeholder="Last Name">
            </div>
            <div class="input-group">
                <input type="text" class="form-control" name="phone" placeholder="Phone">
            </div>
            <div class="input-group">
                <textarea name="address" class="form-control" placeholder="Address"></textarea>
            </div>
            <button type="button" name="previous" class="btn btn-inverse btn-outline-inverse previous" value="Previous">
                Previous
            </button>
            <button type="button" name="next" class="btn btn-primary" value="submit">Submit</button>
        </fieldset>
    </form>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script type="text/javascript" src="{{ url('design\assets\pages\multi-step-sign-up\js\main.js')}}"></script>
@endsection
