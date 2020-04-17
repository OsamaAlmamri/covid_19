<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class AttencesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $type;

    public function __construct($project_id='', $type = "")
    {
        $this->type = $type;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn();
    }


    public function query()
    {

        $data = DB::table('attendences')
            ->join('days_qrs', 'attendences.day_id', '=', 'days_qrs.id')
            ->join('users', 'attendences.user_id', '=', 'users.id')
            ->join('periods', 'attendences.period_id', '=', 'periods.id')
            ->select('attendences.*',
                DB::raw("CONCAT(COALESCE(periods.from,'') ,'-',COALESCE(periods.to,'')) AS period"),
                'users.name as staff_name', 'users.employee_number',
                'days_qrs.name as qr_name', 'attendences.created_at as date')
//            ->where('phases.project_id', '=', $this->project_id)
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

        return [
            ['name' => 'DT_RowIndex',
                'data' => 'DT_RowIndex',
                'title' => '#'],
            [
                'name' => 'staff_name',
                'data' => 'staff_name',
                'title' => trans('dataTable.projects.staff_name'),
            ],
            [
                'name' => 'employee_number',
                'data' => 'employee_number',
                'title' => trans('dataTable.employee_number'),
            ],
            [
                'name' => 'period',
                'data' => 'period',
                'title' => trans('dataTable.period'),
            ],
            [
                'name' => 'date',
                'data' => 'date',
                'title' => trans('dataTable.date'),
            ],
            [
                'name' => 'qr_name',
                'data' => 'qr_name',
                'title' => trans('dataTable.qr_name'),
            ]];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'QR_' . date('YmdHis');
    }
}
