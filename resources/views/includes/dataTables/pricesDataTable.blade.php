<script>
    $(document).ready(function () {

        // load_data(1, 5);
        var firstTime = 0;

        function load_data(from_zone, to_zone) {
            $('#orderdata').DataTable({
                    processing: true,
                    // serverSide: true,
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
                    lengthMenu: [[50, 100, -1], [50, 100, 'all']],
                    buttons:
                        [
                                {{--                                @if (Auth::user()->can('manage prices') == true)--}}
                                {{--                            {--}}
                                {{--                                className: 'btn btn-info ',--}}
                                {{--                                text: '<i class="fa fa-plus" ></i> Update Prices',--}}
                                {{--                                action: function () {--}}
                                {{--                                    window.location.href = '/admin/prices/create/$this->account_id'--}}
                                {{--                                },--}}
                                {{--                            },--}}
                                {{--                                @endif--}}

                                {{--                            {--}}
                                {{--                                extend: 'copyHtml5',--}}
                                {{--                                text: '<i class="fa fa-copy" ></i> copy',--}}
                                {{--                                className: 'btn btn-info '--}}
                                {{--                            },--}}
                                {{--                            {--}}
                                {{--                                extend: 'excelHtml5',--}}
                                {{--                                text: '<i class="fa fa-file-excel-o" ></i> Excel',--}}
                                {{--                                className: 'btn btn-info '--}}
                                {{--                            },--}}
                                {{--                            {--}}
                                {{--                                extend: 'pdfHtml5',--}}
                                {{--                                text: '<i class="fa fa-file-pdf-o" ></i> PDF',--}}
                                {{--                                className: 'btn btn-info '--}}
                                {{--                            },--}}
                                {{--                            {--}}
                                {{--                                extend: 'print',--}}
                                {{--                                text: '<i class="fa fa-print" ></i> Print',--}}
                                {{--                                className: 'btn btn-info '--}}
                                {{--                            }--}}
                                {{--                            @if (Auth::user()->can('manage prices') == true)--}}
                                {{--                            ,--}}
                            {
                                // extend: '',
                                text: '<i class="fa fa-save" ></i>',
                                className: 'btn btn-info UpdateBtn'
                            },
                            {{--                            @endif--}}
                        ],
                    ajax:
                        {
                            url: '{{ route("admin.prices.filter2") }}',
                            data:
                                {
                                    _token: "{{csrf_token()}}",
                                    from: from_zone,
                                    to: to_zone,
                                }

                        }
                    ,
                    //   => {#709 ▼
                    // +"id": 2
                    //           +"from": 1
                    //           +"to": 6
                    //           +"price": 1000.0
                    //           +"type": "ton"
                    //           +"road": "صنعاء"
                    //           +"note": null
                    //           +"status": 0
                    //           +"created_by": 1
                    //           +"updated_by": 1
                    //           +"deleted_by": null
                    //           +"deleted_at": null
                    //           +"created_at": null
                    //           +"updated_at": null
                    //           +"zone_name_ar": "بيت الفقيةbjbj"
                    //           +"zone_name_en": "بيت الفقية"
                    columns: [
                        {
                            title: '#',
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false

                        },

                        {
                            title: 'Pzone_name_ar',
                            data: 'Pzone_name_ar',
                            name: 'Pzone_name_ar'
                        },
                        {
                            title: 'zone_name_ar',
                            data: 'zone_name_ar',
                            name: 'zone_name_ar'
                        },
                        {
                            title: 'price',
                            data: 'price',
                            name: 'price',
                            class: 'price'
                        }
                        ,
                        {
                            title: 'note',
                            data: 'note',
                            name: 'note'
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
            var from = $('#from_zone').val();
            var to = $('#to_zone').val();
            $('#from_zone_idInput').val(from);


            if (from != '' && to != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(from, to);
            } else {
                alert('Both Input is required');
            }
        }

        $('#from_zone').change(function () {
            ChangeInput();

        });

        $('#to_zone').change(function () {

            ChangeInput();
        });


        // $('#refresh').click(function () {
        //     $('#from_date').val('');
        //     $('#to_date').val('');
        //     $('#orderdata').DataTable().destroy();
        //     load_data();
        // });

    })
    ;
</script>
