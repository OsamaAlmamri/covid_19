<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class ProjectsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $type;

    public function __construct( $type = "")
    {
        $this->type = $type;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('manage', 'projects.btn.manage')
            ->addColumn('manageDeleted', 'projects.btn.manageDeleted')
            ->addColumn('status', 'projects.btn.status')
            ->addColumn('show', 'projects.btn.show')
            ->addColumn('team', 'projects.btn.team')
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
            $data = DB::table('projects')
                ->leftJoin('users', 'projects.manager_id', '=', 'users.id')
                ->select('projects.*', 'users.name as manager_name', 'users.employee_number as manager_employee_number')
                ->WhereNull('projects.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('projects')
                ->leftJoin('users', 'projects.deleted_by', '=', 'users.id')
                ->select('projects.*', 'users.name as deleted_by_name')
                ->WhereNotNull('projects.deleted_at')
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
        $route=route('projects.create');
        if (Auth::user()->can('manage projects') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.project'),
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
        $btnActive = (Auth::user()->can('active projects') == true) ? [[
            'name' => 'status',
            'data' => 'status',
            'title' => trans('dataTable.status'),
        ]] : [];


        $btnManager = ($this->type != 'deleted') ? [
            [
                'name' => 'manager_name',
                'data' => 'manager_name',
                'title' => trans('dataTable.projects.manager_name'),
            ],
            [
                'name' => 'manager_employee_number',
                'data' => 'manager_employee_number',
                'title' => trans('dataTable.projects.manager_employee_number'),
            ]] : [];

        return
            array_merge
            (
                [
                    ['name' => 'DT_RowIndex',
                        'data' => 'DT_RowIndex',
                        'title' => '#'],
                    [
                        'name' => 'code',
                        'data' => 'code',
                        'title' => trans('dataTable.projects.code'),
                    ],
                    [
                        'name' => 'title',
                        'data' => 'title',
                        'title' => trans('dataTable.projects.title'),
                    ],
                ], $btnManager, [
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
                    'name' => 'created_at',
                    'data' => 'created_at',
                    'title' => trans('dataTable.projects.created_at'),
                ],
            ],
                $btnActive,
                [
                    [
                        'name' => 'show',
                        'data' => 'show',
                        'title' => trans('dataTable.projects.show'),
                    ],
                    [
                        'name' => 'team',
                        'data' => 'team',
                        'title' => trans('dataTable.team'),
                    ]
                ]
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
            return (Auth::user()->can('manage projects') == false) ? [] :
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
