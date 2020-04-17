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
    <!-- Tags css -->
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\bootstrap-tagsinput\css\bootstrap-tagsinput.css')}}">
    <!-- Date-Dropper css -->

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
                        <h4> {{trans('menu.projects')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('projects.index')}}"> {{trans('menu.projects')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($project))   {{trans('form.update.project')}}  @else  {{trans('form.add.project')}}  @endif

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
        @if(isset($project))
            {!! Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'projects.store', 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h5> @if(isset($project))   {{trans('form.update.project')}}  {{$project->name}} @else {{trans('form.add.project')}}   @endif </h5>
            </div>
            <div class="card-block">
                <div class="wrapper wrapper-640">
                    <div class="j-forms">
                        <div class="content">
                            <div class="divider-text gap-top-20 gap-bottom-45">
                                <span>{{trans('form.info.project')}}</span>
                            </div>
                            <!-- start name email -->
                            <div class="j-row">
                                <div class="input">
                                    <label class="icon-right" for="title">
                                        <i class="fa fa-tag"></i>
                                    </label>
                                    {!! Form::text('title', null, [ 'id' => 'title'  ,'placeholder'=>trans("form.project.title")]) !!}
                                    @error('title') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <!-- end name email -->
                            <div class="divider gap-bottom-25"></div>

                            <div class="j-row">
                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.code')}}</label>

                                    <div class="input">
                                        {!! Form::text('code',(isset($project))?$project->code: null  , [ 'id' => 'name'  ,'placeholder'=>trans("form.project.code")]) !!}
                                        @error('code') <span
                                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.projects.manager')}}</label>
                                    <div class="j-input">
                                        {!!Form ::select('manager_id', getAllManagers(),isset($project)?$project->manager_id:null,['class' => 'select2 form-control', 'id' => 'manager_id'])!!}
                                    </div>
                                    @error('manager_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            <div class="j-row">
                                <div class="col-sm-12 col-xl-8">
                                    <h4 class="sub-title">{{trans('form.project.project_ranage')}}</h4>
                                    <div class="input-daterange input-group" id="datepicker">
                                        {!! Form::text('start_date',  isset($project)?dateFormat($project->start_date):null, [ 'id' => '' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.start_date')]) !!}

                                        <span class="input-group-addon">to</span>
                                        {!! Form::text('end_date',  isset($project)?dateFormat($project->end_date):null, [ 'id' => '' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.end_date')]) !!}

                                    </div>
                                    @error('end_date') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                    @error('start_date') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- end confirm password -->
                            <div class="divider gap-bottom-25"></div>
                            <div class="j-unit">
                                <label class="j-label">Description {{trans('form.projects.description')}}</label>
                                <div class="j-input">
                                    {{--                                    <textarea spellcheck="false" name="description"></textarea>--}}
                                    {{ Form::textarea('description', null, ['rows' => 10, 'cols' => 100]) }}
                                    @error('description') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="divider gap-bottom-25"></div>
                            <!-- end gender -->
                            <div class="j-row">
                                <div class="col-xs-12 ">
                                    <a href="{{ route('projects.index') }}" class="btn btn-warning ">
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
