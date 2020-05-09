@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.teamWorkers')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        @if($center!=null)
                            <li class="breadcrumb-item"><a
                                    href="{{route('check_points.team',['id'=>$center->id,'type'=>$workers_type.'_teams'])}}">
                                    فريق {{$center->name}}
                                </a>
                            </li>
                        @else
                            <li class="breadcrumb-item"><a
                                    href="#">{{trans('menu.'.$workers_type)}}
                                </a>
                            </li>

                            @endif


                            </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
    {{--    <div class="row input-daterange">--}}
    {{--        <div class="col-md-4">--}}
    {{--            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly/>--}}
    {{--        </div>--}}
    {{--        <div class="col-md-4">--}}
    {{--            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly/>--}}
    {{--        </div>--}}
    {{--        <div class="col-md-4">--}}
    {{--            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>--}}
    {{--            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="card">
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="feather icon-maximize full-card"></i></li>
                    <li><i class="feather icon-minus minimize-card"></i></li>
                    <li><i class="feather icon-trash-2 close-card"></i></li>
                </ul>
            </div>
        </div>


        <div class="card-body">
            <div class="card-body">
                @if(isset($workers_type))
                    <input type="hidden" name="workTeamType" id="center_workTeamType" value="{{$workers_type}}">
                @endif

                @if($center!=null)
                    <input type="hidden" name="center_governorate_id" id="center_governorate_id"
                           value="{{$center->zone->zone_id}}">
                    <input type="hidden" name="center_zone_id" id="center_zone_id" value="{{$center->zone_id}}">
                    <input type="hidden" name="pointOrCenter_id" id="pointOrCenter_id" value="{{$center->id}}">

                @else

                    <div class="sub-title"> {{trans('menu.btn_filterCenter')}}</div>
                    <div class="row">
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">{{trans('menu.government')}}</span>
                            <?php $getGovernorate = getGovernorates(); $getGovernorate['all'] = 'all'; ?>
                            {!!Form ::select('governorate_id',  getGovernorates(),(isset($workTeam)) ?$workTeam->zone->zone->code:null,['class' => 'select2 form-control', 'id' => 'center_governorate_id'])!!}

                        </div>
                        <div class="input-group col-md-3">
                            <span class="input-group-addon">{{trans('menu.zone')}}</span>
                            {!!Form ::select('zone_id',(isset($workTeam))?getZones($workTeam->zone->zone->code):getZones(),(isset($workTeam))?$workTeam->zone->id:null,['class' => 'select2 form-control', 'id' => 'center_zone_id'])!!}

                        </div>

                        @if(!isset($workers_type))
                            <div class="input-group col-md-3">
                                <span class="input-group-addon">{{trans('menu.workTeamType')}}</span>
                                {!!Form ::select('workTeamType', workTeamTypes(),'',['class' => 'select2 form-control', 'id' => 'center_workTeamType'])!!}
                            </div>
                        @endif


                        <div class="input-group col-md-3" id="pointOrCenter_idDiv">
                            <span class="input-group-addon">{{trans('menu.center')}}</span>
                            {!!Form ::select('pointOrCenter_id', ['no'=>'ليس هناك مراكز حاليا'],'',['class' => 'select2 form-control', 'id' => 'pointOrCenter_id'])!!}
                        </div>
                    </div>
                @endif
                <div class="sub-title"> {{trans('menu.btn_filterTeam')}}</div>
                <div class="row">
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.government')}}</span>
                        <?php $getGovernorate = getGovernorates(); $getGovernorate['all'] = trans('menu.all'); ?>
                        {!!Form ::select('governorate_id', array_reverse($getGovernorate,true),(isset($workTeam)) ?$workTeam->zone->zone->id:null,['class' => 'select2 form-control', 'id' => 'search_government_id'])!!}

                    </div>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.zone')}}</span>
                        {{--                        {!!Form ::select('to_zone',  array_reverse($getGovernorate,true),'',['class' => 'select2 form-control', 'id' => 'to_zone'])!!}--}}
                        {!!Form ::select('zone_id',getZones('all'),null,['class' => 'select2 form-control', 'id' => 'search_zone_id'])!!}

                    </div>


                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.workType')}}</span>
                        {!!Form ::select('workTeamType', workTeamTypes(),'',['class' => 'select2 form-control', 'id' => 'workTeamType'])!!}

                    </div>
                    <div class="input-group col-md-3" id="pointOrCenter_idDiv">
                        <span class="input-group-addon">{{trans('menu.gender')}}</span>
                        {!!Form ::select('gender', ['all'=>trans('menu.all'),'male'=>trans('menu.male'),'female'=>trans('menu.female')],null,['class' => 'select2 form-control', 'id' => 'gender'])!!}

                    </div>

                </div>
                <div class="row">
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.from_date')}}</span>
                        <input type="date" class="form-control" name="start" value="{{isset($start)?$start:''}}"
                               id="from_date">
                    </div>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.to_date')}}</span>
                        <input type="date" class="form-control" name="end" value="{{isset($end)?$end:''}}" required
                               id="to_date">
                    </div>
                    {{--                    <div class="input-group col-md-3">--}}
                    {{--                        <span class="input-group-addon">{{trans('menu.orderStatus')}}</span>--}}
                    {{--                        {!!Form ::select('status', orderDisputesStatus(),'',['class' => 'select2 form-control', 'id' => 'filter_status'])!!}--}}
                    {{--                    </div>--}}

                    <div class="input-group col-md-3">

                        <button type="button" name="filter" id="filter"
                                class="btn btn-primary btn-ms waves-effect waves-light">{{trans('menu.filter')}} <i
                                class="fa fa-filter"></i></button>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="feather icon-maximize full-card"></i></li>
                    <li><i class="feather icon-minus minimize-card"></i></li>
                    <li><i class="feather icon-trash-2 close-card"></i></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <table id="orderdata" class="dataTable table table-striped table-hover table table-bordered">
                </table>

            </div>
            <div class="col-md-3">

                <div class="card job-right-header">
                    <div class="card-header">
                        <div class="card-header-right">
                            <label class="label label-danger">{{trans('menu.team')}}</label>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="#" id="memberList">


                        </form>
                        <br>
                        <hr>
                        <br>
                        <button type="button" id="saveListTeam"> {{trans('form.save')}}</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change_center_of_work" tabindex="-1">
        <style>
            .form-group {
                position: initial;
            }
        </style>
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="additional_form_data"></div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="ion-close-round">X</span>
                    </button>
                    <div>
                        <div class="row m-0">

                            <div class="food-menu-details custom-head-details">
                                <h4 class="p_name" style="text-align: center;"> نقل <span id="person_name"> </span></h4>
                                <!--<p class="p_price"></p>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="custom-content">

                        <div class="custom-section" id="custom-text-field">
                            <input type="hidden" id="person_id" value="0">
                            <div class="row">
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">{{trans('menu.government')}}</span>
                                    <?php $getGovernorate = getGovernorates(); $getGovernorate['all'] = 'all'; ?>
                                    {!!Form ::select('modal_governorate_id',  getGovernorates(),(isset($workTeam)) ?$workTeam->zone->zone->id:null,['class' => 'select2 form-control', 'id' => 'modal_governorate_id'])!!}

                                </div>
                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">{{trans('menu.zone')}}</span>
                                    {!!Form ::select('modal_zone_id',(isset($workTeam))?getZones($workTeam->zone->zone->id):getZones(),(isset($workTeam))?$workTeam->zone->id:null,['class' => 'select2 form-control', 'id' => 'modal_zone_id'])!!}

                                </div>

                                <div class="input-group col-md-12">
                                    <span class="input-group-addon">{{trans('menu.workTeamType')}}</span>
                                    {!!Form ::select('modal_workTeamType', workTeamTypes(),'',['class' => 'select2 form-control', 'id' => 'modal_workTeamType'])!!}
                                </div>


                                <div class="input-group col-md-12" id="pointOrCenter_idDiv">
                                    <span class="input-group-addon">{{trans('menu.center')}}</span>
                                    {!!Form ::select('modal_pointOrCenter_id', ['no'=>'ليس هناك مراكز حاليا'],'',['class' => 'select2 form-control', 'id' => 'modal_pointOrCenter_id'])!!}
                                </div>
                            </div>
                            <!-- Custom Section Ends -->
                        </div>
                    </div>
                    <!-- Custom Section Ends -->
                </div>


                {{--                </div>--}}
                <div class="modal-footer">

                    <div class="">
                        <button type="button" id="btn_move_workTeam" class="btn btn-primary btn-sm"> نقل
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('dataTablesCss')
    <style>
        #dataTableBuilder_length {

            float: right;
            margin-left: 80px;
        }
    </style>
    <link href="{{HostUrl('design\bower_components\select2\dist\css\select2.min.css')}}" rel="stylesheet">

    <!-- Data Table Css -->
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\assets\pages\data-table\css\buttons.dataTables.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\assets\pages\data-table\extensions\responsive\css\responsive.dataTables.css')}}">--}}

    <!-- sweet alert framework -->

@endsection

@section('dataTablesJs')


    <script src="{{ HostUrl('design\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\js\jszip.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\js\pdfmake.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\js\vfs_fonts.js')}}"></script>
    <script
        src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\buttons.flash.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\jszip.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\vfs_fonts.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\buttons.colVis.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    <script
        src="{{ HostUrl('design\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
    <script
        src="{{ HostUrl('design\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}"></script>


    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>

    @include('includes.dataTables.AssignTeamDataTable')
    @include('includes.changeZones') ;


    <script>
        getZones('modal_governorate_id', 'modal_zone_id');
        getZones('center_governorate_id', 'center_zone_id');
        getZones('search_government_id', 'search_zone_id','district', 'all');


        function addMember(id, name) {
            var html = '   <div class="checkbox-fade fade-in-primary" id="member_row' + id + '">\n' +
                '<input type="hidden" class="membersArray" value="' + id + '" name="membersArray">' +
                '                                <label>\n' +
                '                                    <button type="button" onclick="$(\'#member_row' + id + '\').remove();" ><i class="fa fa-trash"> </i></button>\n' +
                '                                </label>\n' +
                '                                <label>\n' +
                '                                    <button type="button" onclick="$(\'#member_row' + id + '\').remove();" ><i class="fa fa-trash"> </i></button>\n' +
                '                                </label>\n' +
                '                                <div class="work_team_name"> ' + name + '</div>\n' +
                '                            </div>';
            $('#memberList').append(html);
        }

        $(document).on('click', '#saveListTeam', function () {
            var values = $("input[name='membersArray']")
                .map(function () {
                    return $(this).val();
                }).get();
            if ($("#pointOrCenter_id").val() > 0)
                $.ajax({
                    url: '{{route('check_points.savePointTeamList')}}',//   var url=$('#news').attr('action');
                    method: 'POST',
                    dataType: 'json',// data type that i want to return
                    data: '_token=' + encodeURIComponent("{{csrf_token()}}")
                        + '&point=' + $("#pointOrCenter_id").val()
                        + '&type=' + $("#center_workTeamType").val()
                        + '&membersArray=' + values,
                    success: function (data) {
                        toastr.success('تم تحديث الفريق بنجاح');

                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            else
                toastr.error('يجب تحديد  المركز  ');


        });

        $(document).on('change', '#center_workTeamType', function () {
            center_workTeamType();
        });

        $(document).on('change', '#modal_workTeamType', function () {
            modal_workTeamType();
        });

        $(document).on('click', '.btn_move_person', function () {
            $('#change_center_of_work').modal('show');
            $('#person_name').text($(this).data('name'));
            $('#person_id').val($(this).data('id'));
        });
        $(document).on('click', '#btn_move_workTeam', function () {
            var type = $('#modal_workTeamType').val();
            var selectList = $('#modal_pointOrCenter_id');

            if (selectList.val() > 0)
                $.ajax({
                    url: '{{route('check_points.movePerson')}}',//   var url=$('#news').attr('action');
                    method: 'POST',
                    dataType: 'json',// data type that i want to return
                    data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                        '&type=' + type +
                        '&old_type=' + '{{$workers_type}}' +
                        '&id=' + $('#person_id').val()
                        + '&point=' + $("#modal_pointOrCenter_id").val(),
                    success: function (data) {
                        // console.log(data.firstData);
                        $('#change_center_of_work').modal('hide');
                        $('#member_row' + $('#person_id').val()).remove();
                        toastr.success('تم النقل بنجاح');

                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            else
                toastr.error('يرجى تحديد النقطة اولا');
        });


        $(document).on('change', '#center_governorate_id', function () {
            center_workTeamType();
        });


        $(document).on('change', '#modal_governorate_id', function () {
            modal_workTeamType();

        });

        $(document).on('change', '#pointOrCenter_id', function () {
            var type = $('#center_workTeamType').val();
            var selectList = $('#pointOrCenter_id');
            $.ajax({
                url: '{{route('check_points.changePointOrCenter')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                    '&type=' + type
                    + '&point=' + $("#pointOrCenter_id").val(),
                success: function (data) {
                    // console.log(data.firstData);
                    $('#memberList').html(data.firstData);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });


        $(document).on('change', '#center_zone_id', function () {
            center_workTeamType();
        });
        $(document).on('change', '#modal_zone_id', function () {
            modal_workTeamType();
        });
        $(document).on('click', '.addToAssignList', function () {

            addMember($(this).data('id'), $(this).data('name'));
            // alert($(this).data('name'));
        });
        center_workTeamType();
        modal_workTeamType();

        function center_workTeamType() {
            var zone = $('#center_zone_id').val();
            var government_id = $('#center_governorate_id').val();
            var type = $('#center_workTeamType').val();
            var selectList = $('#pointOrCenter_id');
            var selectList_val = $('#pointOrCenter_id').val();
            var _this = $('#center_workTeamType');
            $.ajax({
                url: '{{route('check_points.filterPlace_type')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") + '&type=' + type + '&point_id=' + selectList_val + '&zone_id=' + zone + '&government_id=' + government_id,
                success: function (data) {
                    // console.log(data.firstData);
                    selectList.html(data.select);
                    $('#pointOrCenter_idDiv').show();
                    $('#memberList').html(data.firstData);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        function modal_workTeamType() {
            var zone = $('#modal_zone_id').val();
            var government_id = $('#modal_governorate_id').val();
            var type = $('#modal_workTeamType').val();
            var selectList = $('#modal_pointOrCenter_id');
            var selectList_val = $('#modal_pointOrCenter_id').val();
            var _this = $('#modal_workTeamType');
            $.ajax({
                url: '{{route('check_points.filterPlace_type')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                    '&type=' + type + '&point_id=' + selectList_val + '&zone_id=' + zone +
                    '&old_type=' + '{{$workers_type}}' +
                    '&government_id=' + government_id +
                    '&getTeam=' + 0,
                success: function (data) {
                    selectList.html(data.select);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }

        $(function () {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2').select2()

        });


    </script>

@endsection

