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
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <div class="j-wrapper j-wrapper-640">
                            @if(isset($blockPerson))
                                {!! Form::model($blockPerson, ['route' => ['block_persons.update', $blockPerson->id], 'method' => 'put','class'=>'j-pro j-multistep','id' => 'j-pro', 'files' => true]) !!}
                            @else
                                {!! Form::open(['role' => 'form', 'route' => 'block_persons.store', 'class'=>'j-pro j-multistep','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
                            @endif
                            @csrf
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
                                            <label class="j-label">{{trans("dataTable.bp_from")}} </label>
                                            <div class=" radio-inline">
                                                <label>
                                                    <input type="radio" name="bp_from" value="yemeni" class="bp_from"
                                                           @if(isset($blockPerson)and $blockPerson->bp_from=='yemeni')  checked="checked"
                                                           @endif checked="checked">
                                                    <i class="helper"></i> {{trans("dataTable.yemeni")}}
                                                </label>
                                            </div>
                                            <div class=" radio-inline">
                                                <label>
                                                    <input type="radio" name="bp_from" value="align" class="bp_from"
                                                           @if(isset($blockPerson)and $blockPerson->bp_from=='align') checked="checked" @endif>
                                                    <i class="helper"></i> {{trans("dataTable.align")}}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans('dataTable.country')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="country">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!! Form::text('country', 'اليمن', [ 'id' => 'country','disabled'=>true ,'placeholder'=>trans("dataTable.country")]) !!}

                                            </div>
                                        </div>

                                    </div>
                                    <div class="j-row" id="if_yemeni">

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
                                                {!!Form ::select('district_code',(isset($blockPerson))?getZones($blockPerson->zone->zone->id):getZones(),(isset($blockPerson))?$blockPerson->zone->id:null,['class' => 'select2 form-control', 'id' => 'zone_id'])!!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans("dataTable.gender")}} </label>
                                            <div class=" radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="male" class="gender"
                                                           @if(isset($blockPerson)and $blockPerson->gender=='male')  checked="checked"
                                                           @endif checked="checked">
                                                    <i class="helper"></i> {{trans("form.male")}}
                                                </label>
                                            </div>
                                            <div class=" radio-inline">
                                                <label>
                                                    <input type="radio" name="gender" value="female" class="gender"
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
                                                <input type="date" id="birth_date" name="birth_date">

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

                                    </div>

                                    <div class="j-row">

                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.martial_state')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="martial_state">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('martial_state', ['married'=>trans('dataTable.married'),'single'=>trans('dataTable.single'),
                                                'divorced'=>trans('dataTable.divorced'),'indecisive'=>trans('dataTable.indecisive'),'widowed'=>trans('dataTable.widowed')],null,['class' => 'select2 form-control', 'id' => 'martial_state'])!!}

                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit" id="div_kids_number">
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

                                        <div class="j-span6 j-unit" id="div_truck_number" style="display: none">
                                            <label class="j-label">{{trans('dataTable.truck_number')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="truck_number">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!! Form::text('truck_number', null, [ 'id' => 'truck_number' ,'placeholder'=>trans("dataTable.truck_number")]) !!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-title"> {{trans('menu.id_info')}} </div>

                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans("dataTable.id_type")}} </label>
                                            {!!Form ::select('id_type', [
                                            'personal'=>trans('dataTable.personal'),'passport'=>trans('dataTable.passport'),
                                            'temporary'=>trans('dataTable.temporary'),'family'=>trans('dataTable.card_family'),'military'=>trans('dataTable.military')
                                            ],null,['class' => 'select2 form-control', 'id' => 'bp_type'])!!}
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
                                                {{--                                                {!! Form::text('id_issue_date', null, [ 'id' => 'id_issue_date'  ,'placeholder'=>trans("dataTable.id_issue_date")]) !!}--}}
                                                <input type="date" name="id_issue_date" id="id_issue_date"
                                                       placeholder="{{trans("dataTable.id_issue_date")}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="j-row">
                                        <label class="j-label"> {{trans("dataTable.id_front_photo")}}</label>
                                        <div class="form-group col-xs-12 mb-2">
                                            <input type="file" accept="image/*" name="front_photo"
                                                   class="dropify form-control"
                                                   id="id_front_photo"
                                                   aria-describedby="fileHelp">

                                            @error('avatar') <span
                                                class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                        </div>

                                    </div>
                                    <div class="j-row">
                                        <label class="j-label"> {{trans("dataTable.id_back_photo")}}</label>
                                        <div class="form-group col-xs-12 mb-2">
                                            <input type="file" accept="image/*" name="back_photo"
                                                   class="dropify form-control"
                                                   id="id_back_photo"
                                                   aria-describedby="fileHelp">

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

                                    <div class="j-unit">
                                        <label
                                            class="j-label"> {{trans('dataTable.is_comming_from_other_country')}}</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="is_comming_from_other_country">
                                                <i class="icofont icofont-phone"></i>
                                            </label>
                                            {!!Form ::select('is_comming_from_other_country', [0=>trans('dataTable.no'),1=>trans('dataTable.yes')],null,['class' => 'select2 form-control', 'id' => 'is_comming_from_other_country'])!!}

                                        </div>
                                    </div>


                                    <div class="j-row" id="dev_is_come_from_country_true" style="display: none">


                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.come_from_country')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="come_from_country">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!! Form::text('come_from_country', null, [ 'id' => 'come_from_country'  ,'placeholder'=>trans("dataTable.come_from_country")]) !!}

                                            </div>
                                        </div>


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

                                    </div>

                                    <div class="j-row" id="dev_is_come_from_country_false">

                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.last_governorate_visit')}}</label>
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


                                    <div class="sub-title"> {{trans('menu.sourse_reside_info')}} </div>
                                    <div class="j-unit">
                                        <label class="j-label">{{trans("dataTable.source_stay_reason")}} </label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="source_stay_reason">
                                                <i class="icofont icofont-ui-user"></i>
                                            </label>
                                            {!! Form::text('source_stay_reason', null, [ 'id' => 'source_stay_reason'  ,'placeholder'=>trans("dataTable.source_stay_reason")]) !!}

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
                                        <label
                                            class="j-label"> {{trans('dataTable.source_how_check_info')}}</label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="source_how_check_info">
                                                <i class="icofont icofont-phone"></i>
                                            </label>
                                            {!! Form::text('source_how_check_info', null, [ 'id' => 'source_how_check_info'  ,'placeholder'=>trans("dataTable.source_how_check_info")]) !!}

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
                                            <label
                                                class="j-label">{{trans('dataTable.dest_isolation_neighborhood')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="dest_hara">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!!Form ::select('dest_isolation_neighborhood',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_hara'])!!}

                                            </div>
                                        </div>


                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans('dataTable.dest_lane_village')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="dest_sub_hara">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!!Form ::select('dest_lane_village',(isset($blockPerson))?getZones($blockPerson->dest_zone->zone->code):getZones(),(isset($blockPerson))?$blockPerson->dest_zone->id:null,['class' => 'select2 form-control', 'id' => 'dest_sub_hara'])!!}

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
                                                {{--                                                {!! Form::text('dest_exit_date', null, [ 'id' => 'dest_exit_date'  ,'placeholder'=>trans("dataTable.dest_exit_date")]) !!}--}}
                                                <input type="date" name="dest_exit_date" id="dest_exit_date"
                                                       placeholder="{{trans("dataTable.dest_exit_date")}}">

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

                                        <div class="sub-title"> {{trans('menu.transpiration_info')}} </div>

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


                                </fieldset>
                                <fieldset>
                                    <div class="j-divider-text j-gap-top-20 j-gap-bottom-45">
                                        <span>{{trans('dataTable.step')}} 4/4 - {{trans("dataTable.health_info")}}</span>
                                    </div>

                                    <!-- start message -->
                                    <div class="sub-title"> {{trans('menu.form_info')}} </div>

                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.form_id')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="check_date">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!! Form::text('form_id', null, [ 'id' => 'form_id'  ,'placeholder'=>trans("dataTable.form_id")]) !!}

                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.check_date')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="check_date">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {{--                                                {!! Form::text('check_date', null, [ 'id' => 'check_date'  ,'placeholder'=>trans("dataTable.check_date")]) !!}--}}
                                                <input type="date" name="check_date" id="check_date"
                                                       placeholder="{{trans("dataTable.check_date")}}">

                                            </div>
                                        </div>


                                    </div>

                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans('dataTable.check_point_id')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="check_point_id">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!!Form ::select('check_point_id',[],null,['class' => 'select2 form-control', 'id' => 'check_point_id'])!!}

                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('form.government')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="governorate_id">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('port_governorate_id', getGovernorates(),null,['class' => 'select2 form-control', 'id' => 'port_governorate_id'])!!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="sub-title"> {{trans('menu.initialInfo')}} </div>


                                    <div class="j-row">


                                        <div class="j-span6 j-unit">
                                            <div class="checkbox j-label">
                                                <label class="j-label">
                                                    <input type="checkbox" id="is_visit_health_center"
                                                           name="is_visit_health_center" value=1
                                                           @if(isset($blockPerson) and $blockPerson->is_visit_health_center==true) checked @endif>
                                                    {{trans('dataTable.is_visit_health_center')}}</label>
                                            </div>
                                        </div>
                                        <div class="j-span6 j-unit" id="dev_health_center_name">
                                            <label class="j-label"> {{trans('dataTable.health_center_name')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="health_center_name">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!! Form::text('health_center_name', null, [ 'id' => 'health_center_name'  ,'placeholder'=>trans("dataTable.health_center_name")]) !!}

                                            </div>
                                        </div>


                                    </div>


                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans('dataTable.status_at_reporting')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="status_at_reporting">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!!Form ::select('status_at_reporting',
                                                ['stable'=>trans('dataTable.stable'),'critical'=>trans('dataTable.critical'),'healthy'=>trans('dataTable.healthy'),'healing'=>trans('dataTable.healing')],null,['class' => 'select2 form-control', 'id' => 'status_at_reporting'])!!}

                                            </div>
                                        </div>


                                    </div>

                                    <div class="j-row">


                                        <div class="j-span6 j-unit">
                                            <div class="checkbox j-label">
                                                <label class="j-label">
                                                    <input type="checkbox" name="is_mix_other_people" value=1
                                                           @if(isset($blockPerson) and $blockPerson->is_mix_other_people==true) checked @endif>
                                                    {{trans('dataTable.is_mix_other_people')}}</label>
                                            </div>
                                        </div>
                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.mix_people_type')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="mix_people_type">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('mix_people_type', [
                                                'none'=>trans('dataTable.none'),
                                                'family'=>trans('dataTable.family'),
                                                'healthWorker'=>trans('dataTable.healthWorker'),
                                                'both'=>trans('dataTable.both'),
                                                'private'=>trans('dataTable.private')]
                                                ,null,['class' => 'select2 form-control', 'id' => 'mix_people_type'])!!}


                                            </div>
                                        </div>


                                        <div class="j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.other_mix_people')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="other_mix_people">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!! Form::text('other_mix_people', null, [ 'id' => 'other_mix_people'  ,'placeholder'=>trans("dataTable.other_mix_people")]) !!}

                                            </div>
                                        </div>


                                    </div>

                                    <div class="j-row">


                                        <div class="j-span6 j-unit">
                                            <div class="checkbox j-label">
                                                <label class="j-label">
                                                    <input type="checkbox" name="sleeping" value=1 id="sleeping"
                                                           @if(isset($blockPerson) and $blockPerson->sleeping==true) checked @endif>
                                                    {{trans('dataTable.sleeping')}}</label>
                                            </div>
                                        </div>
                                        <div class="j-span6 j-unit" id="div_sleep_date" style="display: none"
                                             @if(isset($blockPerson) and $blockPerson->sleeping==1) style="display: inline-block" @endif>
                                            <label class="j-label"> {{trans('dataTable.sleep_date')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="sleep_date">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {{--                                                {!! Form::text('sleep_date', null, [ 'id' => 'sleep_date'  ,'placeholder'=>trans("dataTable.sleep_date")]) !!}--}}
                                                <input type="date" name="sleep_date" id="sleep_date"
                                                       placeholder="{{trans("dataTable.sleep_date")}}">

                                            </div>
                                        </div>

                                    </div>


                                    <div class="sub-title"> {{trans('menu.for_female')}} </div>

                                    <div class="j-unit" id="if_gender_femal">

                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="is_pregnant" value=1
                                                       @if(isset($blockPerson) and $blockPerson->is_pregnant==true) checked @endif>
                                                {{trans('dataTable.is_pregnant')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="is_pregnant_in_first_3Month" value=1
                                                       @if(isset($blockPerson) and $blockPerson->is_pregnant_in_first_3Month==true) checked @endif>
                                                {{trans('dataTable.is_pregnant_in_first_3Month')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="after_childbirth" value=1
                                                       @if(isset($blockPerson) and $blockPerson->after_childbirth==true) checked @endif>
                                                {{trans('dataTable.after_childbirth')}}</label>
                                        </div>

                                    </div>

                                    <div class="sub-title"> {{trans('menu.symptoms')}} </div>

                                    <div class="j-row">

                                        <div class=" j-unit">
                                            <label class="j-label"> {{trans('dataTable.start_date_symptoms')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="start_date_symptoms">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {{--                                                {!! Form::text('start_date_symptoms', null, [ 'id' => 'start_date_symptoms'  ,'placeholder'=>trans("dataTable.start_date_symptoms")]) !!}--}}
                                                <input type="date" name="start_date_symptoms" id="start_date_symptoms"
                                                       placeholder="{{trans("dataTable.start_date_symptoms")}}">

                                            </div>
                                        </div>

                                    </div>


                                    <div class="j-unit">
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="fever_symptoms" value=1
                                                       @if(isset($blockPerson) and $blockPerson->fever_symptoms==true) checked @endif>
                                                {{trans('dataTable.fever_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="sore_throat_symptoms" value=1
                                                       @if(isset($blockPerson) and $blockPerson->sore_throat_symptoms==true) checked @endif>
                                                {{trans('dataTable.sore_throat_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="cough_symptoms" value=1
                                                       @if(isset($blockPerson) and $blockPerson->cough_symptoms==true) checked @endif>
                                                {{trans('dataTable.cough_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="descent_from_the_nose_symptoms"
                                                       value=1
                                                       @if(isset($blockPerson) and $blockPerson->descent_from_the_nose_symptoms==true) checked @endif>
                                                {{trans('dataTable.descent_from_the_nose_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="breathing_difficulty_symptoms"
                                                       value=1
                                                       @if(isset($blockPerson) and $blockPerson->breathing_difficulty_symptoms==true) checked @endif>
                                                {{trans('dataTable.breathing_difficulty_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="headache_symptoms" value=1
                                                       @if(isset($blockPerson) and $blockPerson->headache_symptoms==true) checked @endif>
                                                {{trans('dataTable.headache_symptoms')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="pain_in_chest" value=1
                                                       @if(isset($blockPerson) and $blockPerson->pain_in_chest==true) checked @endif>
                                                {{trans('dataTable.pain_in_chest')}}</label>
                                        </div>

                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="pain_in_the_joints" value=1
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
                                    <div class="sub-title"> {{trans('menu.diseases')}} </div>


                                    <div class="j-unit">
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="heart_disease" value=1
                                                       @if(isset($blockPerson) and $blockPerson->heart_disease==true) checked @endif>
                                                {{trans('dataTable.heart_disease')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="blood_pressure_disease" value=1
                                                       @if(isset($blockPerson) and $blockPerson->blood_pressure_disease==true) checked @endif>
                                                {{trans('dataTable.blood_pressure_disease')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="diabetes_disease" value=1
                                                       @if(isset($blockPerson) and $blockPerson->diabetes_disease==true) checked @endif>
                                                {{trans('dataTable.diabetes_disease')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="immunodeficiency_diseases" value=1
                                                       @if(isset($blockPerson) and $blockPerson->immunodeficiency_diseases==true) checked @endif>
                                                {{trans('dataTable.immunodeficiency_diseases')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="liver_diseases" value=1
                                                       @if(isset($blockPerson) and $blockPerson->liver_diseases==true) checked @endif>
                                                {{trans('dataTable.liver_diseases')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="chronic_respiratory_disease"
                                                       value=1
                                                       @if(isset($blockPerson) and $blockPerson->chronic_respiratory_disease==true) checked @endif>
                                                {{trans('dataTable.chronic_respiratory_disease')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="kidney_disease" value=1
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
                                    <div class="sub-title"> {{trans('menu.procedures')}} </div>


                                    <div class="j-row">


                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.typeStatus')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="typeStatus">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('typeStatus',[
                                                'examinedAndQuarantined'=>trans('dataTable.examinedAndQuarantined'),
                                                'checkedAndCrossedFromPort'=>trans('dataTable.checkedAndCrossedFromPort'),
                                                'checkAndTruckInPort'=>trans('dataTable.checkAndTruckInPort'),
                                                'runAway'=>trans('dataTable.runAway'),
                                                'JustChecked'=>trans('dataTable.JustChecked'),
                                                'noActionTaken'=>trans('dataTable.noActionTaken')
                                                ]
                                                ,null,['class' => 'select2 form-control', 'id' => 'typeStatus'])!!}

                                            </div>
                                        </div>


                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.quar_government')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="governorate_id">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('quar_governorate_id', getGovernorates(),(isset($blockPerson)) ?$blockPerson->governorate_id:null,['class' => 'select2 form-control', 'id' => 'quar_governorate_id'])!!}

                                            </div>
                                        </div>


                                    </div>

                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label class="j-label">{{trans('dataTable.quar_zone')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="quar_zone_id">
                                                    <i class="icofont icofont-envelope"></i>
                                                </label>
                                                {!!Form ::select('quar_zone_id',(isset($blockPerson))?getZones($blockPerson->zone->zone->id):getZones(),(isset($blockPerson))?$blockPerson->zone->id:null,['class' => 'select2 form-control', 'id' => 'quar_zone_id'])!!}

                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.quarantine_area_id')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="quarantine_area_id">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {!!Form ::select('quarantine_area_id', [],null,['class' => 'select2 form-control', 'id' => 'quarantine_area_id'])!!}

                                            </div>
                                        </div>

                                    </div>
                                    <div class="j-row">
                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.insulation_date')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="check_date">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>
                                                {{--                                                {!! Form::text('insulation_date', null, [ 'id' => 'insulation_date'  ,'placeholder'=>trans("dataTable.insulation_date")]) !!}--}}
                                                <input type="date" name="insulation_date" id="insulation_date"
                                                       placeholder="{{trans("dataTable.insulation_date")}}">

                                            </div>
                                        </div>

                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label">{{trans("dataTable.insulation_end_date")}} </label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="insulation_end_date">
                                                    <i class="icofont icofont-ui-user"></i>
                                                </label>
                                                {{--                                                {!! Form::text('insulation_end_date', null, [ 'id' => 'insulation_end_date'  ,'placeholder'=>trans("dataTable.insulation_end_date")]) !!}--}}
                                                <input type="date" name="insulation_end_date" id="insulation_end_date"
                                                       placeholder="{{trans("dataTable.insulation_end_date")}}">

                                            </div>

                                        </div>
                                    </div>

                                    <div class="j-row">
                                        {{--                                        $table->enum('result_of_examining', ['indicates', 'passive', 'hangs', 'indecisive', 'none'])->default('none');//--}}

                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.situation_result')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="situation_result">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {!!Form ::select('situation_result',['none'=>trans('dataTable.none'),
                                                                                    'dead'=>trans('dataTable.dead'),
                                                                                    'cured'=>trans('dataTable.cured'),
                                                                                    'referred'=>trans('dataTable.referred')
                                                                                    ] ,null,['class' => 'select2 form-control', 'id' => 'situation_result'])!!}

                                            </div>
                                        </div>


                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.response_team_interventions')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="response_team_interventions">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {!!Form ::select('response_team_interventions',['none'=>trans('dataTable.none'),
                                                                                    'investigation'=>trans('dataTable.investigation'),
                                                                                    'file_closed'=>trans('dataTable.file_closed'),
                                                                                    'case_was_lost'=>trans('dataTable.case_was_lost'),
                                                                                    'other'=>trans('dataTable.other')
                                                                                    ] ,null,['class' => 'select2 form-control', 'id' => 'response_team_interventions'])!!}

                                            </div>
                                        </div>

                                    </div>

                                    <div class="j-unit">
                                        <label
                                            class="j-label">{{trans("dataTable.other_response_team_interventions")}} </label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="other_response_team_interventions">
                                                <i class="icofont icofont-ui-user"></i>
                                            </label>
                                            {!! Form::text('other_response_team_interventions', null, [ 'id' => 'other_response_team_interventions'  ,'placeholder'=>trans("dataTable.other_response_team_interventions")]) !!}

                                        </div>
                                    </div>

                                    <div class="sub-title"> {{trans('menu.sampleInfo')}} </div>

                                    <div class="j-unit">


                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="is_patientIdentical_standard_definition"
                                                       value=1
                                                       @if(isset($blockPerson) and $blockPerson->is_patientIdentical_standard_definition==true) checked @endif>
                                                {{trans('dataTable.is_patientIdentical_standard_definition')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="is_sample_collected" value=1
                                                       @if(isset($blockPerson) and $blockPerson->is_sample_collected==true) checked @endif>
                                                {{trans('dataTable.is_sample_collected')}}</label>
                                        </div>
                                        <div class="checkbox j-label">
                                            <label class="j-label">
                                                <input type="checkbox" name="is_sample_sent" value=1
                                                       @if(isset($blockPerson) and $blockPerson->is_sample_sent==true) checked @endif>
                                                {{trans('dataTable.is_sample_sent')}}</label>
                                        </div>

                                    </div>

                                    <div class="j-row">
                                        {{--                                        $table->enum('result_of_examining', ['indicates', 'passive', 'hangs', 'indecisive', 'none'])->default('none');//--}}

                                        <div class="j-span6 j-unit">
                                            <label class="j-label"> {{trans('dataTable.result_of_examining')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="result_of_examining">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {!!Form ::select('result_of_examining',[
                                                'none'=>trans('dataTable.none'),
                                                'indicates'=>trans('dataTable.indicates'),
                                                                                    'passive'=>trans('dataTable.passive'),
                                                                                    'hangs'=>trans('dataTable.hangs'),
                                                                                    'indecisive'=>trans('dataTable.indecisive')
                                                                                    ] ,null,['class' => 'select2 form-control', 'id' => 'result_of_examining'])!!}

                                            </div>
                                        </div>


                                        <div class="j-span6 j-unit">
                                            <label
                                                class="j-label"> {{trans('dataTable.sample_sent_date')}}</label>
                                            <div class="j-input">
                                                <label class="j-icon-right" for="sample_sent_date">
                                                    <i class="icofont icofont-phone"></i>
                                                </label>

                                                {{--                                                {!! Form::text('sample_sent_date', null, [ 'id' => 'sample_sent_date'  ,'placeholder'=>trans("dataTable.sample_sent_date")]) !!}--}}
                                                <input type="date" name="sample_sent_date" id="sample_sent_date"
                                                       placeholder="{{trans("dataTable.sample_sent_date")}}">

                                            </div>
                                        </div>

                                    </div>

                                    <div class="j-unit">
                                        <label
                                            class="j-label">{{trans("dataTable.note")}} </label>
                                        <div class="j-input">
                                            <label class="j-icon-right" for="note">
                                                <i class="icofont icofont-ui-user"></i>
                                            </label>
                                            {!! Form::text('note', null, [ 'id' => 'note'  ,'placeholder'=>trans("dataTable.note")]) !!}

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
                                <button type="submit"
                                        class="btn btn-primary  j-multi-submit-btn"> {{trans("form.save")}} </button>
                                <button type="button"
                                        class="btn btn-primary j-multi-next-btn">{{trans("form.next")}}</button>
                                <button type="button"
                                        class="btn btn-default m-r-20 j-multi-prev-btn">{{trans("form.back")}}</button>
                            </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
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
    <script
        src="{{HostUrl('design\assets\pages\j-pro\js\jquery.maskedinput.min.js')}}"></script>
    <script src="{{HostUrl('design\assets\pages\j-pro\js\jquery.j-pro.js')}}"></script>

    <script
        src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>
    {{--    <script src="{{HostUrl('design\assets\pages\j-pro\js\custom\booking-multistep.js')}}"></script>--}}

    <script type="text/javascript"
            src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('design\assets\pages\advance-elements\swithces.js') }}"></script>
    {{--    <script type="text/javascript" src="{{ asset('design\assets\js\pcoded.min.js') }}"></script>--}}
    {{--    <script src="..\files\assets\js\pcoded.min.js"></script>--}}

    {{--    <script type="text/javascript" src="..\files\assets\pages\advance-elements\swithces.js"></script>--}}


    <script type="text/javascript">


        $(document).ready(function () {
            // Phone masking
            $('#phone').mask('999-999-999', {placeholder: 'x'});
            $('#dest_aqel_phone').mask('999-999-999', {placeholder: 'x'});
            $('#relative_phone').mask('999-999-999', {placeholder: 'x'});

            /***************************************/
            /* Datepicker */
            /***************************************/

            // Start date
            function dateFrom(date_from, date_to) {
                $(date_from).datepicker({
                    dateFormat: 'mm/dd/yy',
                    prevText: '<i class="fa fa-caret-left"></i>',
                    nextText: '<i class="fa fa-caret-right"></i>',
                    onClose: function (selectedDate) {
                        $(date_to).datepicker('option', 'minDate', selectedDate);
                    }
                });
            }

            // Start date
            function afterSubmit() {
                console.log('ssssssss');
                alert('dsd');
            }

            // Finish date
            function dateTo(date_from, date_to) {
                $(date_to).datepicker({
                    dateFormat: 'mm/dd/yy',
                    prevText: '<i class="fa fa-caret-left"></i>',
                    nextText: '<i class="fa fa-caret-right"></i>',
                    onClose: function (selectedDate) {
                        $(date_from).datepicker('option', 'maxDate', selectedDate);
                    }
                });
            }// Finish date
            function dateInit(date) {
                $(date).datepicker({
                    dateFormat: 'mm-dd-yy',


                });
            }

            // Destroy date
            function destroyDate(date) {
                $(date).datepicker('destroy');
            }

            // dateInit('#birth_date');
            // dateInit('#id_issue_date');
            // dateInit('#out_from_country_date');
            // dateInit('#comming_to_yemen_date');
            // dateInit('#dest_exit_date');
            // dateInit('#check_date');
            // dateInit('#start_date_symptoms');
            // dateInit('#insulation_date');
            // dateInit('#sleep_date');
            // dateInit('#insulation_end_date');
            // dateInit('#sample_sent_date');

            // Initialize date range
            dateFrom('#date_from', '#date_to');
            dateTo('#date_from', '#date_to');
            /***************************************/
            /* end datepicker */
            /***************************************/

            // Validation
            $("#j-pro").justFormsPro({
                rules: {
                    bp_name: {
                        required: true
                    },
                    check_date: {
                        required: true
                    },
                    // id_number: {
                    //     required: true
                    // },
                    job: {
                        required: true
                    },

                    // phone: {
                    //     required: true
                    // },
                    country: {
                        required: true
                    },
                    // quarantine_area_id: {
                    //     required: true
                    // },
                    check_point_id: {
                        required: true
                    },

                    // children: {
                    //     required: true,
                    //     integer: true,
                    //     minvalue: 0
                    // },
                    // birth_date: {
                    //     required: true
                    // },

                },
                messages: {
                    bp_name: {
                        required: "الاسم مطلوب"
                    },
                    // birth_date: {
                    //     required: "تاريخ الميلاد مطلوب"
                    // },
                    check_date: {
                        required: "تاريخ الفحص مطلوب"
                    },
                    // id_number: {
                    //     required: "رقم المعرف  مطلوب"
                    // },
                    job: {
                        required: "نوع الوظيفة  مطلوب"
                    },
                    country: {
                        required: "الدولة    مطلوبة"
                    },

                    // phone: {
                    //     required: "رقم التلفون مطلوب"
                    // },
                    // quarantine_area_id: {
                    //     required: "يجب تحديد مركز  "
                    // },
                    check_point_id: {
                        required: "يجب تحديد نقطة الفحص او التفتيش  "
                    },

                    // children: {
                    //     required: "Field is required",
                    //     integer: "Only integer allowed",
                    //     minvalue: "Value not less than 0"
                    // },

                },
                formType: {
                    multistep: true
                },
                afterSuccessSubmit: function (data) {
                    // alert('sss');
                    toastr.success(' تم الاضافة بنجاح');
                    location.reload();
                    return true;
                },
                afterSubmitHandler: function () {
                    afterSubmit();
                    return true;
                }
            });
        });


        getZones('governorate_id', 'zone_id');
        getZones('quar_governorate_id', 'quar_zone_id');
        getZones('last_governorate_visit_id', 'last_zone_visit_id');
        // getZones('dest_governorate_id', 'dest_zone_id');
        // getZones('dest_zone_id', 'dest_sub_zone', 'sub_dis');
        // getZones('dest_sub_zone', 'dest_hara', 'hara_vil');
        getZones('dest_hara', 'dest_sub_hara', 'sub_hara_vil');

        function dest_governorate_id(zone_code) {
            $.when(get_dest_zone(zone_code, 'dest_zone_id')).then(function (district) {
                var dis_code = district.first;
                return get_dest_zone(dis_code, 'dest_sub_zone', 'sub_dis')
            }).then(function (sub_dis) {
                var sub_dis_code = sub_dis.first;
                return get_dest_zone(sub_dis_code, 'dest_hara', 'hara_vil');
            }).then(function (hara_vil) {
                var dis_code = hara_vil.first;
                return get_dest_zone(dis_code, 'dest_sub_hara', 'sub_hara_vil')
            });
        }

        $(document).on('change', '#dest_governorate_id', function () {
            var zone_code = $(this).val();
            dest_governorate_id(zone_code);
        });
        $(document).ready(function () {
            var zone_code = $('#dest_governorate_id').val();
            dest_governorate_id(zone_code);
        });

        $(document).on('change', '#dest_zone_id', function () {
            var zone_code = $(this).val();
            $.when(get_dest_zone(zone_code, 'dest_sub_zone', 'sub_dis')).then(function (sub_dis) {
                var sub_dis_code = sub_dis.first;
                console.log(sub_dis);
                return get_dest_zone(sub_dis_code, 'dest_hara', 'hara_vil')
            }).then(function (hara_vil) {
                console.log(hara_vil);
                var dis_code = hara_vil.first;
                return get_dest_zone(dis_code, 'dest_sub_hara', 'sub_hara_vil')
            });
        });
        $(document).on('change', '#dest_sub_zone', function () {
            var zone_code = $(this).val();
            $.when(get_dest_zone(zone_code, 'dest_hara', 'hara_vil')).then(function (hara_vil) {
                console.log(hara_vil);
                var dis_code = hara_vil.first;
                return get_dest_zone(dis_code, 'dest_sub_hara', 'sub_hara_vil')
            });
        });

        function get_dest_zone(zone_code, zone_list, zone_type = 'district', type = 'noAll') {
            var zone = $('#' + zone_list);
            var _this = $(this);
            return $.ajax({
                url: '<?php echo e(route('zones.getZones')); ?>',
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("<?php echo e(csrf_token()); ?>") +
                    '&id=' + zone_code + '&zone_type=' + zone_type + '&type=' + type,
                success: function (data) {
                    zone.html(data.data);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });

        }


        $(document).on('click', '#sleeping', function () {

            if ($(this).prop("checked") == true) {
                $("#div_sleep_date").show();
            } else {
                $("#div_sleep_date").hide();
            }
        });


        $(document).on('click', '#is_visit_health_center', function () {

            if ($(this).prop("checked") == true) {
                $("#dev_health_center_name").show();
            } else {
                $("#dev_health_center_name").hide();
            }
        });

        $(document).on('change', '#is_comming_from_other_country', function () {

            if ($(this).val() == 1) {
                $("#dev_is_come_from_country_false").hide();
                $("#dev_is_come_from_country_true").show();
            } else {
                $("#dev_is_come_from_country_false").show();
                $("#dev_is_come_from_country_true").hide();
            }


        });


        $(document).on('click', '.bp_from', function () {
            if ($(this).val() == 'yemeni') {
                $("#country").attr('disabled', true);
                $("#country").val('اليمن');
                $("#if_yemeni").show();

            } else {
                $("#country").attr('disabled', false);
                $("#country").val('الصومال');
                $("#if_yemeni").hide();
            }
        });

        $(document).on('click', '.gender', function () {
            if ($(this).val() == 'female') {

                $("#if_gender_femal").show();

            } else {

                $("#if_gender_femal").hide();
            }
        });

        $(document).on('change', '#martial_state', function () {
            if ($(this).val() != 'single') {

                $("#div_kids_number").show();

            } else {
                $("#div_kids_number").hide();
            }
        });
        $(document).on('change', '#bp_type', function () {
            if ($(this).val() == 'truck_owner') {

                $("#div_truck_number").show();

            } else {
                $("#div_truck_number").hide();
            }
        });


        $(document).on('change', '#port_governorate_id', function () {
            get_check_point();
        });
        $(document).on('change', '#quar_zone_id', function () {
            get_quarantine();
        });
        $(document).on('change', '#quar_governorate_id', function () {
            get_quarantine();
        });
        get_check_point();
        get_quarantine();

        function get_check_point() {
            var government_id = $('#port_governorate_id').val();
            var type = 'point';
            var selectList = $('#check_point_id');
            $.ajax({
                url: '{{route('check_points.filterCheckPoint')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                    '&government_id=' + government_id,
                success: function (data) {
                    // console.log(data.firstData);
                    selectList.html(data.select);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function get_quarantine() {
            var zone_id = $('#quar_zone_id').val();
            var type = 'point';
            var selectList = $('#quarantine_area_id');
            $.ajax({
                url: '{{route('check_points.get_quarantine')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                    '&zone_id=' + zone_id,
                success: function (data) {
                    // console.log(data.firstData);
                    selectList.html(data.select);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }


    </script>

    <script>
        $('.dropify').dropify();


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
