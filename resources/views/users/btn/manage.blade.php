<div class="manage_btns">
    <a href="{{ route('users.edit', $id) }}"><i class="fa fa-pencil"></i></a>
    <a href="{{route('users.delete',encrypt( $id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');"><i class="fa fa-trash"></i></a>
</div>

