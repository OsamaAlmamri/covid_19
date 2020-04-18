@extends('layout')
@section('styles')
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-forms.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\advance-elements\css\bootstrap-datetimepicker.css')}}">
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
                        <h4> {{trans('menu.workTeams')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('workTeams.index')}}"> {{trans('menu.workTeams')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($workTeam))   {{trans('form.update.workTeam')}}  @else  {{trans('form.add.workTeam')}}  @endif

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
        @if(isset($workTeam))
            {!! Form::model($workTeam, ['route' => ['workTeams.update', $workTeam->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'workTeams.store', 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h5> @if(isset($workTeam))   {{trans('form.update.workTeam')}}  {{$workTeam->name}} @else {{trans('form.add.workTeam')}}   @endif </h5>
            </div>
            <div class="card-block">
                <div class="wrapper wrapper-640">
                    <div class="j-forms">
                        <div class="content">
                            <div class="divider-text gap-top-20 gap-bottom-45">
                                <span>{{trans('form.info.workTeam')}}</span>
                            </div>
                            <!-- start name email -->
                            <div class="j-row">
                                <div class="input">
                                    <label class="icon-right" for="title">
                                        <i class="fa fa-tag"></i>
                                    </label>
                                    {!! Form::text('name', null, [ 'id' => 'title'  ,'placeholder'=>trans("form.workTeam.name")]) !!}
                                    @error('name') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="divider gap-bottom-25"></div>
                            <div class="j-row">

                                <div class="span6 unit">
                                    <h4 class="sub-title">{{trans('form.phone')}} </h4>

                                    <div class="input">
                                        <label class="icon-right" for="phone">
                                            <i class="fa fa-phone"></i>
                                        </label>
                                        {!! Form::text('phone', null  , [ 'id' => 'phone'  ,'placeholder'=>trans("form.phone")]) !!}

                                        @error('phone') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="span6 unit">
                                    <h4 class="sub-title">{{trans('form.job')}} </h4>

                                    <div class="input">
                                        {!! Form::text('job', null  , [ 'id' => 'job'  ,'placeholder'=>trans("form.job")]) !!}
                                        @error('job') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                    </div>
                                </div>



                                <div class="span6 unit">

                                    {{--                                    @if(isset($user))--}}
                                    <h4 class="sub-title">{{trans('form.ssn')}} </h4>
                                    <div class="col-sm-3"></div>
                                    <div class="input">
                                        <label class="icon-right" for="country">
                                            <i class="fa fa-id-card"></i>
                                        </label>
                                        {!! Form::text('ssn', null  , [ 'id' => 'phone'  ,'placeholder'=>trans("form.ssn")]) !!}

                                        @error('ssn') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>



                                <div class="span6 unit">

                                    {{--                                    @if(isset($user))--}}
                                    <h4 class="sub-title">{{trans('form.country')}} </h4>
                                    <div class="col-sm-3"></div>
                                    <div class="input">
                                        <label class="icon-right" for="country">
                                            <i class="fa fa-id-card"></i>
                                        </label>
                                        {!! Form::text('country', null  , [ 'id' => 'phone'  ,'placeholder'=>trans("form.country")]) !!}

                                        @error('country') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>





                            </div>
                            <div class="divider gap-bottom-25"></div>
                            <div class="j-row">
                                <div class="span6 unit">
                                    <label class="j-label"> {{trans('form.Governorate')}} </label>
                                    <div class="j-input">
                                        {!!Form ::select('governorate_id', getGovernorates(),(isset($workTeam)) ?$workTeam->zone->zone->id:null,['class' => 'select2 form-control', 'id' => 'governorate_id'])!!}
                                    </div>
                                    @error('governorate_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror


                                </div>
                                <div class="span6 unit">
                                    <label class="j-label">{{trans('form.zone')}} </label>
                                    <div class="j-input">

                                        {!!Form ::select('zone_id',(isset($workTeam))?getZones($workTeam->zone->zone->id):getZones(),(isset($workTeam))?$workTeam->zone->id:null,['class' => 'select2 form-control', 'id' => 'zone_id'])!!}
                                    </div>
                                    @error('zone_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror


                                </div>
                            </div>


                            <div class="j-row">

                                <div class="span6 unit">
                                    {{--                                    @if(isset($user))--}}
                                    <h4 class="sub-title">{{trans('form.workType')}} </h4>
                                    <div class="col-sm-3"></div>
                                    <div class="input">
                                        <label class="icon-right" for="workType">
                                            <i class="fa fa-id-card"></i>
                                        </label>
                                        {!!Form ::select('workType', ['point'=>trans('menu.point'),'health'=>trans('menu.health')],null,['class' => 'select2 form-control', 'id' => 'workType'])!!}

                                        @error('workType') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="span6 unit">
                                    {{--                                    @if(isset($user))--}}
                                    <h4 class="sub-title">{{trans('form.gender')}} </h4>
                                    <div class="col-sm-3"></div>
                                    <div class="input">
                                        <label class="icon-right" for="gender">
                                            <i class="fa fa-id-card"></i>
                                        </label>
                                        {!!Form ::select('gender', ['male'=>trans('form.male'),'female'=>trans('form.female')],null,['class' => 'select2 form-control', 'id' => 'gender'])!!}

                                        @error('gender') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>



                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-xl-6 m-b-30">
                                    <h4 class="sub-title">{{trans('form.join_date')}} </h4>
                                    {!! Form::text('join_date',  isset($workTeam)?dateFormat($workTeam->join_date):null, [ 'id' => '' ,'class'=>'dropper-border form-control','placeholder'=>trans('form.join_date')]) !!}
                                    @error('join_date') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                                <div class="col-sm-12 col-xl-6 m-b-30">
                                    <h4 class="sub-title"> {{trans('form.birth_date')}}</h4>

                                    {!! Form::text('birth_date',  isset($workTeam)?dateFormat($workTeam->birth_date):null, [ 'id' => '' ,'class'=>'dropper-border form-control','placeholder'=>trans('form.birth_date')]) !!}
                                    @error('birth_date') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>

                            </div>

                            <div class="divider gap-bottom-25"></div>
                            <!-- end gender -->
                            <div class="j-row">
                                <div class="col-xs-12 ">
                                    <a href="{{ route('workTeams.index') }}" class="btn btn-warning ">
                                        <i class="ft-x"></i> {{trans("form.cancel")}}
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-square-o"></i> {{trans("form.save")}}
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


@endsection
<script>
    $('.input-daterange input').each(function () {
        $(this).datepicker();
    });
    $('#sandbox-container .input-daterange').datepicker({
        todayHighlight: true
    });

</script>



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


        $('.input-daterange input').each(function () {
            $(this).datepicker();
        });
        $('#sandbox-container .input-daterange').datepicker({
            todayHighlight: true
        });


    </script>
    @include('includes.changeZones') ;

    <script>
        getZones('governorate_id', 'zone_id');

        $(function () {


            $(".dropper-border").dateDropper({
                dropWidth: 200,
                dropPrimaryColor: "#1abc9c",
                dropBorder: "2px solid #1abc9c"
            });

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2').select2()
        })

    </script>
@endsection
