@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.quarantineTypes')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        {{--                        <li class="breadcrumb-item"><a href="#!">{{trans('menu.quarantineTypes')}}</a>--}}
                        <li class="breadcrumb-item"><a href="#!">{{trans('menu.quarantineTypes')}}</a>
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


@endsection


@section('dataTablesCss')
    <style>
        #dataTableBuilder_length {

            float: right;
            margin-left: 80px;
        }
    </style>

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



@endsection

@section('js')
    {!! $dataTable->scripts() !!}
@endsection

