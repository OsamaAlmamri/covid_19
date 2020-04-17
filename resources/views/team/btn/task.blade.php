{{--<a href="{{aurl('admin/'.$id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>--}}
<a href="{{route('tasks.staffTasks',['project'=>$project_id,'user'=>$user_id])}}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a>
