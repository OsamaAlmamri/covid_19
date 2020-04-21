<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlockPersonsController extends Controller
{


    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('permission:manage admins', ['only' => ['j']]);
//        $this->middleware('permission:show admins', ['only' => ['index']]);
    }

    public function index()
    {
//        return dd(             getZones_childs_ids('all'));
//        return dd($this->getData(37, 5));

//        $zone = new PricesDataTable($zone, $zoneType);
//        return $zone->render('admin.prices.index', ['title' => 'admins', 'deleted' => ($zoneType == '') ? false : true]);

//        return dd($this->getBlockPersonsrData('all', 'all', 'all'));
        return view('blockPersons.index');
//        return dd(date("d-m-Y", (1587250052936 / 1000)));

//                return dd($this->getTeamWorkerData('all','all','point','male'));
//        return datatables()->of($this->getTeamWorkerData('all','all','point','male'))
//            ->addIndexColumn()
//            ->addColumn('assign', 'workTeams.btn.assign')
//            ->rawColumns([
//                'assign',
//            ])->make(true);

    }

    public function getBlockPersonsrData($government, $zone, $center, $gender, $from_date, $to_date)
    {
        $filter_zones = [];
        if ($zone == 'all' or $government == 'all') {
            $filter_zones = getZones_childs_ids($government);
        } else
            $filter_zones [] = $zone;
        if ($center == 'all') {
            $op = '>';
            $val = 0;
        } else {
            $op = '=';
            $val = $center;
        }
        if ($gender == 'all') {
            $gender_v = 0;
            $gender_col = 'blocked_people.id';
            $gender_op = '>';

        } else {
            $gender_v = '%' . $gender . '%';
            $gender_col = 'blocked_people.gender';
            $gender_op = 'like';

        }


        //        zone_id,check_point_id,quarantine_area_id,last_zone_visit_id,if_transfer_where

        $data = DB::table('blocked_people')
            ->leftJoin('zones as Zone', 'blocked_people.zone_id', '=', 'Zone.id')
            ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
            ->leftJoin('check_points', 'blocked_people.check_point_id', '=', 'check_points.id')
            ->leftJoin('quarantine_areas', 'blocked_people.quarantine_area_id', '=', 'quarantine_areas.id')
            ->leftJoin('zones as visit_zone', 'blocked_people.last_zone_visit_id', '=', 'visit_zone.id')
            ->leftJoin('zones as visit_ParentZone', 'visit_zone.parent', '=', 'visit_ParentZone.id')
            ->leftJoin('quarantine_areas as quarantine_areas_transfer', 'blocked_people.quarantine_area_id', '=', 'quarantine_areas_transfer.id')
            ->leftJoin('zones as transfer_zone', 'quarantine_areas_transfer.zone_id', '=', 'transfer_zone.id')
            ->leftJoin('zones as transfer_ParentZone', 'transfer_zone.parent', '=', 'transfer_ParentZone.id')
            ->leftJoin('zones as health_center_zone', 'check_points.zone_id', '=', 'health_center_zone.id')
            ->leftJoin('zones as health_center_parent_zone', 'health_center_zone.parent', '=', 'health_center_parent_zone.id')
            ->leftJoin('zones as check_point_zone', 'blocked_people.zone_id', '=', 'check_point_zone.id')
            ->leftJoin('zones as check_point_parent_zone', 'check_point_zone.parent', '=', 'check_point_parent_zone.id')
            ->select('blocked_people.*',
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24*365)) as age_year "),
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24*30)) as age_month "),
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24)) as age_day "),
                DB::raw("FROM_UNIXTIME(start_date_symptoms/1000,'%Y-%m-%d') as start_date_symptoms "),
                DB::raw("FROM_UNIXTIME(start_date_symptoms/1000,'%Y-%m-%d') as birth_date "),
                DB::raw("FROM_UNIXTIME(sleep_date/1000,'%Y-%m-%d') as sleep_date "),
                DB::raw("FROM_UNIXTIME(insulation_date/1000,'%Y-%m-%d') as insulation_date "),
                DB::raw("FROM_UNIXTIME(comming_date/1000,'%Y-%m-%d') as comming_date "),
                DB::raw("FROM_UNIXTIME(out_from_country_date/1000,'%Y-%m-%d') as out_from_country_date "),
                DB::raw("FROM_UNIXTIME(comming_to_yemen_date/1000,'%Y-%m-%d') as comming_to_yemen_date "),
                DB::raw("FROM_UNIXTIME(sample_sent_date/1000,'%Y-%m-%d') as sample_sent_date "),
                DB::raw("FROM_UNIXTIME(if_dead_date/1000,'%Y-%m-%d') as if_dead_date "),
                DB::raw("FROM_UNIXTIME(check_date/1000,'%Y-%m-%d') as check_date "),
                DB::raw("CONCAT(COALESCE(ParentZone.name_ar,'') , ' /' ,COALESCE(Zone.name_ar,'')) AS from_zone"),
                DB::raw("CONCAT(COALESCE(visit_ParentZone.name_ar,'') , ' / ' ,COALESCE(visit_zone.name_ar,'')) AS visit_zone"),
                DB::raw("CONCAT(COALESCE(transfer_ParentZone.name_ar,'') ,' / ',COALESCE(transfer_zone.name_ar,''),' / ',COALESCE(quarantine_areas_transfer.name,'')) AS transfer_zone"),
                DB::raw("CONCAT(COALESCE(health_center_parent_zone.name_ar,''),' / ' ,COALESCE(health_center_zone.name_ar,''),' / ' ,COALESCE(quarantine_areas.name,'')) AS center_zone"),
                DB::raw("CONCAT(COALESCE(check_point_parent_zone.name_ar,'') ,' / ',COALESCE(check_point_zone.name_ar,'')) AS point_zone"),
                'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name',
                'quarantine_areas.name as quarantine_area_name', 'check_points.name as check_point_name'
            )
//            ->WhereNotNull('work_teams.deleted_at')
            ->whereIn('blocked_people.zone_id', $filter_zones)
            ->whereBetween('blocked_people.created_at', [$from_date, $to_date])
            ->where($gender_col, $gender_op, $gender_v)
            ->where('blocked_people.quarantine_area_id', $op, $val)
            ->orderByDesc('id')->get();


        return $data;
    }


    public function filterBlockPersons(Request $request)
    {
        //government, zone, from_date, to_date, gender, workTeamType

        $center = $request->center;
        $government = $request->government;
        $zone = $request->zone;
        $gender = $request->gender;
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getBlockPersonsrData($government, $zone, $center, $gender, $from, $to);

        return datatables()->of($data)
            ->addIndexColumn()
            ->rawColumns([
            ])->make(true);

    }


}
