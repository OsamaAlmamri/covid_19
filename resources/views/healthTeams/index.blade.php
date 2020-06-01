@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.healthTeams')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{trans('menu.healthTeams')}}</a>
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
        {!! $dataTable->table(['class'=>'dataTable table table-striped table-hover table table-bordered' ],true)  !!}

    </div>



    <!-- Modal -->
    <div id="multipleDelete" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">delete</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <div class="empty_record hidden">
                            <h3>please check some record </h3>
                        </div>
                        <div class="not_empty_record hidden">
                            <h3> Do you want to delete this items <span id="record_count"></span> ?</h3>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">Close
                        </button>
                    </div>
                    <div id="not_empty_record hidden">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">No
                        </button>
                        <input type="submit" name="del_all" value="Yes"
                               class="btn btn-danger del_all">
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
    {{--    <!-- Data Table Css -->--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\data-table\css\buttons.dataTables.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css"--}}
    {{--          href="{{ HostUrl('design\assets\pages\data-table\extensions\responsive\css\responsive.dataTables.css')}}">--}}

    <!-- sweet alert framework -->
{{--    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\bower_components\sweetalert\css\sweetalert.css')}}">--}}
@endsection

@section('dataTablesJs')


    <script src="{{ HostUrl('design\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
    <script
        src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\dataTables.buttons.min.js')}}"></script>
    <script src="{{ HostUrl('design\assets\pages\data-table\extensions\buttons\js\jszip.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
    <script src="{{ HostUrl('design\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
    @include('includes.active')
    <script>

        Active('/users/active');

    </script>



@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection

