@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.phases')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{$project->title}}</a></li>
                        <li class="breadcrumb-item"><a href="#!">{{trans('menu.phases')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="page-body">
        <div class="row">
            <div class="col-xl-3 col-lg-12 ">
                <!-- Search box card start -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-header-text">Search Box</h5>
                    </div>
                    <div class="card-block p-t-10">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search here...">
                            <span class="input-group-addon" id="basic-addon1"><i
                                    class="icofont icofont-search"></i></span>
                        </div>
                        <div class="task-right">

                            <div class="task-right-header-users">
                                <span data-toggle="collapse"> {{trans('menu.projectTeam')}}</span>
                                <i class="icofont icofont-rounded-down f-right"></i>
                            </div>
                            <div class="user-box assign-user taskboard-right-users">
                                <div id="project_team_view">
                                    @foreach($project->users as $user )
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="#">
                                                    <img class="media-object img-radius"
                                                         src="{{HostUrl($user->avatar)}}"
                                                         alt="{{$user->user}}">
                                                    {{--                                            <div class="live-status bg-danger"></div>--}}
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6>{{$user->name}}</h6>
                                                <p>{{$user->username}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <a class="btn btn-primary btn-add-phase waves-effect waves-light m-t-10" href="#"
                                   id="show_addMember_btn"><i
                                        class="icofont icofont-plus"></i> {{trans('form.add.member')}} </a>

                            </div>
                            <!-- end of task-board-right users -->

                            <!-- end of task-right-revision -->
                        </div>
                        <!-- end of sidebar-right -->
                    </div>
                    <!-- end of card-block -->
                </div>
                <!-- Search box card end -->
            </div>

            <div class="col-xl-9 col-lg-12 filter-bar">
                <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                    <div class="nav-item nav-grid">

                        <a class="btn btn-primary btn-add-phase waves-effect waves-light m-t-10" href="#"
                           id="show_addphase_btn"
                        ><i class="icofont icofont-plus"></i> {{trans('form.add.phase')}} </a>

                    </div>
                    <!-- end of by priority dropdown -->

                </nav>


                <div class="row" id="phases_div">
                    @if(isset($project->phases))
                        @foreach($project->phases as $phase)
                            <div class="col-sm-6" id="phase_{{$phase->id}}">
                                <div class="card card-border-default">
                                    <div class="card-header">
                                        <a href="#" class="card-title"
                                           id="form_phase_title{{$phase->id}}"> {{$phase->title}} </a>
                                        {{--                                <span class="label label-success f-right">{{$phase->start_date}} </span>--}}
                                    </div>

                                    <div class="card-block">
                                        <div class="row">
                                            <p class="task-due col-sm-2"><strong> {{trans('task.due')}} : </strong></p>
                                            <div class="col-sm-4">
                                                <p class="task-detail"
                                                   id="phase_start_date{{$phase->id}}">{{dateViewFormat($phase->start_date)}} </p>
                                            </div>
                                            <div class="col-sm-2">
                                                <p class="task-detail">{{trans('phase.to')}} </p>
                                            </div>
                                            <div class="col-sm-4">
                                                <p class="task-detail"
                                                   id="phase_end_date{{$phase->id}}">{{ dateViewFormat($phase->end_date) }} </p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail task_description"
                                                   id="phase_description{{$phase->id}}">{{$phase->description}} </p>

                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>

                                    <div class="card-footer">
                                        <a class="btn btn-primary btn-add-phase waves-effect waves-light m-t-10"
                                           href="{{route('phases.show',$phase->id)}}"><i
                                                class="icofont icofont-plus"></i>
                                            {{trans('menu.tasks')}}</a>
                                        <div class="task-board">
                                        {!!Form ::select('status', getAllPhaseStatus(),$phase->status,['class' => 'select2 dropdown-secondary dropdown', 'id' => 'status'])!!}

                                        <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button
                                                    class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                    type="button" id="dropdown3" data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"><i
                                                        class="icofont icofont-navigation-menu"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown3"
                                                     data-dropdown-in="fadeIn"
                                                     data-dropdown-out="fadeOut">
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect editphase"
                                                       data-id="{{$phase->id}}" href="#!"><i
                                                            class="icofont icofont-ui-edit"></i> {{trans('form.update.phase')}}
                                                    </a>
                                                    <a class="dropdown-item waves-light waves-effect remove_phase"
                                                       data-id="{{$phase->id}}" href="#!"><i
                                                            class="icofont icofont-close-line"></i>
                                                        {{trans('form.delete.phase')}}</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- phase board design block end -->
            </div>
            <!-- Left column end -->
        </div>

        <div class="modal fade " id="NewphaseModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLabel"> {{trans('phase.add')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="new_phase_form">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}">
                            <div class="row">
                                <label class="col-sm-12 col-form-label"> {{trans('phase.title')}} </label>
                                <div class="col-sm-12">
                                <textarea name="title" class="form-control save_phase_todo" rows="2"
                                          id="form_phase_title"> </textarea>
                                    <div class="print-error-msg alert-danger"
                                         id="error_phase_title"></div>
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <label class="col-xl-3 col-form-label">{{trans('phase.period')}}</label>

                                <div class="col-sm-12 col-xl-9">
                                    <div class="input-daterange input-group" id="datepicker">
                                        {!! Form::text('start_date',  isset($project)?dateFormat($project->start_date):null, [ 'id' => 'form_phase_start_date' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.start_date')]) !!}

                                        <span class="input-group-addon">{{trans('phase.to')}}</span>
                                        {!! Form::text('end_date',  isset($project)?dateFormat($project->end_date):null, [ 'id' => 'form_phase_end_date' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.end_date')]) !!}

                                    </div>
                                    <div class="print-error-msg alert-danger"
                                         id="error_phase_end_date"></div>
                                    <div class="print-error-msg alert-danger"
                                         id="error_phase_end_date"></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-12 col-form-label">{{trans('phase.description')}}</label>
                                <div class="col-sm-12">
                                <textarea name="description" class="form-control save_phase_todo" rows="7"
                                          id="form_phase_description"> </textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="save_btn btn btn-primary"
                                id="new_phase_btn">{{trans('form.save')}}</button>
                        <button type="button" class="btn btn-default close_btn"
                                data-dismiss="modal">{{trans('form.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade " id="NewMemberModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLabel"> {{trans('project.team')}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="teme_member_form">
                            @csrf
                            <input type="hidden" name="project_id" value="{{$project->id}}">

                            {{--                            {{dd(getProjectTeam($project))}}--}}
                            <div class="row">
                                <div class="col-sm-12 col-xl-12 m-b-30">
                                    <h4 class="sub-title">{{trans('project.team')}}</h4>
                                    {!!Form ::select('teamMembers', getAllManagers(),getProjectTeam($project),['class' => 'searchable',   'multiple'=>'multiple','id' => 'custom-headers'])!!}
                                </div>

                            </div>

                            <br>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="save_btn btn btn-primary"
                                id="btn_teme_member">{{trans('form.save')}}</button>
                        <button type="button" class="btn btn-default close_btn"
                                data-dismiss="modal">{{trans('form.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>

    </div>



@endsection





@section('js')
    <script src="{{HostUrl('design/bower_components/select2/js/select2.full.min.js')}}"></script>
    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>

    <script src="{{HostUrl('design/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js')}}"></script>
    <script src="{{HostUrl('design/bower_components/multiselect/js/jquery.multi-select.js')}}"></script>
    <script src="{{HostUrl('design/assets/js/jquery.quicksearch.js')}}"></script>
    <script src="{{HostUrl('design/assets/pages/advance-elements/select2-custom.js')}}"></script>
    {{--        <script type="text/javascript" src="../files/assets/pages/advance-elements/select2-custom.js"></script>--}}


    <script type="text/javascript"
            src="{{HostUrl('design/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript"
            src="{{HostUrl('design/bower_components/datedropper/js/datedropper.min.js')}}"></script>


    <script type="text/javascript" src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>


    <script>
        $('.input-daterange input').each(function () {
            $(this).datepicker();
        });
        $('#sandbox-container .input-daterange').datepicker({
            todayHighlight: true
        });


        $(document).on('click', '.editphase', function () {

            $('#form_phase_id').remove();
            $('#new_phase_form')[0].reset();
            var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&phase_id=' + encodeURIComponent($(this).data('id'));

            $.ajax({
                url: "{{route('phases.getPhaseDeatial')}}",
                type: 'POST',
                data: data,
                success: function (data) {

                    console.log(data);
                    // toastr.success('تم اضافة  المهمة  بنجاح');
                    $('#NewphaseModal').modal('show');
                    $('#new_phase_btn').attr('btn_type', 'edit');

                    $('#new_phase_form').append('<input type="hidden" id="form_phase_id" name="phase_id" value="' + data.id + '">');
                    $('#form_phase_title').val(data.title);
                    $('#form_phase_description').val(data.description);
                    $('#form_phase_hour').val(data.hour);
                    $('#form_phase_start_date').val(data.start_date);
                    $('#form_phase_end_date').val(data.end_date);
                    $('#form_phase_status').val(data.status);
                    $('#form_phase_priority').val(data.priority);
                },
                error: function (jqXhr, status) {

                }

            });


        });


        $(document).on('click', '#btn_teme_member', function () {

            var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&team=' + encodeURIComponent($('#custom-headers').val())
                + '&project_id=' + encodeURIComponent('{{$project->id}}');

            $.ajax({
                url: "{{route('projects.team')}}",
                type: 'POST',
                data: data,
                success: function (data) {
                    $("#project_team_view").html(data.team)
                    toastr.success('تم تعديل فريق المشروع  بنجاح');
                    $('#NewMemberModal').modal('hide');
                },
                error: function (jqXhr, status) {

                }

            });


        });
        $(document).on('click', '#show_addMember_btn', function () {


            $('#NewMemberModal').modal('show');
        });

        $(document).on('click', '#show_addphase_btn', function () {

            $('#form_phase_id').remove();
            $('#new_phase_btn').attr('btn_type', 'new');
            $('#new_phase_form')[0].reset();
            $('#NewphaseModal').modal('show');
        });


        function editphase(data) {

            // $('#phase_title'+data.id).val(data.type);
            $('#phase_title' + data.id).remove();
            $('#phase_description' + data.id).html(data.description);
            $('#phase_start_date' + data.id).html(data.start_date);
            $('#phase_end_date' + data.id).html(data.end_date);
            $('#phase_status' + data.id).html(data.status);
            $('#phase_priority' + data.id).html(data.priority);
            toastr.success('تم تعديل  المهمة  بنجاح');
        }

        function newphase(data) {
            toastr.success('تم اضافة  المرحلة  بنجاح');
            // '     /n' +

            var newphase = '                        <div class="col-sm-6">\n' +
                '                            <div class="card card-border-default">\n' +
                '                                <div class="card-header">\n' +
                '                                    <a href="#" class="card-title" id="phase_title' + data.id + '">' + data.title + ' </a>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="card-block">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-sm-5">\n' +
                '                                            <p class="phase-detail"\n' +
                '                                               id="phase_start_date' + data.id + '">' + data.start_date + ' </p>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-2">\n' +
                '                                            <p class="phase-detail">{{trans('phase.to')}} </p>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-5">\n' +
                '                                            <p class="phase-detail"\n' +
                '                                               id="phase_end_date' + data.id + '"> ' + data.end_date + ' </p>\n' +
                '                                        </div>\n' +
                '                                        <!-- end of col-sm-8 -->\n' +
                '    <div class="row">\n' +
                '                                        <div class="col-sm-12">\n' +
                '                                            <p class="task-detail task_description"\n' +
                '                                               id="phase_description' + data.id + '">' + data.description + ' </p>\n' +
                '\n' +
                '                                        </div>\n' +
                '                                        <!-- end of col-sm-8 -->\n' +
                '                                    </div>' +
                '                                    </div>\n' +
                '                                    <!-- end of row -->\n' +
                '                                </div>\n' +
                '\n' +
                '<div class="card-footer">\n' +
                '                                    <a class="btn btn-primary btn-add-phase waves-effect waves-light m-t-10"\n' +
                '                                       href="{{HostUrl('')}}/phases/' + data.id + '"><i class="icofont icofont-plus"></i>\n' +
                {{--'                                       href="{{route('phases.show',$phase->id)}}"><i class="icofont icofont-plus"></i>\n' +--}}
                    ' {{trans('menu.tasks')}}</a>\n' +
                '                                    <div class="task-board">\n' +
                '                                    {!!Form ::select('status', getAllPhaseStatus(),null,['class' => 'select2 dropdown-secondary dropdown', 'id' => 'status'])!!}\n' +
                '\n' +
                '                                    <!-- end of dropdown-secondary -->\n' +
                '                                        <div class="dropdown-secondary dropdown">\n' +
                '                                            <button\n' +
                '                                                class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"\n' +
                '                                                type="button" id="dropdown3" data-toggle="dropdown" aria-haspopup="true"\n' +
                '                                                aria-expanded="false"><i class="icofont icofont-navigation-menu"></i>\n' +
                '                                            </button>\n' +
                '                                            <div class="dropdown-menu" aria-labelledby="dropdown3"\n' +
                '                                                 data-dropdown-in="fadeIn"\n' +
                '                                                 data-dropdown-out="fadeOut">\n' +
                '                                                <div class="dropdown-divider"></div>\n' +
                '                                                <a class="dropdown-item waves-light waves-effect editphase"\n' +
                '                                                   data-id="' + data.id + '" href="#!"><i\n' +
                '                                                        class="icofont icofont-ui-edit"></i> {{trans('form.update.phase')}} </a>\n' +
                '                                                <a class="dropdown-item waves-light waves-effect remove_phase"\n' +
                '                                                   data-id="' + data.id + '" href="#!"><i\n' +
                '                                                        class="icofont icofont-close-line"></i>\n' +
                '                                                    {{trans('form.delete.phase')}}</a>\n' +
                '                                            </div>\n' +
                '                                            <!-- end of dropdown menu -->\n' +
                '                                        </div>\n' +
                '                                        <!-- end of seconadary -->\n' +
                '                                    </div>\n' +
                '                                    <!-- end of pull-right class -->\n' +
                '                                </div>' +
                '                                    <!-- end of pull-right class -->\n' +
                '                                </div>\n' +
                '                                <!-- end of card-footer -->\n' +
                '                            </div>\n' +
                '                        </div>\n';

            $('#phases_div').html(newphase + $('#phases_div').html());

        }

        $(document).on('click', '#new_phase_btn', function () {
            var type = $(this).attr('btn_type');
            var formData = $('#new_phase_form').serialize();

            // $('#NewphaseModal').modal('hide');
            $(".print-error-msg").html('');
            $.ajax({
                url: "{{route('phases.store')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data.phase);
                    if (type == 'new')
                        newphase(data.phase);
                    else
                        editphase(data.phase);

                    $('#NewphaseModal').modal('hide');
                    $('#new_phase_form')[0].reset();
                },
                error: function (jqXhr, status) {
                    if (jqXhr.status === 422) {
                        $(".alert-danger").css("display", "block");
                        $("#new_phase_form .print-error-msg").html('');
                        $("#new_phase_form .print-error-msg").show();
                        var errors = jqXhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            if (key == 'error') {
                                $("#new_phase_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                            }
                            $("#new_phase_form").find("#error_phase_" + key).html(value);
                        });
                    }
                }

            });


        });

        $(document).on('click', '.remove_phase', function () {
            var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&phase_id=' + encodeURIComponent($(this).data('id'));
            $(".print-error-msg").html('');
            $.ajax({
                url: "{{route('phases.remove')}}",
                type: 'POST',
                data: data,
                success: function (data) {
                    toastr.success('تم   حذف المهمة  بنجاح');
                    $('#phase_' + data.phase_id).remove();
                    console.log(data);
                },
                error: function (jqXhr, status) {
                    if (jqXhr.status === 422) {
                        $(".alert-danger").css("display", "block");
                        $("#new_phase_form .print-error-msg").html('');
                        $("#new_phase_form .print-error-msg").show();
                        var errors = jqXhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            if (key == 'error') {
                                $("#new_phase_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                            }
                            $("#new_phase_form").find("#error_phase_" + key).html(value);
                        });
                    }
                }

            });


        });


    </script>

@endsection





@section('styles')
    <style>
        .task_description {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            display: inherit;
        }
    </style>
    <link href="{{HostUrl('design\bower_components\select2\css\select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\advance-elements\css\bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\datedropper\css\datedropper.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\bootstrap-multiselect\css\bootstrap-multiselect.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\multiselect\css\multi-select.css')}}">
@endsection



