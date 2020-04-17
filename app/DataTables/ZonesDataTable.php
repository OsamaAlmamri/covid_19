<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class ZonesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $type;
    private $zone;

    public function __construct($zone = 0, $type = "")
    {
        $this->type = $type;
        $this->zone = $zone;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.zones.btn.manage')
            ->addColumn('manageDeleted', 'admin.zones.btn.manageDeleted')
            ->addColumn('status', 'admin.zones.btn.status')
            ->addColumn('zones', 'admin.zones.btn.zones')
            ->rawColumns([
                'manage',
                'manageDeleted',
                'status',
                'zones',
            ]);
    }


    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('zones')
                ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.id')
                ->select('zones.*', 'ParentZone.name_ar as p_name_ar', 'ParentZone.name_en as p_name_en')
                ->WhereNull('zones.deleted_at')
                ->where('zones.parent', '=', $this->zone)
                ->orderByDesc('id')->get();
        else
            $data = DB::table('zones')
                ->leftJoin('admins', 'zones.deleted_by', '=', 'admins.id')
                ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.id')
                ->select('zones.*', 'ParentZone.name_ar as p_name_ar', 'ParentZone.name_en as p_name_en', 'admins.name as deleted_by_name')
                ->WhereNotNull('zones.deleted_at')
                ->where('zones.parent', '=', $this->zone)
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
        if (Auth::user()->can('manage zones') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.zone'),
                'action' => " function(){
                              window.location.href='/admin/zones/$this->zone/create'
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
            )

            ;
    }

    protected function getColumns()
    {
        $btnActive = (Auth::user()->can('stop zones') == true) ? [[
            'name' => 'status',
            'data' => 'status',
            'title' => trans('dataTable.status'),
        ]] : [];

        $btnZone = ($this->zone == 0) ? [
            [
                'name' => 'zones',
                'data' => 'zones',
                'title' => trans('dataTable.zones'),
            ]] : [];

        $btnParent = ($this->zone != 0) ? [
            [
                'name' => 'p_name_ar',
                'data' => 'p_name_ar',
                'title' => trans('dataTable.zone.p_name_ar'),
            ],
            [
                'name' => 'p_name_en',
                'data' => 'p_name_en',
                'title' => trans('dataTable.zone.p_name_en'),
            ]] : [];

        return
            array_merge
            (
                [
                    ['name' => 'DT_RowIndex',
                        'data' => 'DT_RowIndex',
                        'title' => '#'],
                    [
                        'name' => 'name_ar',
                        'data' => 'name_ar',
                        'title' => trans('dataTable.zone.name_ar'),
                    ],
                    [
                        'name' => 'name_en',
                        'data' => 'name_en',
                        'title' => trans('dataTable.zone.name_en'),
                    ],
                ], $btnParent, $btnZone,
                $btnActive
                , $this->additionalData()
            );
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
            return (Auth::user()->can('manage zones') == false) ? [] :
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
        return 'Zones_' . date('YmdHis');
    }
}
