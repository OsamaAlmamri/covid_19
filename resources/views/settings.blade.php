@extends('layout')


@section('content')
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">  {{trans('menu.setting')}}</h3>
        </div>

        <button class="submit pull-right" data-toggle="modal" data-target="#add-newsetting">{{trans('menu.AddNewSettingKy')}}</button>

        <div class="card-body  ">
            <div class="card-block">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('settings.store') }}"
                      enctype="multipart/form-data">
                    <div id="accordion" class="panel-group">
                        {{ csrf_field() }}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#site_details">SITE
                                        DETAILS</a>
                                </h4>
                            </div>

                            {{--                            {{dd(Setting::all())}}--}}
                            <div id="site_details" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    @forelse(Setting::all() as $key=>$item)
                                        @if($key=='site_title')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>

                                        @elseif($key=='site_logo')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <br/>
                                                @if(Setting::get('site_logo')!='')
                                                    <img style="height: 90px; margin-bottom: 15px; border-radius:2em;"
                                                         src="{{Setting::get('site_logo')}}">
                                                @endif
                                                <input type="file" accept="image/*" name="site_logo" class="dropify"
                                                       id="site_logo" aria-describedby="fileHelp">

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first($key) }}</strong>
                                                    </span>
                                                @endif
                                            </div>


                                        @elseif($key=='site_favicon')

                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <br/>
                                                @if(Setting::get('site_favicon')!='')
                                                    <img style="height: 90px; margin-bottom: 15px; border-radius:2em;"
                                                         src="{{Setting::get('site_favicon')}}">
                                                @endif
                                                <input type="file" accept="image/*" name="site_favicon" class="dropify"
                                                       id="site_favicon" aria-describedby="fileHelp">

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='site_copyright')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key == 'default_lang')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <select name="default_lang" id="default_lang" value="" required
                                                        class="form-control">
                                                    @foreach($listlang as $lang)
                                                        <option value="{{$lang}}"
                                                                @if(Setting::get('default_lang')==$lang) selected @endif>{{$lang}}</option>
                                                    @endforeach

                                                </select>
                                                @if ($errors->has($key))
                                                    <span class="help-block">Setting::get('default_lang')
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='client_id')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='client_secret')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>


                                        @elseif($key=='TWILIO_SID')

                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='TWILIO_TOKEN')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='TWILIO_FROM')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>

                                        @elseif($key=='PUBNUB_PUB_KEY')

                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='PUBNUB_SUB_KEY')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#app_details">APP
                                        SETTING</a>
                                </h4>
                            </div>
                            <div id="app_details" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @forelse(Setting::all() as $key=>$item)
                                        @if($key=='ANDROID_ENV')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='ANDROID_PUSH_KEY')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='IOS_USER_ENV')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='IOS_PROVIDER_ENV')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>

                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#social_setting">SOCIAL
                                        SETTING</a>
                                </h4>
                            </div>
                            <div id="social_setting" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @forelse(Setting::all() as $key=>$item)
                                        @if($key=='FB_CLIENT_ID')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='FB_CLIENT_SECRET')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='FB_REDIRECT')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_CLIENT_ID')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_CLIENT_SECRET')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_REDIRECT')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_API_KEY')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_REDIRECT')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='GOOGLE_REDIRECT')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_FACEBOOK_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_TWITTER_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_INSTAGRAM_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_PINTEREST_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_VIMEO_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='SOCIAL_YOUTUBE_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='IOS_APP_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @elseif($key=='ANDROID_APP_LINK')
                                            <div class="form-group col-xs-12 mb-2">
                                                <label for="name">@lang('setting.'.$key)</label>
                                                <input id="{{$key}}" type="text" class="form-control" name="{{$key}}"
                                                       value="{{ $item }}" required autofocus
                                                       @if($key=='currency_code') readonly @endif >

                                                @if ($errors->has($key))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first($key) }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 mb-2">
                        <a href="{{ route('settings') }}" class="btn btn-warning mr-1">
                            <i class="ft-x"></i>  {{trans('form.cancel')}}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-square-o"></i> {{trans('form.save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--  Add Address modal -->
    <div class="modal fade" id="add-newsetting" tabindex="-1" role="dialog" aria-labelledby="add-newsetting"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-popup">
                <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
                <form action="{{url('admin/setting/add')}}" method="POST" class="popup-form">
                    <h3 class="pop-tit">Add New Key And Value For Settings</h3>
                    {{ csrf_field() }}

                    <input type="text" class="form-control form-white" id="new_key" name="key" placeholder="Setting key"
                           required>
                    <input type="text" class="form-control form-white" id="value_new_key" name="value" required
                           placeholder="Setting Value">
                    <button type="submit" class="btn btn-submit m-0">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Address modal -->

@endsection

@section('styles')
    <link href="{{HostUrl('design/custom/dropify/dist/css/dropify.min.css')}}" rel="stylesheet">

@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.setting')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>

                        <li class="breadcrumb-item"><a href="#">
                                {{trans('menu.setting')}}

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>

    <script type="text/javascript">
        $('.dropify').dropify();
        $('#currency').on('change', function () {
            var currency_code = $(this).find(':selected').data('id');
            $('#currency_code').val(currency_code);
        })
    </script>
@endsection
