@extends('layout')
@section('styles')
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-pro-modern.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\switchery\css\switchery.min.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="..\files\bower_components\switchery\css\switchery.min.css">--}}


    <link href="{{HostUrl('design\bower_components\select2\dist\css\select2.min.css')}}" rel="stylesheet">
    <link href="{{HostUrl('design/custom/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">

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
                        <h4> {{trans('menu.block_persons')}}</h4>

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
                                href="{{route('check_points.index')}}"> {{trans('menu.block_persons')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($check_point))   {{trans('form.update.block_person')}}  @else  {{trans('form.add.block_person')}}  @endif

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
        @if(isset($blockPerson))
            {!! Form::model($blockPerson, ['route' => ['check_points.update', $blockPerson->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'check_points.store', 'class'=>'j-pro j-multistep','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="j-content">
            <fieldset>
                <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                    <span>{{trans('dataTable.step')}} 1/4 - {{trans("dataTable.personal_info")}}</span>
                </div>
                <!-- start name -->
                <div class="j-unit">
                    <label class="j-label">{{trans("dataTable.bp_name")}} </label>
                    <div class="j-input">
                        <label class="j-icon-right" for="bp_name">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        {{--                                                <input type="text" id="name" name="name">--}}
                        {!! Form::text('bp_name', null, [ 'id' => 'bp_name'  ,'placeholder'=>trans("dataTable.bp_name")]) !!}

                    </div>
                </div>
                <!-- end name -->
                <!-- start email phone -->
                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans("dataTable.gender")}} </label>
                        <div class=" radio-inline">
                            <label>
                                <input type="radio" name="gender" value="male"
                                       @if(isset($blockPerson)and $blockPerson->gender=='male')  checked="checked"
                                       @endif checked="checked">
                                <i class="helper"></i> {{trans("form.male")}}
                            </label>
                        </div>
                        <div class=" radio-inline">
                            <label>
                                <input type="radio" name="gender" value="female"
                                       @if(isset($blockPerson)and $blockPerson->gender=='female') checked="checked" @endif>
                                <i class="helper"></i> {{trans("form.female")}}
                            </label>
                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.birth_date')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="birth_date">
                                <i class="icofont icofont-ui-calendar"></i>
                            </label>
                            <input type="text" id="birth_date" name="birth_date" readonly="">
                        </div>
                    </div>
                </div>
                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans("dataTable.id_type")}} </label>
                        <div class=" radio-inline">
                            <label>
                                <input type="radio" name="id_type" value="personal"
                                       @if(isset($blockPerson)and $blockPerson->id_type=='personal')  checked="checked"
                                       @endif checked="checked">
                                <i class="helper"></i> {{trans("dataTable.personal")}}
                            </label>
                        </div>
                        <div class=" radio-inline">
                            <label>
                                <input type="radio" name="id_type" value="passport"
                                       @if(isset($blockPerson)and $blockPerson->id_type=='passport') checked="checked" @endif>
                                <i class="helper"></i> {{trans("dataTable.passport")}}
                            </label>
                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.id_number')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="id_number">
                                <i class="icofont icofont-ui-calendar"></i>
                            </label>
                            {!! Form::text('id_number', null, [ 'id' => 'id_number'  ,'placeholder'=>trans("dataTable.id_number")]) !!}
                        </div>
                    </div>
                </div>

                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.job')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="job">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!! Form::text('job', null, [ 'id' => 'job'  ,'placeholder'=>trans("dataTable.job")]) !!}

                        </div>
                    </div>
                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.phone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="phone">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('phone', null, [ 'id' => 'phone'  ,'placeholder'=>trans("dataTable.phone")]) !!}

                        </div>
                    </div>
                </div>
                <!-- end email phone -->
                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.relative_phone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="relative_phone">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('relative_phone', null, [ 'id' => 'relative_phone'  ,'placeholder'=>trans("dataTable.relative_phone")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.country')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="country">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!! Form::text('country', null, [ 'id' => 'job'  ,'placeholder'=>trans("dataTable.country")]) !!}

                        </div>
                    </div>
                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('form.government')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="governorate_id">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('governorate_id', getGovernorates(),(isset($blockPerson)) ?$blockPerson->governorate_id:null,['class' => 'select2 form-control', 'id' => 'governorate_id'])!!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('form.zone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="zone_id">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('zone_id',(isset($blockPerson))?getZones($blockPerson->zone->zone->id):getZones(),(isset($blockPerson))?$blockPerson->zone->id:null,['class' => 'select2 form-control', 'id' => 'zone_id'])!!}

                        </div>
                    </div>
                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.id_issue_address')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="id_issue_address">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('id_issue_address', null, [ 'id' => 'id_issue_address'  ,'placeholder'=>trans("dataTable.id_issue_address")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.id_issue_date')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="id_issue_date">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!! Form::text('id_issue_date', null, [ 'id' => 'id_issue_date'  ,'placeholder'=>trans("dataTable.id_issue_date")]) !!}

                        </div>
                    </div>
                </div>
                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.martial_state')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="martial_state">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('martial_state', ['single'=>trans('dataTable.single'),'married'=>trans('dataTable.married'),
                            'divorced'=>trans('dataTable.divorced'),'indecisive'=>trans('dataTable.indecisive'),'widowed'=>trans('dataTable.widowed')],null,['class' => 'select2 form-control', 'id' => 'gender'])!!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.kids_number')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="kids_number">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!! Form::number('kids_number', null, [ 'id' => 'kids_number' ,'min'=>0 ,'placeholder'=>trans("dataTable.kids_number")]) !!}

                        </div>
                    </div>
                </div>
                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.bp_type')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="bp_type">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('bp_type', ['people'=>trans('dataTable.people'),'truck_owner'=>trans('dataTable.truck_owner')],null,['class' => 'select2 form-control', 'id' => 'bp_type'])!!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.truck_number')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="truck_number">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!! Form::text('truck_number', null, [ 'id' => 'truck_number' ,'placeholder'=>trans("dataTable.truck_number")]) !!}

                        </div>
                    </div>
                </div>
                <div class="j-row">
                    <label class="j-label"> {{trans("dataTable.id_front_photo")}}</label>
                    <div class="form-group col-xs-12 mb-2">
                        <input type="file" accept="image/*" name="id_front_photo"
                               class="dropify form-control"
                               id="id_front_photo"
                               aria-describedby="fileHelp" required>

                        @error('avatar') <span
                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                    </div>

                </div>
                <div class="j-row">
                    <label class="j-label"> {{trans("dataTable.id_back_photo")}}</label>
                    <div class="form-group col-xs-12 mb-2">
                        <input type="file" accept="image/*" name="id_back_photo"
                               class="dropify form-control"
                               id="id_back_photo"
                               aria-describedby="fileHelp" required>

                        @error('avatar') <span
                            class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                    </div>

                </div>
                <!-- end email phone -->
            </fieldset>
            <fieldset>
                <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                    <span>{{trans('dataTable.step')}} 2/4  {{trans("dataTable.source_info")}}</span>
                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.last_governorate_visit')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="last_governorate_visit_id">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('last_governorate_visit_id', getGovernorates(),(isset($blockPerson)) ?$blockPerson->last_governorate_visit:null,['class' => 'select2 form-control', 'id' => 'last_governorate_visit_id'])!!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.last_zone_visit')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="last_zone_visit_id">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('last_zone_visit_id',(isset($blockPerson))?getZones($blockPerson->last_zone_visit->zone->id):getZones(),(isset($blockPerson))?$blockPerson->last_zone_visit_id->id:null,['class' => 'select2 form-control', 'id' => 'last_zone_visit_id'])!!}

                        </div>
                    </div>
                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.is_comming_from_other_country')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="is_comming_from_other_country">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('is_comming_from_other_country', [false=>trans('dataTable.no'),true=>trans('dataTable.yes')],null,['class' => 'select2 form-control', 'id' => 'is_comming_from_other_country'])!!}

                        </div>
                    </div>


                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.come_from_country')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="come_from_country">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('come_from_country', null, [ 'id' => 'come_from_country'  ,'placeholder'=>trans("dataTable.come_from_country")]) !!}

                        </div>
                    </div>


                </div>


                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.source_pass_country')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="source_pass_country">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('source_pass_country', null, [ 'id' => 'source_pass_country'  ,'placeholder'=>trans("dataTable.source_pass_country")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.source_how_check_info')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="source_how_check_info">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('source_how_check_info', null, [ 'id' => 'source_how_check_info'  ,'placeholder'=>trans("dataTable.source_how_check_info")]) !!}

                        </div>
                    </div>


                </div>


                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.source_stay_job')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="source_stay_job">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('source_stay_job', null, [ 'id' => 'source_stay_job'  ,'placeholder'=>trans("dataTable.source_stay_job")]) !!}

                        </div>
                    </div>
                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.source_stay_period')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="source_stay_period">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('source_stay_period', null, [ 'id' => 'source_stay_period'  ,'placeholder'=>trans("dataTable.source_stay_period")]) !!}

                        </div>
                    </div>


                </div>


                <div class="j-unit">
                    <label class="j-label">{{trans("dataTable.source_stay_reason")}} </label>
                    <div class="j-input">
                        <label class="j-icon-right" for="source_stay_reason">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        {!! Form::text('source_stay_reason', null, [ 'id' => 'source_stay_reason'  ,'placeholder'=>trans("dataTable.source_stay_reason")]) !!}

                    </div>
                </div>


            </fieldset>


            <fieldset>
                <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                    <span>{{trans('dataTable.step')}} 3/4 -{{trans("dataTable.dest_info")}}</span>
                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_governorate')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_governorate_id">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('dest_governorate_id', getGovernorates(),(isset($blockPerson)) ?$blockPerson->dest_governorate_id:null,['class' => 'select2 form-control', 'id' => 'dest_governorate_id'])!!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.dest_zone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_zone_id">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('dest_zone_id',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_zone_id'])!!}

                        </div>
                    </div>


                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.dest_sub_zone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_sub_zone">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('dest_sub_zone',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_sub_zone'])!!}

                        </div>
                    </div>
                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.dest_hara')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_hara">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('dest_hara',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_hara'])!!}

                        </div>
                    </div>


                    <div class="j-span6 j-unit">
                        <label class="j-label">{{trans('dataTable.dest_sub_hara')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_sub_hara">
                                <i class="icofont icofont-envelope"></i>
                            </label>
                            {!!Form ::select('dest_sub_hara',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_sub_hara'])!!}

                        </div>
                    </div>


                </div>

                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.dest_isolation_neighborhood')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_isolation_neighborhood">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_isolation_neighborhood', null, [ 'id' => 'dest_isolation_neighborhood'  ,'placeholder'=>trans("dataTable.dest_isolation_neighborhood")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_lane_village')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_lane_village">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_lane_village', null, [ 'id' => 'dest_lane_village'  ,'placeholder'=>trans("dataTable.dest_lane_village")]) !!}

                        </div>
                    </div>


                </div>

                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_aqel_moaref')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_aqel_moaref">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_aqel_moaref', null, [ 'id' => 'dest_aqel_moaref'  ,'placeholder'=>trans("dataTable.dest_aqel_moaref")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_aqel_phone')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_aqel_phone">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_aqel_phone', null, [ 'id' => 'dest_aqel_phone'  ,'placeholder'=>trans("dataTable.dest_aqel_phone")]) !!}

                        </div>
                    </div>


                </div>
                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_stay_period')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_stay_period">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_stay_period', null, [ 'id' => 'dest_stay_period'  ,'placeholder'=>trans("dataTable.dest_stay_period")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_exit_date')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_exit_date">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_exit_date', null, [ 'id' => 'dest_exit_date'  ,'placeholder'=>trans("dataTable.dest_exit_date")]) !!}

                        </div>
                    </div>


                </div>

                <div class="j-row">

                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.dest_home_type')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_home_type">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!!Form ::select('dest_home_type', ['rent'=>trans('dataTable.rent'),'private'=>trans('dataTable.private')],null,['class' => 'select2 form-control', 'id' => 'dest_home_type'])!!}
                        </div>
                    </div>


                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.dest_transportation_owner')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_transportation_owner">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_transportation_owner', null, [ 'id' => 'dest_transportation_owner'  ,'placeholder'=>trans("dataTable.dest_transportation_owner")]) !!}

                        </div>
                    </div>


                </div>


                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.dest_transportation_type')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_transportation_type">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_transportation_type', null, [ 'id' => 'dest_transportation_type'  ,'placeholder'=>trans("dataTable.dest_transportation_type")]) !!}

                        </div>
                    </div>
                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.dest_transportation_number')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="dest_transportation_number">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('dest_transportation_number', null, [ 'id' => 'dest_transportation_number'  ,'placeholder'=>trans("dataTable.dest_transportation_number")]) !!}

                        </div>
                    </div>


                </div>


                <div class="j-unit">
                    <label
                        class="j-label">{{trans("dataTable.dest_reason_of_coming_back")}} </label>
                    <div class="j-input">
                        <label class="j-icon-right" for="dest_reason_of_coming_back">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        {!! Form::text('dest_reason_of_coming_back', null, [ 'id' => 'source_stay_reason'  ,'placeholder'=>trans("dataTable.dest_reason_of_coming_back")]) !!}

                    </div>
                </div>


            </fieldset>


            <fieldset>
                <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                    <span>{{trans('dataTable.step')}} 4/4 - {{trans("dataTable.health_info")}}</span>
                </div>
                <!-- start message -->
                <div class="j-row">
                    <div class="j-span6 j-unit">
                        <label class="j-label"> {{trans('dataTable.check_date')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="check_date">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('check_date', null, [ 'id' => 'check_date'  ,'placeholder'=>trans("dataTable.check_date")]) !!}

                        </div>
                    </div>

                    <div class="j-span6 j-unit">
                        <label
                            class="j-label"> {{trans('dataTable.start_date_symptoms')}}</label>
                        <div class="j-input">
                            <label class="j-icon-right" for="start_date_symptoms">
                                <i class="icofont icofont-phone"></i>
                            </label>
                            {!! Form::text('start_date_symptoms', null, [ 'id' => 'start_date_symptoms'  ,'placeholder'=>trans("dataTable.start_date_symptoms")]) !!}

                        </div>
                    </div>


                </div>
                <div class="j-unit">
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="fever_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->fever_symptoms==true) checked @endif>
                            {{trans('dataTable.fever_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="sore_throat_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->sore_throat_symptoms==true) checked @endif>
                            {{trans('dataTable.sore_throat_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="cough_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->cough_symptoms==true) checked @endif>
                            {{trans('dataTable.cough_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="descent_from_the_nose_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->descent_from_the_nose_symptoms==true) checked @endif>
                            {{trans('dataTable.descent_from_the_nose_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="breathing_difficulty_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->breathing_difficulty_symptoms==true) checked @endif>
                            {{trans('dataTable.breathing_difficulty_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="headache_symptoms" value="true"
                                   @if(isset($blockPerson) and $blockPerson->headache_symptoms==true) checked @endif>
                            {{trans('dataTable.headache_symptoms')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="pain_in_chest" value="true"
                                   @if(isset($blockPerson) and $blockPerson->pain_in_chest==true) checked @endif>
                            {{trans('dataTable.pain_in_chest')}}</label>
                    </div>

                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="pain_in_the_joints" value="true"
                                   @if(isset($blockPerson) and $blockPerson->pain_in_the_joints==true) checked @endif>
                            {{trans('dataTable.pain_in_the_joints')}}</label>
                    </div>

                </div>
                <div class="j-unit">
                    <label
                        class="j-label">{{trans("dataTable.others_symptoms")}} </label>
                    <div class="j-input">
                        <label class="j-icon-right" for="others_symptoms">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        {!! Form::text('others_symptoms', null, [ 'id' => 'others_symptoms'  ,'placeholder'=>trans("dataTable.others_symptoms")]) !!}

                    </div>
                </div>
                <!-- end message -->

                <div class="j-unit">
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="heart_disease" value="true"
                                   @if(isset($blockPerson) and $blockPerson->heart_disease==true) checked @endif>
                            {{trans('dataTable.heart_disease')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="blood_pressure_disease" value="true"
                                   @if(isset($blockPerson) and $blockPerson->blood_pressure_disease==true) checked @endif>
                            {{trans('dataTable.blood_pressure_disease')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="diabetes_disease" value="true"
                                   @if(isset($blockPerson) and $blockPerson->diabetes_disease==true) checked @endif>
                            {{trans('dataTable.diabetes_disease')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="immunodeficiency_diseases" value="true"
                                   @if(isset($blockPerson) and $blockPerson->immunodeficiency_diseases==true) checked @endif>
                            {{trans('dataTable.immunodeficiency_diseases')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="liver_diseases" value="true"
                                   @if(isset($blockPerson) and $blockPerson->liver_diseases==true) checked @endif>
                            {{trans('dataTable.liver_diseases')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="chronic_respiratory_disease" value="true"
                                   @if(isset($blockPerson) and $blockPerson->chronic_respiratory_disease==true) checked @endif>
                            {{trans('dataTable.chronic_respiratory_disease')}}</label>
                    </div>
                    <div class="checkbox j-label">
                        <label class="j-label">
                            <input type="checkbox" name="kidney_disease" value="true"
                                   @if(isset($blockPerson) and $blockPerson->kidney_disease==true) checked @endif>
                            {{trans('dataTable.kidney_disease')}}</label>
                    </div>
                </div>


                <div class="j-unit">
                    <label
                        class="j-label">{{trans("dataTable.other_diseases")}} </label>
                    <div class="j-input">
                        <label class="j-icon-right" for="other_diseases">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        {!! Form::text('other_diseases', null, [ 'id' => 'other_diseases'  ,'placeholder'=>trans("dataTable.other_diseases")]) !!}

                    </div>
                </div>
                <!-- end message -->
            </fieldset>
            <!-- start response from server -->
            <div class="j-response"></div>
            <!-- end response from server -->
        </div>
        <!-- end /.content -->
        <div class="j-footer">
            <button type="submit" class="btn btn-primary j-multi-submit-btn">save</button>
            <button type="button" class="btn btn-primary j-multi-next-btn">Next</button>
            <button type="button" class="btn btn-default m-r-20 j-multi-prev-btn">Back</button>
        </div>
        </form>
    </div>


@endsection

@include('includes.changeZones')


@section('js')

    <!-- Custom js -->
    {{--    <script type="text/javascript"--}}
    {{--            src="{{ HostUrl('design\assets\pages\j-pro\js\custom\booking.js')}}"></script>--}}

    {{--    <script type="text/javascript" src="..\files\assets\pages\j-pro\js\jquery.maskedinput.min.js"></script>--}}
    {{--    <script type="text/javascript" src="..\files\assets\pages\j-pro\js\jquery.j-pro.js"></script>--}}
    <!-- Select2 -->
    <script src="{{HostUrl('design\assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
    <script src="{{HostUrl('design\assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>

    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>
    <script src="{{HostUrl('design\assets\pages\j-pro\js\custom\booking-multistep.js')}}"></script>

    <script type="text/javascript" src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('design\assets\pages\advance-elements\swithces.js') }}"></script>
    {{--    <script type="text/javascript" src="{{ asset('design\assets\js\pcoded.min.js') }}"></script>--}}
    {{--    <script src="..\files\assets\js\pcoded.min.js"></script>--}}

    {{--    <script type="text/javascript" src="..\files\assets\pages\advance-elements\swithces.js"></script>--}}


    <script type="text/javascript">
        getZones('governorate_id', 'zone_id');
        getZones('last_governorate_visit_id', 'last_zone_visit_id');
        getZones('dest_governorate_id', 'dest_zone_id');
        getZones('dest_zone_id', 'dest_sub_zone', 'sub_dis');
        getZones('dest_sub_zone', 'dest_hara', 'hara_vil');
        getZones('dest_hara', 'dest_sub_hara', 'sub_hara_vil');


    </script>

    <script>
        $('.dropify').dropify();

        $(".dropper-border").dateDropper({
            dropWidth: 200,
            dropPrimaryColor: "#1abc9c",
            dropBorder: "2px solid #1abc9c"
        });

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
