<?php

namespace App\Http\Controllers;

use App\QuarantineAreaType;
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

    public function index($type = 'block_persons')
    {
//        return dd(             getZones_childs_ids('all'));
//        return dd($this->getData(37, 5));

//        $types = QuarantineAreaType::all();
//        $cols = ['zones.name_ar as zone_name', 'ParentZone.name_ar as government_name'];
//        $cols[]= DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
//                                WHERE zones.id = quarantine_areas.zone_id
//                                )
//                                as allTypes");
//        foreach ($types as $type) {
//            $cols[] =
//                DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
//                                WHERE zones.id = quarantine_areas.zone_id and  quarantine_areas.quarantine_area_type_id=" . $type->id . "
//                                )
//                                as type_$type->id");
//        }
//
//        $data = DB::table('zones')
//            ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.id')
//            ->select($cols
//            )->where('zones.parent', '=', 2)->get();
////        return $zone->render('admin.prices.index', ['title' => 'admins', 'deleted' => ($zoneType == '') ? false : true]);
//
//       $data=$this->getSumQuarantineGovData();
//        return dd($data);
//        return dd($type);
        return view('blockPersons.index')->with('type', $type);
//        return dd(date("d-m-Y", (1587250052936 / 1000)));

//                return dd($this->getTeamWorkerData('all','all','point','male'));
//        return datatables()->of($this->getTeamWorkerData('all','all','point','male'))
//            ->addIndexColumn()
//            ->addColumn('assign', 'workTeams.btn.assign')
//            ->rawColumns([
//                'assign',
//            ])->make(true);


    }

    public function sumBlockPersonsAccordingForCenterData($type = 'block_persons')
    {
        return view('blockPersons.sumBlockPersonsAccordingForCenterData')->with('type', $type);


    }

    public function getBlockPersonsData($government, $zone, $center, $gender, $from_date, $to_date, $type_query)
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

        if ($type_query == 'truck_driver')
            $place_column = 'blocked_people.check_point_id';
        else
            $place_column = 'blocked_people.quarantine_area_id';


        if ($type_query == 'truck_driver') {
            $bp_type_v = 'truck_owner';
            $bp_type_op = 'like';
            $bp_type_col = 'blocked_people.bp_type';
        } elseif ($type_query == 'people_in_port') {
            $bp_type_v = 'people';
            $bp_type_op = 'like';
            $bp_type_col = 'blocked_people.bp_type';
        } else {
            $bp_type_col = 'blocked_people.id';
            $bp_type_v = 'truck_owner';
            $bp_type_op = '>';
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
            ->whereBetween('blocked_people.check_date', [$from_date, $to_date])
            ->where($gender_col, $gender_op, $gender_v)
            ->where($place_column, $op, $val)
            ->where($bp_type_col, $bp_type_op, $bp_type_v)
            ->orderByDesc('id')->get();


        return $data;
    }


    public function getSumBlockPersonsAccordingForCenterData($government, $zone, $center, $gender, $from_date, $to_date, $type_query)

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
        if ($gender == 'all')
            $genderCondition = '';
        else
            $genderCondition = " and blocked_people.gender like '%$gender%' ";
        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;


        //        zone_id,check_point_id,quarantine_area_id,last_zone_visit_id,if_transfer_where

        $data = DB::table('quarantine_areas')
            ->leftJoin('zones as Zone', 'quarantine_areas.zone_id', '=', 'Zone.id')
            ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
            ->select('quarantine_areas.*',
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people 
                WHERE blocked_people.quarantine_area_id = quarantine_areas.id " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeople"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.if_dead_date > 1000 
                                ) 
                                as allBlockPeopleDead"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.if_transfer_where > 0 
                                   " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleTransform"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.out_date > 0 
                                   " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleOut"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.out_date is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null
                                   " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleNotOut"),
                'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name'
            )
