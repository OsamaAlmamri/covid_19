<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class QuarantineAreasDataTable extends DataTable
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
            ->addColumn('manage', 'quarantines.btn.manage')
            ->addColumn('manageDeleted', 'quarantines.btn.manageDeleted')
            ->addColumn('status', 'quarantines.btn.status')
            ->addColumn('show', 'quarantines.btn.show')
            ->addColumn('team', 'quarantines.btn.team')
            ->rawColumns([
                'manage',
                'manageDeleted',
                'status',
                'show',
                'team',
            ]);
    }


    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('quarantine_areas')
                ->leftJoin('work_teams', 'quarantine_areas.manager_id', '=', 'work_teams.id')
                ->leftJoin('zones as Zone', 'quarantine_areas.zone_id', '=', 'Zone.id')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
                ->leftJoin('quarantine_area_types', 'quarantine_areas.quarantine_area_type_id', '=', 'quarantine_area_types.id')
                ->select('quarantine_areas.*',
                    'work_teams.name as manager_name', 'work_teams.phone as manager_employee_number',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name',
                    'quarantine_area_types.name as quarantine_area_type'
                )
                ->WhereNull('quarantine_areas.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('quarantine_areas')
                ->leftJoin('users', 'quarantines.deleted_by', '=', 'users.id')
                ->leftJoin('work_teams', 'quarantine_areas.manager_id', '=', 'work_teams.id')
                ->leftJoin('zones as Zone', 'quarantine_areas.zone_id', '=', 'Zone.id')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
                ->leftJoin('quarantine_area_types', 'quarantine_areas.quarantine_area_type_id', '=', 'quarantine_area_types.id')
                ->select('quarantine_areas.*',
                    'work_teams.name as manager_name', 'work_teams.phone as manager_employee_number',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name',
                    'quarantine_area_types.name as quarantine_area_type', 'users.name as deleted_by_name'
                )
                ->WhereNotNull('quarantine_areas.deleted_at')
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
        $btnAdd = [];
        $route = route('quarantines.create');
        if (Auth::user()->can('manage quarantines') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.quarantine'),
                'action' => " function(){
                              window.location.href='$route'
                              }"];
        }

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
//                    'autoWidth' => true,

                    'info' => false, 'searchDelay' => 350,
//                    'language' => ['url' => url('js/dataTables/language.json')],
                    'language' => datatable_lang(),
                    'dom' => 'Blfrtip',
                    'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('dataTable.all')]],
                    'buttons' => [
                        $btnAdd,
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
        $btnActive = (Auth::user()->can('active quarantines') == true) ? [[
            'name' => 'status',
            'data' => 'status',
            'title' => trans('dataTable.status'),
        ]] : [];


        $btnManager = ($this->type != 'deleted') ? [
            [
                'name' => 'manager_name',
                'data' => 'manager_name',
                'title' => trans('dataTable.manager_name'),
            ],
            [
                'name' => 'manager_employee_number',
                'data' => 'manager_employee_number',
                'title' => trans('dataTable.manager_phone'),
            ]] : [];
//   'name', 'quarantine_area_type_id', 'manager_id',
//        'zone_id', 'longitude', 'latitude', 'map_address',
//        'status','maxCapacity', 'deleted_by', 'created_by',
        return
            array_merge
            (
                [
                    ['name' => 'DT_RowIndex',
                        'data' => 'DT_RowIndex',
                        'title' => '#'],
                    [
                        'name' => 'name',
                        'data' => 'name',
                        'title' => trans('dataTable.name'),
                    ],
                    [
                        'name' => 'quarantine_area_type',
                        'data' => 'quarantine_area_type',
                        'title' => trans('dataTable.quarantine_area_type'),
                    ],
                    [
                        'name' => 'government_name',
                        'data' => 'government_name',
                        'title' => trans('dataTable.government_name'),
                    ],
                    [
                        'name' => 'zone_name',
                        'data' => 'zone_name',
                        'title' => trans('dataTable.zone_name'),
                    ],
                ], $btnManager, [
                [
                    'name' => 'maxCapacity',
                    'data' => 'maxCapacity',
                    'title' => trans('dataTable.maxCapacity'),
                ],
                [
                    'name' => 'created_at',
                    'data' => 'created_at',
                    'title' => trans('dataTable.created_at'),
                ],
            ],
                $btnActive,
                [
//                    [
//                        'name' => 'show',
//                        'data' => 'show',
//                        'title' => trans('dataTable.quarantines.show'),
//                    ],
                    [
                        'name' => 'team',
                        'data' => 'team',
                        'title' => trans('dataTable.team'),
                    ]
                ],
                $this->additionalData()
            );
    }

    function additionalData()
    {

        if ($this->type == 'deleted' and (Auth::user()->can('manage deleted quarantines') == false))
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
            return (Auth::user()->can('manage quarantines') == false) ? [] :
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
        return 'Project_' . date('YmdHis');
    }
}
