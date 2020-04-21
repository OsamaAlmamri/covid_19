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
                <div class="card bg-c-blue text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.allUsers')}} </p>
                                <h4 class="m-b-0">{{$allUsers}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-users f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-blue text-white" style="background: #b0c4de">
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
                <div class="card bg-c-blue text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.dataEntry')}} </p>
                                <h4 class="m-b-0">{{$dataEntry}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class=" fa fa-users f-50 text-c-pink"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-green text-white" style="background: #b0c4de;">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5">  {{trans('menu.zones')}}</p>
                                <h4 class="m-b-0">{{$zones}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-adn f-50 text-c-yellow"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-orenge text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.quarantines')}}</p>
                                <h4 class="m-b-0">{{$quarantines}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-object-group f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-c-pink text-white" style="background: #b0c4de;">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.checkPoints')}}</p>
                                <h4 class="m-b-0">{{$checkPoints}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-object-ungroup f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.workTeams')}}</p>
                                <h4 class="m-b-0">{{$workTeams}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-users f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.workTeams_male')}}</p>
                                <h4 class="m-b-0">{{$workTeams_male}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-male f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.workTeams_female')}}</p>
                                <h4 class="m-b-0">{{$workTeams_female}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-female f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.s_block_persons')}}</p>
                                <h4 class="m-b-0">{{$s_block_persons}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-users f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.workTeams_male')}}</p>
                                <h4 class="m-b-0">{{$block_persons_male}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-male f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.block_persons_female')}}</p>
                                <h4 class="m-b-0">{{$block_persons_female}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-female f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.s_healthTeams')}}</p>
                                <h4 class="m-b-0">{{$s_healthTeams}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa fa-users f-50 text-c-green"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6">
                <div class="card bg-simple-c-lite-green text-white" style="background: #b0c4de">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col">
                                <p class="m-b-5"> {{trans('menu.s_pointTeams')}}</p>
                                <h4 class="m-b-0">{{$s_pointTeams}}</h4>
                            </div>
                            <div class="col col-auto text-right">
                                <i class="fa  fa-user-secret f-50 text-c-green"></i>
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

