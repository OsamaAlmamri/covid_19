0
<script>
    $(document).ready(function () {
        // load_data(1, 5);
        var firstTime = 0;

        // ChangeInput();
        function load_data(government, zone, from_date, to_date, gender, workTeamType) {
            $('#orderdata').DataTable({
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
                            url: '{{route("check_points.filterTeam")}}',
                            method: 'post',
                            dataType: 'json',// data type that i want to return
                            data:
                                {
                                    _token: "{{csrf_token()}}",
                                    government: government,
                                    zone: zone,
                                    from_date: from_date,
                                    to_date: to_date,
                                    gender: gender,
                                    workTeamType: workTeamType,
                                },
                        }
                    ,

                    columns: [
                        {
                            title: '#',
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false

                        },
                        {
                            'name': 'name',
                            'data': 'name',
                            'title': '{{trans('dataTable.name')}}',
                        },
                        {
                            'name': 'gender',
                            'data': 'gender',
                            'title': '{{trans('dataTable.gender')}}',
                        },

                        {
                            'name': 'job',
                            'data': 'job',
                            'title': "{{trans('dataTable.job')}}",
                        },
                        {
                            'name': 'country',
                            'data': 'country',
                            'title': "{{trans('dataTable.country')}}",
                        },
                        {
                            'name': 'government_name',
                            'data': 'government_name',
                            'title': "{{trans('dataTable.government_name')}}",
                        },
                        {
                            'name': 'zone_name',
                            'data': 'zone_name',
                            'title': "{{trans('dataTable.zone_name')}}",
                        },
                        {
                            'name': 'join_date',
                            'data': 'join_date',
                            'title': "{{trans('dataTable.join_date')}}",
                        },
                        {
                            'name': 'birth_date',
                            'data': 'birth_date',
                            'title': "{{trans('dataTable.birth_date')}}",
                        },
                        {
                            'name': 'phone',
                            'data': 'phone',
                            'title': "{{trans('dataTable.phone')}}",
                        },
                        {
                            'name': 'assign',
                            'data': 'assign',
                            'title': "{{trans('dataTable.assign')}}",
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
            var government = $('#search_government_id').val();
            var zone = $('#search_zone_id').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var gender = $('#gender').val();
            var workTeamType = $('#workTeamType').val();
            if (government != '' && zone != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(government, zone, from_date, to_date, gender, workTeamType);

            } else {
                alert('Both Input is required');
            }
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
