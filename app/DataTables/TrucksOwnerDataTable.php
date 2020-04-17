<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class TrucksOwnerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $type;

    public function __construct($type = "")
    {
        $this->type = $type;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('image', 'admin.customers.trucksBtn.image')
            ->rawColumns([
                'image',
            ]);
    }


    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('customers')
//                ->leftJoin('admins', 'customers.created_by', '=', 'admins.id')
                ->leftJoin('zones', 'customers.current_location', '=', 'zones.id')
                ->leftJoin('trucks', 'customers.truck_id', '=', 'trucks.id')
                ->select('customers.name', 'customers.phone', 'customers.status', 'customers.created_by as ', 'customers.attester_1_id', 'customers.attester_2_id', 'customers.current_location', 'customers.governorate_id', 'customers.zone_id',
                    'zones.name_ar as zone_current_location_ar', 'zones.name_en as zone_current_location_en',
                    'trucks.*'/*, 'admins.name as created_by_name'*/)
                ->WhereNull('customers.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('customers')
                ->leftJoin('admins', 'customers.deleted_by', '=', 'admins.id')
                ->leftJoin('zones', 'customers.current_location', '=', 'zones.id')
                ->leftJoin('trucks', 'customers.truck_id', '=', 'trucks.id')
                ->select('customers.name', 'customers.phone', 'customers.status', 'customers.created_by as ', 'customers.attester_1_id', 'customers.attester_2_id', 'customers.current_location', 'customers.governorate_id', 'customers.zone_id',
                    'zones.name_ar as zone_current_location_ar', 'zones.name_en as zone_current_location_en',
                    'trucks.*', 'admins.name as deleted_by_name')
                ->WhereNotNull('customers.deleted_at')
                ->orderByDesc('id')->get();

        return $data;

    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            //  ->addAction(['width' => '80px'])
            //  ->parameters($this->getBuilderParameters());
            ->parameters(
                [
                    'paging' => true,
//                    'responsive' => true,
                    'scrollX' => true,
                    'searching' => true,
                    'autoWidth' => true,
                    'info' => false, 'searchDelay' => 350,
//                    'language' => ['url' => url('js/dataTables/language.json')],
                    'language' => datatable_lang(),
                    'dom' => 'Blfrtip',
                    'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('dataTable.all')]],
                    'buttons' => [
                        ['extend' => 'copyHtml5', 'text' => '<i class="fa fa-copy" ></i>' . trans('dataTable.btn.copy'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => [0, 1, 2, 5]]],
                        ['extend' => 'excelHtml5', 'text' => '<i class="fa fa-file-excel-o" ></i> ' . trans('dataTable.btn.excel'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => ':visible']],
                        ['extend' => 'print', 'text' => '<i class="feather icon-printer close-card" ></i> ' . trans('dataTable.btn.print'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => ':visible']],
                        ['extend' => 'pdfHtml5', 'text' => '<i class="fa fa-file-pdf-o" ></i> ' . trans('dataTable.btn.pdf'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => [0, 1, 2, 5]]],
                    ],

                ]
            );
    }

    protected function getColumns()
    {
        $btnActive = (Auth::user()->can('active customers') == true) ? [[
            'name' => 'status',
            'data' => 'status',
            'title' => trans('dataTable.status'),
        ]] : [];
        $btnType = (session()->has('lang') and session('lang') == 'ar') ? 'type_ar' : 'type_en';
        $btnZone = (session()->has('lang') and session('lang') == 'ar') ? 'zone_current_location_ar' : 'zone_current_location_en';
//        +"name": "Osama mohammed Ahmed Al-mamari"
//    +"phone": "+9676619188912"
        //+"zone_current_location": "حدة"
//    +"status": 1
//    +"current_location": 1
//        +"type_en": "MINI DUMP TRUCK 70 MT."
//    +"type_ar": "سكس محورين"
//    +"modal": "Volvo"
//    +"length": 7.5
//    +"height": 2.3
//    +"width": 2.4
//    +"maxCapacity": 70.0


//    +"governorate_id": 1
//    +"zone_id": 1
//    +"attester_1_name": null
//    +"attester_2_name": null
//    +"note": null
//    +"image": "/images/trucks//15833483191.PNG"
//    +"created_by": 1
//    +"deleted_by": null
//    +"deleted_at": null
//    +"created_at": "2020-03-04 18:58:39"
//    +"updated_at": "2020-03-04 18:58:39"
//    +"created_by_name": "admin"

        return [
            ['name' => 'DT_RowIndex',
                'data' => 'DT_RowIndex',
                'title' => '#'],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('dataTable.name'),
            ],
            [
                'name' => 'code',
                'data' => 'code',
                'title' => trans('dataTable.code'),
            ],
            [
                'name' => 'phone',
                'data' => 'phone',
                'title' => trans('dataTable.phone'),
            ],
            [
                'name' => $btnType,
                'data' => $btnType,
                'title' => trans('dataTable.truck.type'),
            ],
            [
                'name' => $btnZone,
                'data' => $btnZone,
                'title' => trans('dataTable.current_location'),
            ],
            [
                'name' => 'modal',
                'data' => 'modal',
                'title' => trans('dataTable.truck.modal'),
            ], [
                'name' => 'image',
                'data' => 'image',
                'title' => trans('dataTable.truck.image'),
            ],
            [
                'name' => 'width',
                'data' => 'width',
                'title' => trans('dataTable.truck.width'),
            ],

            [
                'name' => 'length',
                'data' => 'length',
                'title' => trans('dataTable.truck.length'),
            ],

            [
                'name' => 'height',
                'data' => 'height',
                'title' => trans('dataTable.truck.height'),
            ],

            [
                'name' => 'maxCapacity',
                'data' => 'maxCapacity',
                'title' => trans('dataTable.truck.maxCapacity'),
            ],
        ];

    }

    function additionalData()
    {

        if ($this->type == 'deleted')
            return [

                [
                    'name' => 'deleted_at',
                    'data' => 'deleted_at',
                    'title' => 'deleted_at',
                ],
                [
                    'name' => 'deleted_by_name',
                    'data' => 'deleted_by_name',
                    'title' => trans('dataTable.deleted_by_name'),
                ],
                [
                    'name' => 'manageDeleted',
                    'data' => 'manageDeleted',
                    'title' => trans('dataTable.manageDeleted'),
                    'exportable' => false,
                    'printable' => false,
                    'orderable' => false,
                    'searchable' => false,
                ],
            ];
        else
            return (Auth::user()->can('manage customers') == false) ? [] :
                [['name' => 'manage',
                    'data' => 'manage',
                    'title' => trans('dataTable.manage'),
                    'exportable' => false,
                    'printable' => false,
                    'orderable' => false,
                    'searchable' => false,
                ],

                ];


    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'TrucksOwner_' . date('YmdHis');
    }
}
