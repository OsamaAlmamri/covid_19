@extends('layout')
@section('breadcrumb')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <div class="d-inline">
                        <h4>{{trans('menu.tasks')}}</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"> <i class="fa fa-home"></i> {{trans('menu.home')}} </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">{{$phase->title}}</a>
                        <li class="breadcrumb-item"><a href="#!">{{trans('menu.tasks')}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

    <div class="page-body">
        <div class="row">
            <!-- Right column start -->
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
                            <div class="task-right-header-status">
                                <span
                                    data-toggle="collapse">approved Status {{$progress['approved']}} / {{$progress['all']}}</span>
                                <div class="faq-progress">
                                    <div class="progress">
                                        <div class="faq-bar3"
                                             style="width: {{getRatio($progress['approved'],$progress['all'])}}%;"></div>
                                    </div>

                                </div>
                                <i class="icofont icofont-rounded-down f-right"></i>
                            </div>
                            <!-- end of sidebar-header completed status-->
                            <div class="taskboard-right-progress">
                                <h6>Highest Priority {{$progress['very_high_complete']}}
                                    /{{$progress['very_high']}} </h6>
                                <div class="faq-progress">
                                    <div class="progress">
                                        <div class="faq-bar3"
                                             style="width: {{getRatio($progress['very_high_complete'],$progress['very_high'])}}%;"></div>
                                    </div>

                                </div>
                                <h6>High Priority {{$progress['high_complete']}}/{{$progress['high']}} </h6>

                                <div class="faq-progress">
                                    <div class="progress">
                                        <div class="faq-bar1"
                                             style="width: {{getRatio($progress['high_complete'],$progress['high'])}}%;"></div>
                                    </div>

                                </div>
                                <h6>medium Priority {{$progress['medium_complete']}}/{{$progress['medium']}} </h6>
                                <div class="faq-progress">
                                    <div class="progress">
                                        <div class="faq-bar2"
                                             style="width: {{getRatio($progress['medium_complete'],$progress['medium'])}}%;"></div>
                                    </div>

                                </div>
                                <h6>Low Priority {{$progress['low_complete']}}/{{$progress['low']}} </h6>
                                <div class="faq-progress">
                                    <div class="progress">
                                        <!-- <span class="faq-text4"></span> -->
                                        <div class="faq-bar4"
                                             style="width: {{getRatio($progress['low_complete'],$progress['low'])}}%;"></div>
                                    </div>
                                </div>

                            </div>
                            <!-- end of task-board-right progress -->
                            <!-- start task right users -->
                            <div class="task-right-header-users">
                                <span data-toggle="collapse">Assign Users</span>
                                <i class="icofont icofont-rounded-down f-right"></i>
                            </div>
                            <div class="user-box assign-user taskboard-right-users">
                                @foreach( assignUser($phase) as $user)
                                    <div class="media">
                                        <div class="media-left media-middle photo-table">
                                            <a href="#">
                                                <img class="media-object img-radius"
                                                     src="{{HostUrl($user->avatar)}}"
                                                     alt="Generic placeholder image">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h6>{{$user->name}}</h6>
                                            <p>{{$user->employee_number}}</p>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- end of task-board-right users -->
                            <div class="task-right-header-revision">
                                <span data-toggle="collapse">Revision</span>
                                <i class="icofont icofont-rounded-down f-right"></i>
                            </div>
                            <div class="taskboard-right-revision user-box">
                                @foreach($taskAppeoveds as $task)
                                    <div class="media">
                                        <div class="media-left">
                                            {{--                                            {{$task->user}}--}}
                                            <img class="media-object img-radius"
                                                 src="{{HostUrl($task->user->avatar)}}"
                                                 alt="{{$task->user->user}}"
                                            >
                                        </div>
                                        <div class="media-body">
                                            <div class="chat-header">{{$task->title}}
                                            </div>
                                            <p class="chat-header  text-muted">{{$task->updated_at}}</p>
                                        </div>
                                        <!-- end of media body -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- end of task-right-revision -->
                        </div>
                        <!-- end of sidebar-right -->
                    </div>
                    <!-- end of card-block -->
                </div>
                <!-- Search box card end -->
            </div>
            <!-- Right column end -->
            <!-- Left column start -->
            <div class="col-xl-9 col-lg-12  filter-bar">
                <!-- Nav Filter tab start -->
                <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                    <ul class="nav navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#!">Filter: <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bydate" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-clock-time"></i> By
                                Date</a>
                            <div class="dropdown-menu" aria-labelledby="bydate">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Today</a>
                                <a class="dropdown-item" href="#!">Yesterday</a>
                                <a class="dropdown-item" href="#!">This week</a>
                                <a class="dropdown-item" href="#!">This month</a>
                                <a class="dropdown-item" href="#!">This year</a>
                            </div>
                        </li>
                        <!-- end of by date dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bystatus" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i
                                    class="icofont icofont-chart-histogram-alt"></i> By Status</a>
                            <div class="dropdown-menu" aria-labelledby="bystatus">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Open</a>
                                <a class="dropdown-item" href="#!">On hold</a>
                                <a class="dropdown-item" href="#!">Resolved</a>
                                <a class="dropdown-item" href="#!">Closed</a>
                                <a class="dropdown-item" href="#!">Dublicate</a>
                                <a class="dropdown-item" href="#!">Wontfix</a>
                            </div>
                        </li>
                        <!-- end of by status dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#!" id="bypriority" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-sub-listing"></i> By
                                Priority</a>
                            <div class="dropdown-menu" aria-labelledby="bypriority">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Highest</a>
                                <a class="dropdown-item" href="#!">High</a>
                                <a class="dropdown-item" href="#!">Normal</a>
                                <a class="dropdown-item" href="#!">Low</a>
                            </div>
                        </li>
                    </ul>
                    <div class="nav-item nav-grid">

                        <a class="btn btn-primary btn-add-task waves-effect waves-light m-t-10" href="#"
                           id="show_addTask_btn"
                        ><i class="icofont icofont-plus"></i> Add New Tasks</a>

                    </div>
                    <!-- end of by priority dropdown -->

                </nav>
                <!-- Nav Filter tab end -->
                <!-- Task board design block start-->
                <div class="row" id="tasks_div">
                    @foreach($phase->tasks as $task)
                        <div class="col-sm-6" id="task_{{$task->id}}">
                            <div class="card card-border-default">
                                <div class="card-header">
                                    <h5 class="card-title" id="task_title{{$task->id}}"> {{$task->title}} </h5>
                                    {{--                                <span class="label label-success f-right">{{$task->start_date}} </span>--}}
                                </div>

                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <p class="task-detail">{{trans('task.due')}} </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="task-detail"
                                               id="task_start_date{{$task->id}}">{{dateViewFormat($task->start_date)}} </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <p class="task-detail">{{trans('task.to')}} </p>
                                        </div>
                                        <div class="col-sm-4">
                                            <p class="task-detail"
                                               id="task_end_date{{$task->id}}">{{ dateViewFormat($task->end_date) }} </p>
                                        </div>
                                        <!-- end of col-sm-8 -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="task-detail task_description"
                                               id="task_description{{$task->id}}">{{$task->description}} </p>

                                        </div>
                                        <!-- end of col-sm-8 -->
                                    </div>
                                    <!-- end of row -->
                                </div>

                                <div class="card-footer">
                                    <div class="task-list-table">
                                        <div class="task-list-table" id="task_member_view{{$task->id}}">
                                            @if($task->user)
                                                <a href="#!" data-toggle="tooltip" title="{{$task->user->name}}">
                                                    <img class="img-fluid img-radius"
                                                         src="{{HostUrl($task->user->avatar)}}" alt="1"></a>
                                            @endif
                                        </div>
                                        <a href="#!" class="show_addMember_btn" data-task_id="{{$task->id}}"><i
                                                class="fa fa-plus-square"></i></a>

                                    </div>
                                    <div class="task-board">
                                    {!!Form ::select('priority', getAllPriority(),$task->priority,['class' => 'select2 dropdown-secondary dropdown', 'id' => 'priority'])!!}
                                    {!!Form ::select('status', getAllTaskStatus(),$task->status,['class' => 'select2 dropdown-secondary dropdown task_status_list', 'data-id'=>$task->id, 'id' => 'status'])!!}

                                    <!-- end of dropdown-secondary -->
                                        <div class="dropdown-secondary dropdown">
                                            <button
                                                class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted"
                                                type="button" id="dropdown3" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="icofont icofont-navigation-menu"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown3"
                                                 data-dropdown-in="fadeIn"
                                                 data-dropdown-out="fadeOut">
                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i
                                                        class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect editTask"
                                                   data-id="{{$task->id}}" href="#!"><i
                                                        class="icofont icofont-ui-edit"></i> Edit task</a>
                                                <a class="dropdown-item waves-light waves-effect remove_task"
                                                   data-id="{{$task->id}}" href="#!"><i
                                                        class="icofont icofont-close-line"></i>
                                                    Remove</a>
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
                </div>
                <!-- Task board design block end -->
            </div>
            <!-- Left column end -->
        </div>
    </div>



    <div class="modal fade " id="NewTaskModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel"> {{trans('task.add')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="new_task_form">
                        @csrf
                        <input type="hidden" name="phase_id" value="{{$phase->id}}">
                        <div class="row">
                            <label class="col-sm-12 col-form-label"> {{trans('task.title')}} </label>
                            <div class="col-sm-12">
                                <textarea name="title" class="form-control save_task_todo" rows="2"
                                          id="form_task_title"> </textarea>
                                <div class="print-error-msg alert-danger"
                                     id="error_task_title"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-3 col-form-label">{{trans('task.priority_label')}}</label>

                            <div class="col-sm-9">
                                {!!Form ::select('priority', getAllPriority(),null,['class' => 'select2 form-control', 'id' => 'priority form_task_priority'])!!}
                                <div class="print-error-msg alert-danger"
                                     id="error_task_priority"></div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <label class="col-xl-3 col-form-label">{{trans('task.period')}}</label>

                            <div class="col-sm-12 col-xl-9">
                                <div class="input-daterange input-group" id="datepicker">
                                    {!! Form::text('start_date',  isset($phase)?dateFormat($phase->start_date):null, [ 'id' => 'form_task_start_date' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.start_date')]) !!}

                                    <span class="input-group-addon">to</span>
                                    {!! Form::text('end_date',  isset($phase)?dateFormat($phase->end_date):null, [ 'id' => 'form_task_end_date' ,'class'=>'input-sm form-control','placeholder'=>trans('form.project.end_date')]) !!}

                                </div>
                                <div class="print-error-msg alert-danger"
                                     id="error_task_end_date"></div>
                                <div class="print-error-msg alert-danger"
                                     id="error_task_end_date"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-12 col-form-label">{{trans('task.description')}}</label>
                            <div class="col-sm-12">
                                <textarea name="description" class="form-control save_task_todo" rows="7"
                                          id="form_task_description"> </textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="save_btn btn btn-primary"
                            id="new_task_btn">{{trans('form.save')}}</button>
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
                        <input type="hidden" name="task_id" id="form_member_task_id">

                        <div class="row">
                            <div class="col-sm-12 col-xl-12 m-b-30">
                                <h4 class="sub-title">{{trans('project.team')}}</h4>
                                {!!Form ::select('user_id', getProjectTeams($phase->project),null,['class' => 'select3 form-control','id' => 'custom-headers'])!!}
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

@endsection





@section('js')
    <script src="{{HostUrl('design/bower_components/select2/js/select2.full.min.js')}}"></script>
    <script src="{{HostUrl('design\bower_components\select2\dist\js\select2.full.min.js')}}"></script>
    <script type="text/javascript"
            src="{{HostUrl('design\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js')}}"></script>

    <script type="text/javascript"
            src="{{HostUrl('design\bower_components\datedropper\js\datedropper.min.js')}}"></script>


    <script type="text/javascript" src="{{ asset('design/custom/dropify/dist/js/dropify.min.js') }}"></script>


    <script>


        $(document).on('click', '#btn_teme_member', function () {

            var data = '_token=' + encodeURIComponent("{{csrf_token()}}")
                + '&user=' + encodeURIComponent($('#custom-headers').val())
                + '&task=' + encodeURIComponent($('#form_member_task_id').val());


            $.ajax({
                url: "{{route('tasks.member')}}",
                type: 'POST',
                data: data,
                success: function (data) {
                    $("#task_member_view" + $('#form_member_task_id').val()).html(data.user)
                    toastr.success('تم التعديل بنجاح');
                    console.log(data.user);
                    $('#NewMemberModal').modal('hide');
                },
                error: function (jqXhr, status) {

                }

            });


        });
        $(document).on('click', '.show_addMember_btn', function () {

            $('#form_member_task_id').val($(this).data('task_id'));
            $('#NewMemberModal').modal('show');
        });


        $('.input-daterange input').each(function () {
            $(this).datepicker();
        });
        $('#sandbox-container .input-daterange').datepicker({
            todayHighlight: true
        });


        $(document).on('click', '.editTask', function () {

            $('#form_task_id').remove();
            $('#new_task_form')[0].reset();
            var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&task_id=' + encodeURIComponent($(this).data('id'));

            $.ajax({
                url: "{{route('tasks.getTaskDeatial')}}",
                type: 'POST',
                data: data,
                success: function (data) {

                    console.log(data);
                    // toastr.success('تم اضافة  المهمة  بنجاح');
                    $('#NewTaskModal').modal('show');
                    $('#new_task_btn').attr('btn_type', 'edit');

                    $('#new_task_form').append('<input type="hidden" id="form_task_id" name="task_id" value="' + data.id + '">');
                    $('#form_task_title').val(data.title);
                    $('#form_task_description').val(data.description);
                    $('#form_task_start_date').val(data.start_date);
                    $('#form_task_end_date').val(data.end_date);
                    $('#form_task_status').val(data.status);
                    $('#form_task_priority').val(data.priority);
                },
                error: function (jqXhr, status) {

                }

            });


        });

        $(document).on('change', '.task_status_list', function () {

            var data = '_token=' + encodeURIComponent("{{csrf_token()}}")
                + '&task_id=' + encodeURIComponent($(this).data('id'))
                + '&newStatus=' + encodeURIComponent($(this).val());

            $.ajax({
                url: "{{route('tasks.changeStatus')}}",
                type: 'POST',
                data: data,
                success: function (data) {
                    console.log(data);
                    toastr.success('تم تغيير حالة   المهمة  بنجاح');
                },
                error: function (jqXhr, status) {

                }

            });


        });

        $(document).on('click', '#show_addTask_btn', function () {

            $('#form_task_id').remove();
            $('#new_task_btn').attr('btn_type', 'new');
            $('#new_task_form')[0].reset();
            $('#NewTaskModal').modal('show');


        });

        function editTask(data) {

            // $('#task_title'+data.id).val(data.type);
            $('#task_title' + data.id).remove();
            $('#task_description' + data.id).html(data.description);
            $('#task_start_date' + data.id).html(data.start_date);
            $('#task_end_date' + data.id).html(data.end_date);
            $('#task_status' + data.id).html(data.status);
            $('#task_priority' + data.id).html(data.priority);
            toastr.success('تم تعديل  المهمة  بنجاح');
        }

        function newTask(data) {
            toastr.success('تم اضافة  المهمة  بنجاح');
            // '     \n' +

            var newTask = '                        <div class="col-sm-6">\n' +
                '                            <div class="card card-border-default">\n' +
                '                                <div class="card-header">\n' +
                '                                    <a href="#" class="card-title" id="task_title' + data.id + '">' + data.title + ' </a>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="card-block">\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-sm-5">\n' +
                '                                            <p class="task-detail"\n' +
                '                                               id="task_start_date' + data.id + '">' + data.start_date + ' </p>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-2">\n' +
                '                                            <p class="task-detail">{{trans('task.to')}} </p>\n' +
                '                                        </div>\n' +
                '                                        <div class="col-sm-5">\n' +
                '                                            <p class="task-detail"\n' +
                '                                               id="task_end_date' + data.id + '"> ' + data.end_date + ' </p>\n' +
                '                                        </div>\n' +
                '                                        <!-- end of col-sm-8 -->\n' +
                '                                    </div>\n' +
                '                                    <!-- end of row -->\n' +
                '                                    <div class="row">\n' +
                '                                        <div class="col-sm-12">\n' +
                '                                            <p class="phase-detail task_description"\n' +
                '                                               id="phase_description' + data.id + '"> ' + data.description + '  </p>\n' +

                '                                        </div>\n' +
                '                                        <!-- end of col-sm-8 -->\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '\n' +
                '                                <div class="card-footer">\n' +
                '                                    <div class="task-list-table">\n' +
                '                                        <a href="#!" class="show_addMember_btn"><i class="fa fa-plus-square"></i></a>\n' +
                '                                    </div>\n' +
                '                                    <div class="task-board">\n' +
                '                                    {!!Form ::select('priority', getAllPriority(),null,['class' => 'select2 dropdown-secondary dropdown', 'id' => 'priority'])!!}\n' +
                '                                    {!!Form ::select('status', getAllTaskStatus(),null,['class' => 'select2 dropdown-secondary dropdown', 'id' => 'status'])!!}\n' +
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
                '                                                <a class="dropdown-item waves-light waves-effect" href="#!"><i\n' +
                '                                                        class="icofont icofont-spinner-alt-5"></i> Reassign</a>\n' +
                '                                                <div class="dropdown-divider"></div>\n' +
                '                                                <a class="dropdown-item waves-light waves-effect editTask"\n' +
                '                                                   data-id="' + data.id + '" href="#!"><i\n' +
                '                                                        class="icofont icofont-ui-edit " ></i> Edit task</a>\n' +
                '                                                <a class="dropdown-item waves-light waves-effect remove_task"   data-id="' + data.id + '"  href="#!"><i\n' +
                '                                                        class="icofont icofont-close-line"></i> Remove</a>\n' +
                '                                            </div>\n' +
                '                                            <!-- end of dropdown menu -->\n' +
                '                                        </div>\n' +
                '                                        <!-- end of seconadary -->\n' +
                '                                    </div>\n' +
                '                                    <!-- end of pull-right class -->\n' +
                '                                </div>\n' +
                '                                <!-- end of card-footer -->\n' +
                '                            </div>\n' +
                '                        </div>\n';

            $('#tasks_div').html(newTask + $('#tasks_div').html());

        }

        $(document).on('click', '#new_task_btn', function () {


            var type = $(this).attr('btn_type');
            var formData = $('#new_task_form').serialize();

            // $('#NewTaskModal').modal('hide');
            $(".print-error-msg").html('');
            $.ajax({
                url: "{{route('tasks.store')}}",
                type: 'POST',
                data: formData,
                success: function (data) {
                    console.log(data.task);
                    if (type == 'new')
                        newTask(data.task);
                    else
                        editTask(data.task);

                    $('#NewTaskModal').modal('hide');
                    $('#new_task_form')[0].reset();
                },
                error: function (jqXhr, status) {
                    if (jqXhr.status === 422) {
                        $(".alert-danger").css("display", "block");
                        $("#new_task_form .print-error-msg").html('');
                        $("#new_task_form .print-error-msg").show();
                        var errors = jqXhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            if (key == 'error') {
                                $("#new_task_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                            }
                            $("#new_task_form").find("#error_task_" + key).html(value);
                        });
                    }
                }

            });


        });

        $(document).on('click', '.remove_task', function () {
            var data = '_token=' + encodeURIComponent("{{csrf_token()}}") + '&task_id=' + encodeURIComponent($(this).data('id'));
            $(".print-error-msg").html('');
            $.ajax({
                url: "{{route('tasks.remove')}}",
                type: 'POST',
                data: data,
                success: function (data) {
                    toastr.success('تم   حذف المهمة  بنجاح');
                    $('#task_' + data.task_id).remove();
                    console.log(data);
                },
                error: function (jqXhr, status) {
                    if (jqXhr.status === 422) {
                        $(".alert-danger").css("display", "block");
                        $("#new_task_form .print-error-msg").html('');
                        $("#new_task_form .print-error-msg").show();
                        var errors = jqXhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            if (key == 'error') {
                                $("#new_task_form .common").find('ul').removeClass('alert-success').addClass('alert-danger');
                            }
                            $("#new_task_form").find("#error_task_" + key).html(value);
                        });
                    }
                }

            });


        });


    </script>
    <script>
        $(function () {
            $('.select2bs4').select3({
                theme: 'bootstrap4'
            })

            //Initialize Select2 Elements
            $('.select3').select2()

            //Initialize Select2 Elements
            $('.select3').select2()
        })

    </script>
@endsection





@section('styles')
    <link href="{{HostUrl('design\bower_components\select2\css\select2.min.css')}}" rel="stylesheet">


    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\assets\pages\advance-elements\css\bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ HostUrl('design\bower_components\datedropper\css\datedropper.min.css')}}">

@endsection



