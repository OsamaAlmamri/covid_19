@extends('layout')
@section('styles')
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-forms.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\advance-elements\css\bootstrap-datetimepicker.css')}}">

    <!-- Tags css -->
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css')}}">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\datedropper\css\datedropper.min.css')}}">


    <link href="{{HostUrl('design\bower_components\select2\dist\css\select2.min.css')}}" rel="stylesheet">
    <link href="{{HostUrl('design/custom/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">
    <link href="{{HostUrl('design\custom\css\easy-autocomplete.min.css')}}" rel="stylesheet">
    <style>
        .thumb {
            width: 200px;
        }

    </style>
    <style type="text/css">
    </style>
@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4> {{trans('menu.users')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}"> {{trans('menu.users')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($user))   {{trans('form.update.user')}}  @else  {{trans('form.add.user')}}  @endif

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="page-body">
        @if(isset($user))
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'users.store', 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h5> @if(isset($user))   {{trans('form.update.user')}}  {{$user->name}} @else {{trans('form.add.user')}}   @endif </h5>
            </div>
            <div class="card-block">
                <div class="wrapper wrapper-640">
                    <div class="j-forms">
                        <div class="content">
                            <div class="divider-text gap-top-20 gap-bottom-45">
                                <span>{{trans('form.info.user')}}</span>
                            </div>
                            <!-- start name email -->
                            <div class="j-row">
                                <div class="span6 unit">
                                    <div class="input">
                                        <label class="icon-right" for="username">
                                            <i class="fa fa-user"></i>
                                        </label>
                                        {!! Form::text('username', null, [ 'id' => 'username'  ,'placeholder'=>trans("form.username")]) !!}
                                        @error('username') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                                <div class="span6 unit">
                                    <div class="input">
                                        <label class="icon-right" for="email">
                                            <i class="fa fa-envelope"></i>
                                        </label>
                                        {!! Form::email('email', null, [ 'id' => 'email'  ,'placeholder'=>trans("form.email")]) !!}
                                        @error('email') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                            </div>
                            <!-- end name email -->
                            <!-- start password -->
                            <div class="j-row">
                                <div class="span6 unit">
                                    <div class="input">
                                        <label class="icon-right" for="reg_password">
                                            <i class="fa fa-lock"></i>
                                        </label>
                                        <input type="password" id="reg_password" name="password"
                                               value="{{old('password')}}" placeholder="{{trans("form.password")}}">
                                        @error('password') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror


                                    </div>
                                </div>
                                <div class="span6 unit">
                                    <div class="input">
                                        <label class="icon-right" for="confirm_password">
                                            <i class="fa fa-lock"></i>
                                        </label>
                                        <input type="password" id="confirm_password"
                                               name="password_confirmation"
                                               placeholder="{{trans("form.confirm_password")}}">
                                        @error('password_confirmation') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="j-row">

                                {{--                                                                    @if(isset($user))--}}
                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.role')}}</label>
                                    <div class="j-input">
                                        {!!Form ::select('role', getAllRole(),isset($user)?getFirstRole($user->id):5,['class' => 'select2 form-control', 'id' => 'role'])!!}
                                    </div>
                                    @error('role') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.worker')}}</label>
                                    <div class="j-input">
                                        {!!Form ::select('work_team_id', getAllWorker(),isset($quarantine)?$quarantine->work_team_id:null,['class' => 'select2 form-control', 'id' => 'work_team_id'])!!}
                                    </div>
                                    @error('work_team_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            <div class="j-row">
                                <label class="j-label"> {{trans("form.PersonalImage")}}</label>
                                <div class="form-group col-xs-12 mb-2">
                                    <input type="file" accept="image/*" name="avatar"
                                           class="dropify form-control"
                                           id="avatar"
                                           aria-describedby="fileHelp" required>

                                    @error('avatar') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>

                            </div>
                            <!-- end confirm password -->
                            <div class="divider gap-bottom-25"></div>
                            <!-- end gender -->
                            <div class="col-xs-12 mb-2">
                                <a href="{{ route('users.index') }}" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> {{trans("form.cancel")}}
                                </a>
                                <button type="button" onclick="return admincreate();" class="btn btn-primary">
                                    <i class="fa fa-check-square-o"></i> {{trans("form.save")}}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


@endsection



@section('js')

    <!-- Custom js -->
    <script type="text/javascript"
            src="{{ HostUrl('design\assets\pages\j-pro\js\custom\booking.js')}}"></script>
    <script type="text/javascript"
            src="{{ HostUrl('design\bower_components\bootstrap-tagsinput\js\bootstrap-tagsinput.js')}}"></script>
    <!-- Select2 -->
    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>


    <script type="text/javascript"
            src="{{HostUrl('design\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript"
            src="{{HostUrl('design\bower_components\datedropper\js\datedropper.min.js')}}"></script>


    <script type="text/javascript" src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="{{ asset('design/custom/js/jquery.easy-autocomplete.min.js') }}"
            type="text/javascript"></script>





    <script type="text/javascript">
        $('.dropify').dropify();

        $(".dropper-border").dateDropper({
            dropWidth: 200,
            dropPrimaryColor: "#1abc9c",
            dropBorder: "2px solid #1abc9c"
        });


        $('.input-daterange input').each(function () {
            $(this).datepicker();
        });
        $('#sandbox-container .input-daterange').datepicker({
            todayHighlight: true
        });

        function admincreate() {
            {{--                @if(! isset($admin))--}}
            {{--            var phone = $('#country_code').val() + $('#phone1').val();--}}
            {{--            $('#phone').val(phone);--}}
            {{--            @endif--}}
            $('#j-pro').submit();
        }

        var options = {

            url: "{{asset('design/custom/js/countryCodes.json')}}",

            getValue: "name",

            list: {
                match: {
                    enabled: true
                },
                onClickEvent: function () {
                    var value = $("#country_code").getSelectedItemData().dial_code;

                    $("#country_code").val(value).trigger("change");
                },
                maxNumberOfElements: 1000
            },

            template: {
                type: "custom",
                method: function (value, item) {
                    return "<span class='flag flag-" + (item.dial_code).toLowerCase() + "' ></span>" + value + "(" + item.dial_code + ")";
                }
            },

            theme: "round"
        };
        $("#country_code").easyAutocomplete(options);
    </script>

    <script>
        $(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2').select2()
        })

    </script>
@endsection
