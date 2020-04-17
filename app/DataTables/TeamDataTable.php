<?php

namespace App\DataTables;

use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class TeamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $project_id;
    private $project;

    public function __construct($project_id)
    {
        $this->project_id = $project_id;
        $this->project = Project::find($this->project_id);
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('manage', 'team.btn.manage')
            ->addColumn('task', 'team.btn.task')
            ->addColumn('avatar', 'team.btn.image')
            ->rawColumns([
                'task',
                'manage',
                'avatar',
            ]);
    }


    public function query()
    {

        $data = DB::table('project_users')
            ->join('users', 'project_users.user_id', '=', 'users.id')
            ->select('users.name as employee_name',
                'avatar', 'employee_number', 'phone', 'project_users.*'
            )
            ->where('project_users.project_id', '=', $this->project_id)
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

        $route = route('projects.team.create', $this->project_id);
        if (Auth::user()->can('manage projectTeams') == true) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.User'),
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
                    'autoWidth' => true,

                    'searching' => true,
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
        $btnActive = (Auth::user()->can('show projectTeams') == true or auth()->user()->id == $this->project->manager_id) ? [[
            'name' => 'task',
            'data' => 'task',
            'title' => trans('dataTable.tasks'),
        ]] : [];

        return
            array_merge
            (
                [
                    ['name' => 'DT_RowIndex',
                        'data' => 'DT_RowIndex',
                        'title' => '#'],
                    [
                        'name' => 'employee_name',
                        'data' => 'employee_name',
                        'title' => trans('dataTable.name'),
                    ],
                    [
                        'name' => 'employee_number',
                        'data' => 'employee_number',
                        'title' => trans('dataTable.employee_number'),
                    ],
                    [
                        'name' => 'phone',
                        'data' => 'phone',
                        'title' => trans('dataTable.phone'),
                    ],
                    [
                        'name' => 'avatar',
                        'data' => 'avatar',
                        'title' => trans('dataTable.avatar'),
                    ],
                ],
                $btnActive
//                , $this->additionalData()
            );
    }

    function additionalData()
    {
        return (
            Auth::user()->can('manage projectTeams') == true
//                or auth()->user()->id == $this->project->manager_id
        ) ?
            [['name' => 'manage',
                'data' => 'manage',
                'title' => trans('dataTable.manage'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],

            ] : [];


    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
