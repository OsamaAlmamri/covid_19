<div class="manage_btns">
    <a href="{{ route('check_points.edit', $id) }}"><i class="fa fa-pencil"></i></a>
    <a href="{{route('check_points.delete',encrypt( $id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');"><i class="fa fa-trash"></i></a>
</div>

