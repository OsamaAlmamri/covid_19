<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu" style="    background: #ffffff;">
        {{--        <div class="pcoded-navigatio-lavel">{{trans('menu.dashboard')}}</div>--}}
        <ul class="pcoded-item pcoded-left-item">
            <li class="">
                <a href="{{route('home')}}">
                    <span class="pcoded-micon"><i class="fa fa-dashboard"></i></span>
                    <span class="pcoded-mtext">{{trans('menu.dashboard')}}</span>
                </a>
            </li>
            @if (Auth::user()->can('show blockPersons') == true)
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="fa fa-bed"></i></span>
                        <span class="pcoded-mtext ">{{trans('menu.blockPersonsReports')}}</span>
                    </a>
                    <ul class="pcoded-submenu">

                        <li class="">
                            <a href="{{route('block_persons.index')}}">
                                <span class="pcoded-mtext ">  {{trans('menu.cases_management')}}</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{route('block_persons.create')}}">
                                <span class="pcoded-mtext ">  {{trans('menu.case_registration')}}</span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif
            @if ((Auth::user()->can('show quarantines') == true)
            or(Auth::user()->can('manage quarantines') == true)
            or(Auth::user()->can('show quarantineTypes') == true)
            )

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                        <span class="pcoded-mtext ">{{trans('menu.quarantineManagement')}}</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (Auth::user()->can('show quarantines') == true)
                            <li class="">
                                <a href="{{route('quarantines.index')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.quarantineManagement')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('manage quarantines') == true)
                            <li class="">
                                <a href="{{route('quarantines.create')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.addQuarantine')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('show quarantineTypes') == true)
                            <li class="">
                                <a href="{{route('quarantineTypes.index')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.quarantineTypes')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if( (Auth::user()->can('show checkPoints') == true) or (Auth::user()->can('manage checkPoints') == true))

                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                        <span class="pcoded-mtext ">{{trans('menu.checkPointsManagement')}}</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (Auth::user()->can('show checkPoints') == true)
                            <li class="">
                                <a href="{{route('check_points.index')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.checkPoints')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('manage checkPoints') == true)
                            <li class="">
                                <a href="{{route('check_points.create')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.addCheckPoint')}}</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if ((Auth::user()->can('show worksTeams') == true)
            or(Auth::user()->can('show pointTeams') == true)or(Auth::user()->can('show healthTeams') == true))
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-bookmark"></i></span>
                        <span class="pcoded-mtext ">{{trans('menu.teamManagement')}}</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @if (Auth::user()->can('show worksTeams') == true)
                            <li class="">
                                <a href="{{route('workTeams.showAll')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.workTeams')}}</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->can('show pointTeams') == true)
                            <li class="">
                                <a href="{{route('workTeams.team.show','point')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.pointTeams')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('show healthTeams') == true)
                            <li class="">
                                <a href="{{route('workTeams.team.show','health')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.healthTeams')}}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if ((Auth::user()->can('show users') == true) or (Auth::user()->can('show permissions') == true) )
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                        <span class="pcoded-mtext">{{trans('menu.users')}}</span>
                    </a>

                    <ul class="pcoded-submenu">
                        @if (Auth::user()->can('show users') == true)
                            <li class="">
                                <a href="{{route('users.index')}}">
                                    <span class="pcoded-mtext">  {{trans('menu.usersManagement')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('manage deleted users') == true)
                            <li class="">
                                <a href="{{route('users.index','deleted')}}">
                                    <span class="pcoded-mtext">  {{trans('menu.usersManagementDeleted')}}</span>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->can('show permissions') == true)
                            <li class="">
                                <a href="{{route('permissions.index')}}">
                                    <span class="pcoded-mtext ">  {{trans('menu.AccessGroup')}}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if ((Auth::user()->can('sumBlockPersons reports') == true) or
                              (Auth::user()->can('point_daily reports') == true) or
                              (Auth::user()->can('quarantines reports') == true) or
                              (Auth::user()->can('health_satiation reports') == true)
                              )
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="fa fa-file-text-o"></i></span>
                        <span class="pcoded-mtext">{{trans('menu.Reports')}}</span>
                    </a>
                    <ul class="pcoded-submenu">


                        @if (Auth::user()->can('sumBlockPersons reports') == true)
                            <li class="pcoded-hasmenu ">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext"> {{trans('menu.sumBlockPersons')}}</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="{{route('block_persons.index','sumBlockPersons')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.sumBlockPersonsByCenter')}}    </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{route('block_persons.index','sumBlockPersons_zone')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.sumBlockPersonsByZone')}}    </span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->government==0)
                                        <li class="">
                                            <a href="{{route('block_persons.index','sumBlockPersons_gov')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.sumBlockPersonsByGovernment')}}    </span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (Auth::user()->can('point_daily reports') == true)
                            <li class="pcoded-hasmenu ">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext">{{trans('menu.point_daily_reports')}} </span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="{{route('block_persons.index','people_in_port')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.people_in_port')}}    </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{route('block_persons.index','runAway_block_peoples')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.runAway_block_peoples')}}    </span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="{{route('block_persons.index','truck_driver')}}">
                                          <span
                                              class="pcoded-mtext">       {{trans('menu.truck_driver')}}      </span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('quarantines reports') == true)

                            <li class="pcoded-hasmenu ">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext">{{trans('menu.quarantines_reports')}}</span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li class="">
                                        <a href="{{route('block_persons.index','quarantines_zone')}}">
                                  <span
                                      class="pcoded-mtext">     {{trans('menu.sumBlockPersonsByZone')}}    </span>
                                        </a>
                                    </li>
                                    @if(auth()->user()->government==0)
                                        <li class="">
                                            <a href="{{route('block_persons.index','quarantines_gov')}}">
                                  <span
                                      class="pcoded-mtext">       {{trans('menu.sumBlockPersonsByGovernment')}}      </span>
                                            </a>
                                        </li>
                                    @endif


                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->can('health_satiation reports') == true)
                            <li class="">
                                <a href="{{route('block_persons.index')}}">
                                    <span class="pcoded-mtext"> {{trans('menu.health_satiation_reports')}} </span>

                                </a>
                            </li>
                        @endif
                        {{--                        @if (Auth::user()->can('health_satiation reports') == true)--}}
                        <li class="">
                            <a href="{{route('logs.index')}}">
                                <span class="pcoded-mtext"> {{trans('menu.report_logs')}} </span>

                            </a>
                        </li>
                        {{--                        @endif--}}
                    </ul>
                </li>

            @endif

            @if ((Auth::user()->can('show app_link') == true) or (Auth::user()->can('manage app_link') == true) )
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">

                        <span class="pcoded-micon"><i class="fa fa-android"></i> </span>
                        <span class="pcoded-mtext"> {{trans('menu.app_link')}} </span>
                    </a>

                    <ul class="pcoded-submenu">
                        @if (Auth::user()->can('show app_link') == true)
                            <li class="">
                                <a href="javascript:void(0)" onclick="showAppModal()">
                                    <span class="pcoded-mtext">  {{trans('menu.show_app_link')}}</span>
                                </a>
                            </li>
                        @endif
{{--                        @if (Auth::user()->can('manage app_link') == true)--}}
                        @if(auth()->user()->getRoleNames()->first() === 'Developer')
                            <li class="">
                                <a href="javascript:void(0)" onclick="editAppModal()">
                                    <span class="pcoded-mtext"
                                          id="edit_app_link">  {{trans('menu.edit_app_link')}}</span>
                                </a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

        </ul>


    </div>
</nav>
