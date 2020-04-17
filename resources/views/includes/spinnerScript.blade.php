<script>

    $('#loadingDiv').hide().ajaxStart(function () {
        $(this).show();  // show Loading Div
    }).ajaxStop(function () {
        $(this).hide(); // hide loading div
    });
    $(document).ajaxStart(function () {
        $("#loadingDiv").show();
    });

    $(document).ajaxStop(function () {
        $("#loadingDiv").hide();
    });
</script>
