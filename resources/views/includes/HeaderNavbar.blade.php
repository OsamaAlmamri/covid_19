<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu"></i>
            </a>

            <a href="{{route('home')}}">
                <img class="img-fluid"
                     src="{{   HostUrl('images/logo2.png') }}"
                     {{--                     src="{{ Setting::get('site_logo') ? Setting::get('site_logo') :  HostUrl('images/logo.png') }}"--}}
                     style="width: 70px" alt="">

                {{--                {{ Setting::get('site_title')}}--}}
                GR
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
                <li class="header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-bell"></i>
                            <span class="badge bg-c-pink"
                                  id="notification_count">{{ auth()->user()->unreadNotifications->count() }} </span>
                        </div>

                        <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn"
                            data-dropdown-out="fadeOut">
                            <h6 class="" style="    position: fixed; margin-right: 15px; margin-left: 15px"><a
                                    href="{{route('makeAllNotificationRead')}}"> {{trans('menu.makeNotificationAsRead')}}</a>
                            </h6>
                            <div>
                                <div id="admin_notification"
                                     style="overflow: scroll; overflow-x: hidden; max-height: 350px; margin-top: 36px;">
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            <div class="media">
                                                <img class="d-flex align-self-center img-radius"
                                                     src="{{ HostUrl($notification->data['sender_image'])}}"
                                                     alt="">
                                                <div class="media-body">
                                                    <h5 class="notification-user"> {{ $notification->data['sender_name'] }}</h5>

                                                    <p class="notification-msg">{{ $notification->data['message'] }}
                                                    </p>
                                                    <span
                                                        class="notification-time">{{ $notification->data['date'] }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach


                                </div>
                            </div>

                            <li>
                                <h6 style="margin-bottom: -19px;text-align: center;"><a> {{trans('menu.viewAll')}}</a>
                                </h6>

                            </li>
                        </ul>
                    </div>
                </li>
                <li class="user-profile header-notification">
                    <a href="{{route('lang',getOtherLang())}}">
                        @if(getOtherLang()=='en')
                            <img style="width: 20px;margin-bottom: 15px;"
                                 src="{{ HostUrl('design\assets\icon\flag-icons\fonts\ye.svg')}}">
                        @else
                            <img style="width: 20px;margin-bottom: 15px;"
                                 src="{{ HostUrl('design\assets\icon\flag-icons\fonts\us.svg')}}">
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
