@extends('layout')

@section('styles')


@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4> {{trans('permissions.permissions.permissions')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('permissions.index')}}">{{trans('permissions.permissions.permissions')}}</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="card">

        <div class="card-block table-border-style">
            <div class="table-responsive text-center">
                <table class="table table-styling" >
                    <thead>
                    <tr class="table-primary">
                        <th  class="text-center">#</th>
                        <th class="text-center"> {{trans('permissions.role.name')}} </th>
                        <th class="text-center"> {{trans('permissions.permissions.edit')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $k=> $role)
                        <tr>
                            <td>{{$k}}</td>
                            <td >{{$role->name}}</td>
                            <td >
                                <a href="{{ route('permissions.edit', $role->id) }}"
                                   class="btn btn-primary"><i
                                        class="fa fa-pencil"></i></a>
                            </td >
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


