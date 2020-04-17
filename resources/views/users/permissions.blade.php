@extends('layout')

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ HostUrl('design\assets\pages\j-pro\css\j-pro-modern.css')}}">

@endsection
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>Role</h4>
                        <span>All Prmissions</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> home </a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admins.index')}}">admins</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">
                                @if(isset($admin))  Update  @else Add new  @endif

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')
    <!-- Default unchecked -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> @if(isset($admin))  Update  {{$admin->name}} @else Add new  @endif Additional
                            Permissions</h5>
                    </div>
                    <div class="card-block">
                        <div class="j-wrapper ">

                            {!! Form::open(['role' => 'form', 'route' => ['admins.updatePermissions', $admin->id], 'class'=>'j-pro','id' => 'j-pro', 'method' => 'post', 'files' => true]) !!}

                            <div class="j-content">
                                <!-- start name -->
                                <div class="j-unit">
                                    <div class="accordion" id="accordionExample">

                                        <label> <input type="checkbox" id="select_all"/> اختيار الكل
                                        </label>

                                        @foreach($permissions as $k => $sub_permission)
                                            <div class="card">

                                                <div class="card-header" id="headingOne">
                                                    <h6 class="mb-0">
                                                        <input type="checkbox" class="selectGroup"
                                                               data-id="{{$k}}"
                                                               onclick="selectSub($(this),'{{$k}}')"
                                                               data-selected="0"/> select all permissions for {{$k}}
                                                        <a data-toggle="collapse" data-target="#{{$k}}"
                                                           aria-expanded="true" aria-controls="collapseOne">
                                                            <i style="font-size: 18px"
                                                               class="fa fa-plus-square primary_site_color"></i>
                                                        </a>

                                                    </h6>
                                                </div>
                                                <div id="{{$k}}" class="collapse "
                                                     aria-labelledby="headingOne"
                                                     data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">

                                                            <br>
                                                        </label>

                                                        <div class="form-group row">

                                                            <br>
                                                            @foreach ($sub_permission as $k_sub => $permission)
                                                                <div class=" col-md-4 col-sm-6 col-xs-12">
                                                                    <label class="form-check-label">
                                                                        <input type="checkbox"
                                                                               @if(in_array($permission->id, $oldRolePermission))
                                                                               checked disabled
                                                                               class="form-check-input"
                                                                               @elseif(in_array($permission->id, $directPermissions ))
                                                                               name="permissions[]"
                                                                               checked
                                                                               class="form-check-input selectAll select-message{{$k}}"
                                                                               @else
                                                                               name="permissions[]"
                                                                               class="form-check-input selectAll select-message{{$k}}"
                                                                               @endif
                                                                               value="{{$permission->id}}"> {{$permission->name}}
                                                                    </label>
                                                                </div>
                                                        @endforeach
                                                        <!--                        @error('categories') <span class="btn-block badge badge-danger">{{ $message }}</span> @enderror-->

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- end name -->
                        </div>
                        <!-- end /.content -->
                        <div class="j-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                        <!-- end /.footer -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <!-- Custom js -->
    <script>
        $(document).on('click', '#select_all', function () {
            if (this.checked) {
                // Iterate each checkbox
                $('input:checkbox.selectAll').each(function () {
                    this.checked = true;
                });

                $('input:checkbox.selectGroup').each(function () {
                    // alert($(this).attr('data-id'))
                    this.checked = true;
                });

            } else {
                $('input:checkbox.selectAll').each(function () {
                    this.checked = false;
                });
                $('input:checkbox.selectGroup').each(function () {
                    this.checked = false;
                });
            }
        });

        function selectSub(e, id) {
            // alert(e.attr('type'));
            // e.attr('data-selected');
            // console.log(e.attr('isSelected'));
            // alert(e);
            if (e.attr('data-selected') == 0) {
                // Iterate each checkbox
                $('input:checkbox.select-message' + id).each(function () {
                    this.checked = true;
                    e.attr('data-selected', 1);
                });

            } else {
                $('input:checkbox.select-message' + id).each(function () {
                    this.checked = false;
                    e.attr('data-selected', 0)
                });
            }
        }

    </script>
    <script type="text/javascript" src="{{ HostUrl('design\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>

    <script type="text/javascript" src="{{ HostUrl('design\bower_components\switchery\js\switchery.min.js')}}"></script>
    <script type="text/javascript" src="{{ HostUrl('design\assets\pages\advance-elements\swithces.js')}}"></script>

    <!-- Switch component js -->

@endsection
