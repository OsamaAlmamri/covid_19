@extends('layout')
@section('styles')
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-forms.css')}}">

    <link href="{{HostUrl('design\bower_components\select2\dist\css\select2.min.css')}}" rel="stylesheet">
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
                        <h4> {{trans('menu.quarantines')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{route('quarantines.index')}}"> {{trans('menu.quarantines')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($quarantine))   {{trans('form.update.quarantine')}}  @else  {{trans('form.add.quarantine')}}  @endif

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
        @if(isset($quarantine))
            {!! Form::model($quarantine, ['route' => ['quarantines.update', $quarantine->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'quarantines.store', 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h5> @if(isset($quarantine))   {{trans('form.update.quarantine')}}  {{$quarantine->name}} @else {{trans('form.add.quarantine')}}   @endif </h5>
            </div>
            <div class="card-block">
                <div class="wrapper wrapper-640">
                    <div class="j-forms">
                        <div class="content">
                            <div class="divider-text gap-top-20 gap-bottom-45">
                                <span>{{trans('form.info.quarantine')}}</span>
                            </div>
                            <!-- start name email -->
                            <div class="j-row">
                                <div class="input">
                                    <label class="icon-right" for="title">
                                        <i class="fa fa-tag"></i>
                                    </label>
                                    {!! Form::text('name', null, [ 'id' => 'title'  ,'placeholder'=>trans("form.quarantines.name")]) !!}
                                    @error('name') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <!-- end name email -->
                            <div class="divider gap-bottom-25"></div>
                            <div class="j-row">
                                <div class="span6 unit">
                                    <label class="j-label"> {{trans('form.government')}} </label>
                                    <div class="j-input">
                                        {!!Form ::select('governorate_id', getGovernorates(),(isset($quarantine)) ?$quarantine->zone->zone->id:null,['class' => 'select2 form-control', 'id' => 'governorate_id'])!!}
                                    </div>
                                    @error('governorate_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror


                                </div>
                                <div class="span6 unit">
                                    <label class="j-label">{{trans('form.zone')}} </label>
                                    <div class="j-input">

                                        {!!Form ::select('zone_id',(isset($quarantine))?getZones($quarantine->zone->zone->id):getZones(),(isset($quarantine))?$quarantine->zone->id:null,['class' => 'select2 form-control', 'id' => 'zone_id'])!!}
                                    </div>
                                    @error('zone_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror


                                </div>
                            </div>


                            <div class="j-row">

                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.quarantines.quarantine_area_type')}}</label>
                                    <div class="j-input">
                                        {!!Form ::select('quarantine_area_type_id', getAllQuarantineTyprs(),isset($quarantine)?$quarantine->manager_id:null,['class' => 'select2 form-control', 'id' => 'quarantine_area_type'])!!}
                                    </div>
                                    @error('manager_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="span6 unit">
                                    <label class="j-label">  {{trans('form.quarantines.manager')}}</label>
                                    <div class="j-input">
                                        {!!Form ::select('manager_id', getAllWorker(),isset($quarantine)?$quarantine->manager_id:null,['class' => 'select2 form-control', 'id' => 'manager_id'])!!}
                                    </div>
                                    @error('manager_id') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>
                            <!-- end confirm password -->
                            <div class="j-row">
                                <div class="input">
                                    <label class="j-label">{{trans("form.quarantines.maxCapacity")}} </label>

                                    {!! Form::number('maxCapacity', null, [ 'id' => 'title', 'class'=>"form-control"  ,'placeholder'=>trans("form.quarantines.maxCapacity")]) !!}
                                    @error('maxCapacity') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>

                            <div class="divider gap-bottom-25"></div>
                            <!-- end gender -->
                            <div class="j-row">
                                <div class="col-xs-12 ">
                                    <a href="{{ route('quarantines.index') }}" class="btn btn-warning ">
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

@include('includes.changeZones') 


@section('js')

    <!-- Custom js -->
    <script type="text/javascript"
            src="{{ HostUrl('design\assets\pages\j-pro\js\custom\booking.js')}}"></script>

    <!-- Select2 -->
    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>



    <script type="text/javascript">
        getZones('governorate_id', 'zone_id');


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
