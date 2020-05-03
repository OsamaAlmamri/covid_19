<?php

namespace App\DataTables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class BlockPersonsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $quarntine_id;
    private $type;

    public function __construct($quarntine_id, $type = 'check')
    {
        $this->quarntine_id = $quarntine_id;
        $this->type = $type;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn();
    }


    public function query()
    {
        if ($this->type == 'check')
            $data = DB::table('blocked_people')
                ->leftJoin('zones as Zone', 'blocked_people.zone_id', '=', 'Zone.code')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
                ->select(
                    'bp_name', 'phone', 'relative_phone',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name')
                ->where('quarantine_district_id', '=', $this->quarntine_id)
                ->orderByDesc('blocked_people.id')->get();
        else
            $data = DB::table('blocked_people')
                ->leftJoin('zones as Zone', 'blocked_people.zone_id', '=', 'Zone.code')
                ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
                ->select('bp_name', 'phone', 'relative_phone',
                    'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name')
                ->where('typeStatus', 'like', 'runAway')
                ->where('quarantine_district_id', '=', $this->quarntine_id)
                ->orderByDesc('blocked_people.id')->get();

        return $data;

    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

//
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
                    'lengthMenu' => [[trans('dataTable.all'), 25, 50, 100, -1], [trans('dataTable.all'), 25, 50, 100]],
                ]
            );
    }

    protected function getColumns()
    {

        return [
            ['name' => 'DT_RowIndex',
                'data' => 'DT_RowIndex',
                'title' => '#'], [
                'name' => 'bp_name',
                'data' => 'bp_name',
                'title' => trans('dataTable.bp_name'),
            ],

            [
                'name' => 'phone',
                'data' => 'phone',
                'title' => trans('dataTable.phone'),
            ],
            [
                'name' => 'relative_phone',
                'data' => 'relative_phone',
                'title' => trans('dataTable.relative_phone'),
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















