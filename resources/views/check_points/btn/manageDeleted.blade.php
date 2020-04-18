<div class="manage_btns">
    <a href="{{  route('check_points.restore',encrypt( $id)) }}"
     ><i class="fa fa-arrow-up"></i></a>

    <a href="{{route('check_points.forceDelete',encrypt( $id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');" ><i
            class="fa fa-trash"></i></a>
</div>

