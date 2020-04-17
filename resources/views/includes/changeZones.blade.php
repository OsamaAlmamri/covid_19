<script>
    function getZones(select_list,zone_list) {
        $(document).on('change', '#'+select_list, function () {
            var zone = $('#' + zone_list);
            var _this = $(this);
            $.ajax({
                url: '/zones/getZones',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("{{csrf_token()}}") + '&id=' + _this.val(),
                success: function (data) {
                    zone.html(data.data);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return (false);
        });

    }
</script>
