@extends('layout')
@section('styles')
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-forms.css')}}">
    <style>
        .thumb {
            width: 200px;
        }

    </style>
    <style type="text/css">
    </style>
@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4> {{trans('menu.quarantineTypes')}}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a
                                href="{{route('quarantineTypes.index')}}"> {{trans('menu.quarantineTypes')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($quarantineType))   {{trans('form.update.quarantineType')}}  @else  {{trans('form.add.quarantineType')}}  @endif

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="page-body">
        @if(isset($quarantineType))
            {!! Form::model($quarantineType, ['route' => ['quarantineTypes.update', $quarantineType->id], 'method' => 'put','class'=>'j-pro','id' => 'j-pro', 'files' => true]) !!}
        @else
            {!! Form::open(['role' => 'form', 'route' => 'quarantineTypes.store', 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}
        @endif
        <div class="card">
            <div class="card-header">
                <h5> @if(isset($quarantineType))   {{trans('form.update.quarantineType')}}  {{$quarantineType->name}} @else {{trans('form.add.quarantineType')}}   @endif </h5>
            </div>
            <div class="card-block">
                <div class="wrapper wrapper-640">
                    <div class="j-forms">
                        <div class="content">
                            <div class="divider-text gap-top-20 gap-bottom-45">
                                <span>{{trans('form.info.quarantineType')}}</span>
                            </div>
                            <!-- start name email -->
                            <div class="j-row">

                                <div class="input">
                                    <label class="icon-right" for="name">
                                        <i class="fa fa-building"></i>
                                    </label>
                                    {!! Form::text('name', null, [ 'id' => 'name'  ,'placeholder'=>trans("form.name")]) !!}
                                    @error('name') <span
                                        class="btn-block badge badge-danger">{{ $message }}</span> @enderror

                                </div>
                            </div>
                            <!-- end name email -->
                            <!-- start password -->

                            <!-- end confirm password -->
                            <div class="divider gap-bottom-25"></div>
                            <!-- end gender -->
                            <div class="col-xs-12 mb-2">
                                <a href="{{ route('quarantineTypes.index') }}" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> {{trans("form.cancel")}}
                                </a>
                                <button type="button" onclick="return admincreate();" class="btn btn-primary">
                                    <i class="fa fa-check-square-o"></i> {{trans("form.save")}}
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


@endsection



@section('js')

    <script type="text/javascript">

        function admincreate() {

            $('#j-pro').submit();
        }

    </script>

@endsection
