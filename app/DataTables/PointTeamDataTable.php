<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class PointTeamDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $point_id;
    private $type;

    public function __construct($point_id, $type = 'point_teams')
    {
        $this->point_id = $point_id;
        $this->type = $type;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn();
    }


    public function query()
    {
        if ($this->type == 'point_teams')
            $data = DB::table('point_teams')
                ->join('check_points', 'point_teams.check_point_id', '=', 'check_points.id')
                ->join('work_teams', 'point_teams.work_team_id', '=', 'work_teams.id')
                ->leftJoin('zones as Zone', 'work_teams.zone_id', '=', 'Zone.id')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
                ->select('work_teams.*', 'check_points.name as check_point_name',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name'
                )
                ->where('point_teams.check_point_id', '=', $this->point_id)
                ->orderByDesc('id')->get();
        else
            $data = DB::table('health_teams')
                ->join('quarantine_areas', 'health_teams.quarantine_area_id', '=', 'quarantine_areas.id')
                ->join('work_teams', 'health_teams.work_team_id', '=', 'work_teams.id')
                ->leftJoin('zones as Zone', 'work_teams.zone_id', '=', 'Zone.id')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
                ->select('work_teams.*', 'quarantine_areas.name as quarantine_area_name',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name'
                )
                ->where('health_teams.quarantine_area_id', '=', $this->point_id)
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
//                    'autoWidth' => true,

                    'info' => false, 'searchDelay' => 350,
//                    'language' => ['url' => url('js/dataTables/language.json')],
                    'language' => datatable_lang(),
                    'dom' => 'Blfrtip',
                    'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('dataTable.all')]],
                    'buttons' => [
                        ['extend' => 'copyHtml5', 'text' => '<i class="fa fa-copy" ></i>' . trans('dataTable.btn.copy'),
                            'className' => 'btn btn-info ', 'exportOptions' => ['columns' => [0, 1, 2, 5]]],
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
                'title' => '#'], [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('dataTable.name'),
            ],
            [
                'name' => 'gender',
                'data' => 'gender',
                'title' => trans('dataTable.gender'),

            ],
            [
                'name' => 'workType',
                'data' => 'workType',
                'title' => trans('dataTable.workType'),

            ],
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
                'title' => trans('dataTable.w_phone'),
            ],
            [
                'name' => 'ssn',
                'data' => 'ssn',
                'title' => trans('dataTable.ssn'),
            ]
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















