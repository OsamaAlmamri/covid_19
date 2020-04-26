@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.block_persons')}}</h4>

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
                                href="#">{{trans('menu.block_persons')}}
                            </a>
                        </li>
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
                <div class="sub-title"> {{trans('menu.btn_filterCenter')}}</div>
                <div class="row">
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.government')}}</span>
                        <?php $getGovernorate = getGovernorates(); $getGovernorate['all'] = 'all'; ?>
                        {!!Form ::select('government_id',array_reverse($getGovernorate,true),null,['class' => 'select2 form-control', 'id' => 'government_id'])!!}

                    </div>
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.zone')}}</span>
                        {!!Form ::select('zone_id',getZones('all',1),null,['class' => 'select2 form-control', 'id' => 'zone_id'])!!}

                    </div>


                    <div class="input-group col-md-3" id="pointOrCenter_idDiv">
                        <span class="input-group-addon">{{trans('menu.center')}}</span>
                        {!!Form ::select('pointOrCenter_id', ['all'=>'all   '],'',['class' => 'select2 form-control', 'id' => 'pointOrCenter_id'])!!}
                    </div>

                    <div class="input-group col-md-3">

                        <button type="button" name="filter" id="filter"
                                class="btn btn-primary btn-ms waves-effect waves-light filterBtn">
                            filter<i class="fa fa-filter"></i>
                        </button>


                    </div>

                    @include('reports.printSetting')


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
        <table id="orderdata" class="dataTable table table-striped table-hover table table-bordered">
        </table>

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

    @include('includes.dataTables.blockPersonsDataTable')
    @include('includes.changeZones') ;


    <script>
        getZones('government_id', 'zone_id', 'all');


        $(document).on('change', '#center_workTeamType', function () {
            center_workTeamType();
        });

        $(document).on('change', '#government_id', function () {
            center_workTeamType();
        });


        $(document).on('change', '#zone_id', function () {
            center_workTeamType();
        });
        $(document).on('click', '.addToAssignList', function () {

            addMember($(this).data('id'), $(this).data('name'));
        });
        center_workTeamType();

        function center_workTeamType() {
            var zone = $('#zone_id').val();
            var government_id = $('#government_id').val();
            var type = 'health';
            var selectList = $('#pointOrCenter_id');
            var _this = $('#center_workTeamType');
            $.ajax({
                url: '{{route('check_points.filterPlace_type')}}',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") +
                    '&type=' + type +
                    '&zone_id=' + zone +
                    '&all=' + 'all' +
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

