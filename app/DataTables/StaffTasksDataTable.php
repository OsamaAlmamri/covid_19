<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class StaffTasksDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $user_id;

    public function __construct($project_id, $user_id)
    {
        $this->user_id = $user_id;
        $this->project_id = $project_id;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
//            ->addColumn('manage', 'tasks.btn.manage')
//            ->addColumn('manageDeleted', 'tasks.btn.manageDeleted')
//            ->addColumn('show', 'tasks.btn.show')
//            ->rawColumns([
//                'manage',
//                'manageDeleted',
//                'show',
//            ]);
            ;
    }


    public function query()
    {
        if ($this->project_id != "all")
            $data = DB::table('tasks')
                ->join('phases', 'tasks.phase_id', '=', 'phases.id')
                ->leftJoin('users', 'tasks.user_id', '=', 'users.id')
                ->select('tasks.*', 'users.name as staff_name', 'users.employee_number', 'phases.title as phase_title')
                ->whereNull('tasks.deleted_at')
                ->where('user_id', '=', $this->user_id)
                ->whereIn('phase_id', getProjectServeceIds($this->project_id))->get();
//            ->orderByDesc('id')->get();
        else
            $data = DB::table('tasks')
                ->join('phases', 'tasks.phase_id', '=', 'phases.id')
                ->leftJoin('users', 'tasks.user_id', '=', 'users.id')
                ->select('tasks.*', 'users.name as staff_name', 'users.employee_number', 'phases.title as phase_title')
                ->whereNull('tasks.deleted_at')
                ->where('user_id', '=', $this->user_id)->get();

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
        $route = route('tasks.create');
//        if (Auth::user()->can('manage tasks') != false) {
//            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.task'),
//                'action' => " function(){
//                              window.location.href='$route'
//                              }"];
//        }

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
                        'name' => 'title',
                        'data' => 'title',
                        'title' => trans('dataTable.projects.title'),
                    ],
                    [
                        'name' => 'phase_title',
                        'data' => 'phase_title',
                        'title' => trans('dataTable.projects.phase_title'),
                    ],
                    [
                        'name' => 'start_date',
                        'data' => 'start_date',
                        'title' => trans('dataTable.projects.start_date'),
                    ],
                    [
                        'name' => 'end_date',
                        'data' => 'end_date',
                        'title' => trans('dataTable.projects.end_date'),
                    ],
                    [
                        'name' => 'status',
                        'data' => 'status',
                        'title' => trans('dataTable.projects.status'),
                    ],
                    [
                        'name' => 'priority',
                        'data' => 'priority',
                        'title' => trans('dataTable.projects.priority'),
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
