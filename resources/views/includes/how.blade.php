{{--<script>--}}
    function how(what,description,type) {
        var data = '_token=' + encodeURIComponent("{{csrf_token()}}") +
            '&what=' + encodeURIComponent(what)+  '&type=' + encodeURIComponent(type)+'&description=' + encodeURIComponent(description);
        var _this = $(this);
        $.ajax({
            url: '{{route('logs.how')}}',//   var url=$('#news').attr('action');
            method: 'post',
            dataType: 'json',// data type that i want to return
            data: data,// var form=$('#news').serialize();
            success: function (data) {
            },
            error: function (xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    }
{{--</script>--}}