//
            ->whereIn('quarantine_areas.zone_id', $filter_zones)
            ->orderByDesc('id')->get();


        return $data;
    }

    public function getSumBlockPersonsAccordingForZoneData($government, $gender, $from_date, $to_date, $type_query)

    {
        $filter_zones = [];
        if ($government == 'all') {
            $filter_zones = getZones_childs_ids($government);
        } else
            $filter_zones [] = $government;

        if ($gender == 'all')
            $genderCondition = '';
        else
            $genderCondition = " and blocked_people.gender like '%$gender%' ";
        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;


        $data = DB::table('zones')
            ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.id')
            ->select('zones.*', 'zones.name_ar as zone_name', 'ParentZone.name_ar as government_name',
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE zones.id = quarantine_areas.zone_id
                                 " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeople"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE zones.id = quarantine_areas.zone_id and blocked_people.if_dead_date > 1000 
                                 " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleDead"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                              WHERE zones.id = quarantine_areas.zone_id and  blocked_people.if_transfer_where > 0 
                                 " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleTransform"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                            WHERE  zones.id = quarantine_areas.zone_id and   blocked_people.out_date > 0 
                                 " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleOut"),

                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                            WHERE  zones.id = quarantine_areas.zone_id and   blocked_people.out_date is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null
                                 " . $dateCondition . $genderCondition . "
                                ) 
                                as allBlockPeopleNotOut")
            )
            ->whereIn('zones.parent', $filter_zones)
            ->orderByDesc('id')->get();


        return $data;
    }

    public function getSumBlockPersonsAccordingForGovernmentData($gender, $from_date, $to_date, $type_query)

    {

        if ($gender == 'all')
            $genderCondition = '';
        else
            $genderCondition = " and blocked_people.gender like '%$gender%' ";
        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;

        $cols = [
            'zones.*',
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT id FROM zones as subZones where subZones.parent=zones.id )
                                    " . $dateCondition . $genderCondition . "
                                  ) 
                                as allBlockPeople"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT id FROM zones as subZones where subZones.parent=zones.id )
                                   and blocked_people.if_dead_date > 1000   " . $dateCondition . $genderCondition . "
                                  ) 
                                as allBlockPeopleDead"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT id FROM zones as subZones where subZones.parent=zones.id )
                                   and blocked_people.if_transfer_where > 0   " . $dateCondition . $genderCondition . "
                                  ) 
                                as allBlockPeopleTransform"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT id FROM zones as subZones where subZones.parent=zones.id )
                                   and    blocked_people.out_date is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null   " . $dateCondition . $genderCondition . "
                                  ) 
                                as allBlockPeopleOut"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT id FROM zones as subZones where subZones.parent=zones.id )
                                   and  blocked_people.out_date > 0    " . $dateCondition . $genderCondition . "
                                  ) 
                                as allBlockPeopleNotOut")
        ];

        $data = DB::table('zones')
            ->select($cols)->where('parent', '=', '0')
            ->orderByDesc('id')->get();


        return $data;
    }


    public function getSumQuarantineData($government)

    {
        $filter_zones = [];
        if ($government == 'all') {
            $filter_zones = getZones_childs_ids($government);
        } else
            $filter_zones [] = $government;
        $types = QuarantineAreaType::all();
        $cols = ['zones.name_ar as zone_name', 'ParentZone.name_ar as government_name'];
        $cols[] = DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                                WHERE zones.id = quarantine_areas.zone_id
                                )
                                as allTypes");
        foreach ($types as $type) {
            $cols[] =
                DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                                WHERE zones.id = quarantine_areas.zone_id and  quarantine_areas.quarantine_area_type_id=" . $type->id . "
                                )
                                as type_$type->id");
        }

        $data = DB::table('zones')
            ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.id')
            ->select($cols)->whereIn('zones.parent', $filter_zones)
            ->get();
        return $data;
    }

    public function getSumQuarantineGovData()

    {
        $types = QuarantineAreaType::all();
        $cols = ['zones.name_ar as government_name'];
        $cols[] = DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                              INNER JOIN zones as SubZone ON quarantine_areas.zone_id=SubZone.id
                                WHERE 
                                zones.id = SubZone.parent 
                                )
                                as allTypes");
        foreach ($types as $type) {
            $cols[] =
                DB::raw("(SELECT count(quarantine_areas.id)
                 FROM quarantine_areas
                 INNER JOIN zones as SubZone ON quarantine_areas.zone_id=SubZone.id
                                WHERE 
                                zones.id = SubZone.parent and
                                  quarantine_areas.quarantine_area_type_id=" . $type->id . "
                                )
                                as type_$type->id");
        }

        $data = DB::table('zones')
            ->select($cols)->where('zones.parent', '=',0)
           ->get();
        return $data;
    }

    public function filterBlockPersons(Request $request)
    {
        //government, zone, from_date, to_date, gender, workTeamType

        $center = $request->center;
        $government = $request->government;
        $zone = $request->zone;
        $type_query = $request->type_query;
        $gender = $request->gender;
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $from = strtotime($from) * 1000;
        $to = strtotime($to) * 1000;

        if ($type_query == 'sumBlockPersons')
            $data = $this->getSumBlockPersonsAccordingForCenterData($government, $zone, $center, $gender, $from, $to, $type_query);
        elseif ($type_query == 'sumBlockPersons_zone')
            $data = $this->getSumBlockPersonsAccordingForZoneData($government, $gender, $from, $to, $type_query);
        elseif ($type_query == 'sumBlockPersons_gov')
            $data = $this->getSumBlockPersonsAccordingForGovernmentData($gender, $from, $to, $type_query);
        elseif ($type_query == 'quarantines_zone')
            $data = $this->getSumQuarantineData($government);
        elseif ($type_query == 'quarantines_gov')
            $data = $this->getSumQuarantineGovData();
        else
            $data = $this->getBlockPersonsData($government, $zone, $center, $gender, $from, $to, $type_query);

        return datatables()->of($data)
            ->addIndexColumn()
            ->rawColumns([
            ])->make(true);

    }


}
