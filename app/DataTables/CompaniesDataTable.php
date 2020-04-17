<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class CompaniesDataTable extends DataTable
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
            ->addColumn('manage', 'admin.companies.btn.manage')
            ->addColumn('manageDeleted', 'admin.companies.btn.manageDeleted')
            ->addColumn('status', 'admin.companies.btn.status')
            ->rawColumns([
                'manage',
                'manageDeleted',
                'status',
            ]);
    }


    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('companies')
                ->leftJoin('admins as admin', 'companies.created_by', '=', 'admin.id')
                ->select('companies.*', 'admin.name as created_by_name')
                ->WhereNull('companies.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('companies')
                ->leftJoin('admins as SuperAdmin', 'companies.deleted_by', '=', 'SuperAdmin.id')
                ->leftJoin('admins as CrearedAdmin', 'companies.deleted_by', '=', 'CrearedAdmin.id')
                ->select('companies.*', 'SuperAdmin.name as deleted_by_name', 'CrearedAdmin.name as created_by_name')
                ->WhereNotNull('companies.deleted_at')
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
        if (Auth::user()->can('manage companies') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.company'),
                'action' => " function(){
                              window.location.href='/admin/companies/create'
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
                    'language'=> datatable_lang(),
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
        $btnActive = (Auth::user()->can('active companies') == true) ? [[
            'name' => 'status',
            'data' => 'status',
            'title' => trans('dataTable.status'),
        ]] : [];
        return
            array_merge([
                ['name' => 'DT_RowIndex',
                    'data' => 'DT_RowIndex',
                    'title' => '#'],
                [
                    'name' => 'name',
                    'data' => 'name',
                    'title' => trans('dataTable.name'),
                ],
                [
                    'name' => 'username',
                    'data' => 'username',
                    'title' => trans('dataTable.username'),
                ],
                [
                    'name' => 'email',
                    'data' => 'email',
                    'title' => trans('dataTable.email'),
                ],
                [
                    'name' => 'phone',
                    'data' => 'phone',
                    'title' => trans('dataTable.phone'),
                ],

                [
                    'name' => 'created_at',
                    'data' => 'created_at',
                    'title' => trans('dataTable.date'),
                ],


                [
                    'name' => 'created_by_name',
                    'data' => 'created_by_name',
                    'title' => trans('dataTable.created_by_name'),
                ],
            ],
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
            return (Auth::user()->can('manage companies') == false) ? [] :
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
        return 'Admin_' . date('YmdHis');
    }
}
