@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4> {{trans('menu.home')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
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
            <!-- statustic-card start -->


            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-blue text-white" style="background: #0a65c2">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.Admins')}} </p>
                                <h4 class="m-b-0">{{$admins}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-users f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.staff')}} </p>
                                <h4 class="m-b-0">{{$employees}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class=" fa fa-users f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-green text-white" style="background: #255681;
}">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.projects')}}</p>
                                <h4 class="m-b-0">{{$projects}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-file-excel-o f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-orenge text-white" style="background: #3f51b5eb">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.tasks')}}</p>
                                <h4 class="m-b-0">{{$tasks}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-sticky-note-o f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-pink text-white" style="background: #8235f5;">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.periods')}}</p>
                                <h4 class="m-b-0">{{$periods}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-clock-o f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.qrs')}}</p>
                                <h4 class="m-b-0">{{$qrs}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-barcode f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- latest activity end -->
        </div>
    </div>

    <!-- Modal -->

@endsection


@section('dataTablesCss')
    <style>
        #dataTableBuilder_length {

            float: right;
            margin-left: 80px;
        }
    </style>

@endsection




@section('js')
@endsection

