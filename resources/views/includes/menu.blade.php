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
                        <a href="">
                            <span class="pcoded-mtext ">  {{trans('menu.addQuarantine')}}</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="">
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
                        <a href="#">
                            <span class="pcoded-mtext ">  {{trans('menu.checkPoints')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="">
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
                        <a href="#">
                            <span class="pcoded-mtext ">  {{trans('menu.pointTeams')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="">
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
                        <a href="#">
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
                            <span class="pcoded-mtext noActiveMenu">  {{trans('menu.AccessGroup')}}</span>
                        </a>

                    </li>
                    <li class="">
                        <a href="#">
                            <span class="pcoded-mtext noActiveMenu">  {{trans('menu.AttributeAccessGroup')}}</span>
                        </a>
                    </li>

                </ul>
            </li>


            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="fa fa-windows"></i></span>
                    <span class="pcoded-mtext noActiveMenu">{{trans('menu.system')}}</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="">
                        <a href="{{route('settings')}}">
                            <span class="pcoded-micon"><i class="fa fa-cog"></i></span>
                            <span class="pcoded-mtext noActiveMenu">{{trans('menu.setting')}}</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="{{route('lang',getOtherLang())}}">
                            @if(getOtherLang()=='ar')
                                <img style="width: 20px;margin-bottom: 15px;"
                                     src="{{ HostUrl('design\assets\icon\flag-icons\fonts\ye.svg')}}">
                            @else
                                <img style="width: 20px;margin-bottom: 15px;"
                                     src="{{ HostUrl('design\assets\icon\flag-icons\fonts\us.svg')}}">
                            @endif
                        </a>
                    </li>

                </ul>
            </li>

        </ul>


    </div>
</nav>
