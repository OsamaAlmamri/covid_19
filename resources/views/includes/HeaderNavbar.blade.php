<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"  style="float: right;
"></i>
            </a>

            <a href="{{route('home')}}">
                <img class="img-fluid"
                     {{--                     src="{{   HostUrl('images/logo2.png') }}"--}}
                     {{--                     src="{{ Setting::get('site_logo') ? Setting::get('site_logo') :  HostUrl('images/logo.png') }}"--}}
                     alt="">

                {{--                                {{ Setting::get('site_title')}}--}}
               <h5>  {{trans('menu.systemName')}} </h5>
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i
                                    class="feather icon-search"></i></span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="feather icon-maximize full-screen"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right" style="margin-left: 20%">
                <li class="user-profile header-notification">
                    <a href="{{route('lang',getOtherLang())}}">
                        @if(getOtherLang()=='ar')
                            <span> AR</span>
                            {{--                            <img style="width: 20px;margin-bottom: 15px;"--}}
                            {{--                                 src="{{ HostUrl('design\assets\icon\flag-icons\fonts\ye.svg')}}">--}}
                        @else
                            <span> EN</span>
                            {{--                            <img style="width: 20px;margin-bottom: 15px;"--}}
                            {{--                                 src="{{ HostUrl('design\assets\icon\flag-icons\fonts\us.svg')}}">--}}
                        @endif
                    </a>
                </li>

                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ HostUrl(auth()->user()->avatar)}}" class="img-radius"
                                 alt="{{trans('menu.profile')}}">
                            <span>{{auth()->user()->name}} </span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu"
                            data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                            <li>
                                <a href="{{route('profile')}}">
                                    <i class="feather icon-user"></i> {{trans('menu.profile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">
                                    <i class="feather icon-log-out"></i> {{trans('menu.logOut')}}
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
