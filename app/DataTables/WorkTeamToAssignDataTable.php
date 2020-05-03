<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class WorkTeamToAssignDataTable extends DataTable
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
            ->addColumn('assign', 'workTeams.btn.assign')
            ->rawColumns([
                'assign',

            ]);
    }

// 'name', 'zone_id', 'phone', 'ssn', 'workType', 'job', 'birth_date',
//        'gender', 'join_date', 'country', 'deleted_by', 'created_by',
    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('work_teams')
                ->leftJoin('zones as Zone', 'work_teams.zone_id', '=', 'Zone.code')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
                ->select('work_teams.*',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name'
                )
                ->WhereNull('work_teams.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('work_teams')
                ->leftJoin('users', 'work_teams.deleted_by', '=', 'users.id')
                ->leftJoin('zones as Zone', 'work_teams.zone_id', '=', 'Zone.code')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
                ->select('work_teams.*',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name', 'users.username as deleted_by_name'
                )
                ->WhereNotNull('work_teams.deleted_at')
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
        $route = route('workTeams.create');
        if (Auth::user()->can('manage worksTeams') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.workTeams'),
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
                        'name' => 'gender',
                        'data' => 'gender',
                        'title' => trans('dataTable.gender'),
                    ],

                    //'name', 'zone_id', 'phone', 'ssn', 'workType', 'job', 'birth_date',
                    ////        'gender', 'join_date', 'country', 'deleted_by', 'created_by',
                    [
                        'name' => 'job',
                        'data' => 'job',
                        'title' => trans('dataTable.job'),
                    ],
                    [
                        'name' => 'country',
                        'data' => 'country',
                        'title' => trans('dataTable.country'),
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
                    [
                        'name' => 'join_date',
                        'data' => 'join_date',
                        'title' => trans('dataTable.join_date'),
                    ],
                    [
                        'name' => 'birth_date',
                        'data' => 'birth_date',
                        'title' => trans('dataTable.birth_date'),
                    ],
                    [
                        'name' => 'phone',
                        'data' => 'phone',
                        'title' => trans('dataTable.phone'),
                    ],
                    [
                        'name' => 'assign',
                        'data' => 'assign',
                        'title' => trans('dataTable.workTeams.assign'),
                    ],
                ]
            );
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
