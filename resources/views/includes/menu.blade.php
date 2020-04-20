<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        {{--        <div class="pcoded-navigatio-lavel">{{trans('menu.dashboard')}}</div>--}}
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('home')}}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">{{trans('menu.dashboard')}}</span>
                </a>
            </li>
            {{--            @if (Auth::user()->can('show permissions') == true)--}}

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                    <span class="pcoded-mtext ">{{trans('menu.quarantineManagement')}}</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="{{route('quarantines.index')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.quarantineManagement')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('quarantines.create')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.addQuarantine')}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('quarantineTypes.index')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.quarantineTypes')}}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                    <span class="pcoded-mtext ">{{trans('menu.checkPointsManagement')}}</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="{{route('check_points.index')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.checkPoints')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('check_points.create')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.addCheckPoint')}}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                    <span class="pcoded-mtext ">{{trans('menu.teamManagement')}}</span>
                </a>
                <ul class="pcoded-submenu">

                    <li class="">
                        <a href="{{route('workTeams.showAll')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.workTeams')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('workTeams.team.show','point')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.pointTeams')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('workTeams.team.show','health')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.healthTeams')}}</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                    <span class="pcoded-mtext">{{trans('menu.Reports')}}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('projects.index')}}">
                            <span class="pcoded-mtext">  {{trans('menu.healthTeamReport')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="#">
                            <span class="pcoded-mtext ">  {{trans('menu.checkPointsTeamReport')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('block_persons.index')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.blockPersonsReports')}}</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                    <span class="pcoded-mtext">{{trans('menu.users')}}</span>
                </a>

                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('users.index')}}">
                            <span class="pcoded-mtext">  {{trans('menu.usersManagement')}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('permissions.index')}}">
                            <span class="pcoded-mtext ">  {{trans('menu.AccessGroup')}}</span>
                        </a>

                    </li>


                </ul>
            </li>

        </ul>


    </div>
</nav>
