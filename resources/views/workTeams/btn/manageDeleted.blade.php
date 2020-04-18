<div class="manage_btns">
    <a href="{{  route('workTeams.restore',encrypt( $id)) }}"
     ><i class="fa fa-arrow-up"></i></a>

    <a href="{{route('workTeams.forceDelete',encrypt( $id))}}"
       onclick="return confirm('هل أنت متأكد من الحذف');" ><i
            class="fa fa-trash"></i></a>
</div>

