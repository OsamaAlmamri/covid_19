<a data-id="{{$id}}"
        data-status="{{$status}}"
        class="active"
>
    @if($status==1)
{{--        enabled--}}
        <i class="fa fa-eye"> </i>
    @else
{{--        disabled--}}
        <i class="fa fa-eye-slash"> </i>
    @endif
</a>
