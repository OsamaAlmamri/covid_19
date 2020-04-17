{{--<a href="{{aurl('admin/'.$id.'/edit')}}" class="btn btn-info"> <i class="fa fa-edit"></i> </a>--}}
<a href="{{ route('projects.show', $id) }}" class="btn btn-primary"> <i class="fa fa-eye"></i> </a>

<a href="{{ route('tasks.table', $id) }}" class="btn btn-primary"> <i class="fa fa-table"></i> </a>
