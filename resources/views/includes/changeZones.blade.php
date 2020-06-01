<script>
    function getZones(select_list, zone_list, zone_type = 'district', type = 'noAll') {
        $(document).on('change', '#' + select_list, function () {
            var zone = $('#' + zone_list);
            var _this = $(this);
            $.ajax({
                url: '<?php echo e(route('zones.getZones')); ?>',//   var url=$('#news').attr('action');
                method: 'POST',
                dataType: 'json',// data type that i want to return
                data: '_token=' + encodeURIComponent("<?php echo e(csrf_token()); ?>") +
                    '&id=' + _this.val() + '&zone_type=' + zone_type + '&type=' + type,
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
<?php /**PATH E:\sites\covid_19\resources\views/includes/changeZones.blade.php ENDPATH**/ ?>
