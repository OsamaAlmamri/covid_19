<div class="manage_btns">
    <a href="{{ route('quarantines.edit', $id) }}"><i class="fa fa-pencil"></i></a>
    <a href="{{route('quarantines.delete',encrypt( $id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');"><i class="fa fa-trash"></i></a>
</div>

