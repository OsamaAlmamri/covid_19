<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class TrucksDataTable extends DataTable
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
            ->addColumn('manage', 'admin.trucks.btn.manage')
            ->addColumn('manageDeleted', 'admin.trucks.btn.manageDeleted')
            ->addColumn('image', 'admin.trucks.btn.image')
            ->rawColumns([
                'manage',
                'manageDeleted',
                'image',
            ]);
    }


    public function query()
    {
        if ($this->type != "deleted")
            $data = DB::table('trucks')
                ->select('trucks.*')
                ->WhereNull('trucks.deleted_at')
                ->orderByDesc('id')->get();
        else
            $data = DB::table('trucks')
                ->leftJoin('admins', 'trucks.deleted_by', '=', 'admins.id')
                ->select('trucks.*', 'admins.name as deleted_by_name')
                ->WhereNotNull('trucks.deleted_at')
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
        if (Auth::user()->can('manage trucks') != false) {
            $btnAdd = ['className' => 'btn btn-info ', 'text' => '<i class="fa fa-plus" ></i> ' . trans('dataTable.add.truck'),
                'action' => " function(){
                              window.location.href='/admin/trucks/create'
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
                    'autoWidth' => true,
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
            ->initComplete("function() {
            this.api().columns([1,2]).every(function() {
                var column = this;
                var select = $('<select class=\" form-control-sm\"><option value=\" \"></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function() {var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                column.data().unique().sort().each(function(d, j) { select.append('<option value=\"' + d + '\">' + d + '</option>')});
            });

            this.api().columns([3,4,5,6]).every( function(){
                        var column=this;
                        var input =$('<input class=\"input-sm \" >');
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup',function(){
                         column.search($(this).val(),false,false,true).draw();
                         });

                       });
        }");
    }

    protected function getColumns()
    {
        $btnType = (session()->has('lang') and session('lang') == 'ar') ? 'type_ar' : 'type_en';
        return
            array_merge
            (
                [
                    ['name' => 'DT_RowIndex',
                        'data' => 'DT_RowIndex',
                        'title' => '#'],
                    [
                        'name' => $btnType,
                        'data' => $btnType,
                        'title' => trans('dataTable.truck.type'),
                    ],
                    [
                        'name' => 'modal',
                        'data' => 'modal',
                        'title' => trans('dataTable.truck.modal'),
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

                    [
                        'name' => 'TonValue',
                        'data' => 'TonValue',
                        'title' => trans('dataTable.truck.TonValue'),
                    ],

                    [
                        'name' => 'image',
                        'data' => 'image',
                        'title' => trans('dataTable.truck.image'),
                    ],


                    [
                        'name' => 'created_at',
                        'data' => 'created_at',
                        'title' => trans('dataTable.created_at'),
                    ],


                ], $this->additionalData()
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
            return (Auth::user()->can('manage trucks') == false) ? [] :
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
        return 'Truck_' . date('YmdHis');
    }
}
