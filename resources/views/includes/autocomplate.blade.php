<script>
    function autoComplate(input_name,request_name, dev_id, url, lable) {
        $('input[name=' + input_name + ']').autocomplete({
            'source': function (request, response) {
                $.ajax({
                    url: url,
                    dataType: 'json',
                    method: 'post',
                    data: '_token=' + encodeURIComponent("{{csrf_token()}}") + '&filter_name=' + encodeURIComponent(request['term']),
                    success: function (json) {
                        console.log(json);
                        response($.map(json, function (item) {
                            return {
                                label: item[lable],
                                value: item['id']
                            }
                        }));
                    }, error: function (err) {
                        console.log(err);
                    }
                });
            },
            'select': function (item, ui) {
                item = ui.item;


                $('#' + dev_id + item['value']).remove();
                $('#' + dev_id).html('');
                $('#' + dev_id).append('<div id="' + dev_id + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="' + request_name + '" value="' + item['value'] + '" /></div>');
                $('input[name=' + input_name + ']').val(item['label']);
            }
        });

        $('#' + dev_id).delegate('.fa-minus-circle', 'click', function () {
            $(this).parent().remove();
        });

    }

</script>
