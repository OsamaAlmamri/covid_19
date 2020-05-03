<script>
    $(document).ready(function () {
        // load_data(1, 5);
        var firstTime = 0;

        // ChangeInput();
        function load_data(type, from_date, to_date) {
            $('#orderdata').DataTable(
                {
                    processing: true,
                    serverSide: true,
                    paging: true,
                    scrollX: true,
                    // responsive: true,
                    searching: true,
                    search: [
                        regex => true,
                    ],
                    info: false,
                    searchDelay: 350,
//                    'language' : ['url' : HostUrl('js/dataTables/language.json')],
                    dom: 'Blfrtip',
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
                    buttons:
                        [
                            {
                                extend: 'copyHtml5',
                                text: '<i class="fa fa-copy" ></i> copy',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o" ></i> Excel',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf-o" ></i> PDF',
                                className: 'btn btn-info '
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print" ></i> Print',
                                className: 'btn btn-info '
                            }
                        ],
                    ajax:
                        {
                            url: '{{route("logs.filter")}}',
                            method: 'post',
                            dataType: 'json',// data type that i want to return
                            data:
                                {
                                    _token: "{{csrf_token()}}",
                                    type: type,
                                    from_date: from_date,
                                    to_date: to_date,
                                },
                        },
                    columns: [
                        {
                            title: '#',
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            'name': 'work_team_name',
                            'data': 'work_team_name',
                            'title': '{{trans('dataTable.name')}}',
                        },
                        {
                            'name': 'username',
                            'data': 'username',
                            'title': '{{trans('dataTable.username')}}',
                        },
                        {
                            'name': 'email',
                            'data': 'email',
                            'title': '{{trans('dataTable.email')}}',
                        },
                        {
                            'name': 'phone',
                            'data': 'phone',
                            'title': '{{trans('dataTable.how_phone')}}',
                        },
                        {
                            'name': 'name',
                            'data': 'name',
                            'title': '{{trans('dataTable.file_type')}}',
                        },
                        {
                            'name': 'description',
                            'data': 'description',
                            'title': "{{trans('dataTable.log_description')}}",
                        },
                        {
                            'name': 'created_at',
                            'data': 'created_at',
                            'title': "{{trans('dataTable.log_created_at')}}",
                        },
                    ]
                }
            )
            ;
        }

        $('#filter').click(function () {

            ChangeInput();
        });

        function ChangeInput() {
            var type = $('#reports_type').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();


            if (firstTime != 0)
                $('#orderdata').DataTable().destroy();
            firstTime = 1;
            load_data(type, from_date, to_date);


        }

        // var today = new Date();
        // var dd = String(today.getDate()).padStart(2, '0');
        // var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        // var yyyy = today.getFullYear();
        // today = yyyy + '-' + mm + '-' + dd;
        // load_data('all', 'all', today, today, 'male', 'point');

    })
    ;
</script>
