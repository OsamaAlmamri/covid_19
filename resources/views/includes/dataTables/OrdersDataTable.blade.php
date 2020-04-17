0
<script>
    $(document).ready(function () {

        // load_data(1, 5);
        var firstTime = 1;

        // ChangeInput();

        function load_data(type,from_zone, to_zone, from_date, to_date, status) {
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
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, 'all']],
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
                            url: '{{ route("admin.orders.filter2") }}',
                            data:
                                {
                                    _token: "{{csrf_token()}}",
                                    from_zone: from_zone,
                                    to_zone: to_zone,
                                    from_date: from_date,
                                    to_date: to_date,
                                    status: status,
                                    type: type,
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
                            title: '{{trans('order.orderN')}}',
                            data: 'id',
                            name: 'id'
                        },
                        {
                            title: '{{trans('order.user')}}',
                            data: 'user_name',
                            name: 'user_name'
                        },
                        @if($type!='post')
                        {
                            title: '{{trans('order.customer')}}',
                            data: 'customer_name',
                            name: 'customer_name',
                        },
                        @endif
                        {
                            title: '{{trans('order.from')}}',
                            data: 'from_zone',
                            name: 'from_zone'
                        },
                        {
                            title: '{{trans('order.to')}}',
                            data: 'to_zone',
                            name: 'to_zone'
                        },

                        {
                            title: '{{trans('order.orderStatus')}}',
                            data: 'status',
                            name: 'status',
                        }, {
                            title: '{{trans('order.ton')}}',
                            data: 'ton',
                            name: 'ton'
                        },
                        {
                            title: '{{trans('order.goods_type')}}',
                            data: 'goods_type',
                            name: 'goods_type'
                        },

                        {
                            title: '{{trans('order.created_at')}}',
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            title: '{{trans('order.delivery_date')}}',
                            data: 'delivery_date',
                            name: 'delivery_date'
                        },
                        {
                            title: '{{trans('order.note')}}',
                            data: 'note',
                            name: 'note'
                        }, {
                            title: '{{trans('order.delivery_address')}}',
                            data: 'delivery_address',
                            name: 'delivery_address',
                        }
                        ,
                        {
                            title: '{{trans('order.goods_address')}}',
                            data: 'goods_address',
                            name: 'goods_address'
                        },

                        {
                            title: '{{trans('order.show')}}',
                            data: 'show',
                            name: 'show'
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
            var from_zone = $('#from_zone').val();
            var to_zone = $('#to_zone').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            var status = $('#filter_status').val();
            var type = '{{$type}}';
            // $('#from_zone_idInput').val(from);


            if (from_zone != '' && to_zone != '') {
                if (firstTime != 0)
                    $('#orderdata').DataTable().destroy();
                firstTime = 1;
                load_data(type,from_zone, to_zone, from_date, to_date, status);

            } else {
                alert('Both Input is required');
            }
        }

        // $('#from_zone').change(function () {
        //     ChangeInput();
        //
        // });
        //
        // $('#to_zone').change(function () {
        //
        //     ChangeInput();
        // });


        // $('#refresh').click(function () {
        //     $('#from_date').val('');
        //     $('#to_date').val('');
        //     $('#orderdata').DataTable().destroy();
        //     load_data();
        // });

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        load_data('all', 'all', today, today, 'all');

    })
    ;
</script>
