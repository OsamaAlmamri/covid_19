@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.report_logs')}}</h4>

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
                                href="#">{{trans('menu.report_logs')}}
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
                <div class="sub-title"> {{trans('menu.btn_filterLogs')}}</div>
                <div class="row">
                    <div class="input-group col-md-3">
                        <span class="input-group-addon">{{trans('menu.reports')}}</span>
                        {!!Form ::select('reports',getReporsType(),null,['class' => 'select2 form-control', 'id' => 'reports_type'])!!}
                    </div>
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
    <script
        src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\jszip.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>


    @include('includes.dataTables.ReportsLogsDataTable')


    <script>

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

