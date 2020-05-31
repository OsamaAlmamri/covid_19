<?php

namespace App\Http\Controllers;

use App\BlockedPerson;
use App\DataTables\BlockPersonsDataTable;
use App\DataTables\ZonesDataTable;
use App\QuarantineAreaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BlockPersonsController extends Controller
{


    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('permission:manage admins', ['only' => ['j']]);
//        $this->middleware('permission:show admins', ['only' => ['index']]);
    }

    public function index($type_query = 'block_persons')
    {

//        return dd( getAllQuarantineTypeInfo());
        if (
            ($type_query == 'sumBlockPersons'
                or ($type_query == 'sumBlockPersons_zone')
                or ($type_query == 'sumBlockPersons_gov')
            )
            and Auth::user()->can('sumBlockPersons reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        elseif (($type_query == 'truck_driver' or $type_query == 'people_in_port')
            and Auth::user()->can('point_daily reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        elseif (($type_query == 'quarantines_zone' or $type_query == 'quarantines_gov')
            and Auth::user()->can('quarantines reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        elseif (Auth::user()->can('sumBlockPersons reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        elseif (Auth::user()->can('show blockPersons') == true)
            return view('blockPersons.index')->with('type', $type_query);
        else
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

//        return dd(date("d-m-Y", (1587250052936 / 1000)));

//                return dd($this->getTeamWorkerData('all','all','point','male'));
//        return datatables()->of($this->getTeamWorkerData('all','all','point','male'))
//            ->addIndexColumn()
//            ->addColumn('assign', 'workTeams.btn.assign')
//            ->rawColumns([
//                'assign',
//            ])->make(true);


    }

    private function dateToMiliSecond($date)
    {
        if ($date != null)
            return strtotime($date) * 1000;
        else
            return null;
    }

    public function store(Request $request)
    {

        $request['check_date'] = $this->dateToMiliSecond($request->check_date);
        $request['start_date_symptoms'] = $this->dateToMiliSecond($request->start_date_symptoms);
        $request['sleep_date'] = $this->dateToMiliSecond($request->sleep_date);
        $request['insulation_date'] = $this->dateToMiliSecond($request->insulation_date);
        $request['out_from_country_date'] = $this->dateToMiliSecond($request->out_from_country_date);
        $request['comming_to_yemen_date'] = $this->dateToMiliSecond($request->comming_to_yemen_date);
        $request['sample_sent_date'] = $this->dateToMiliSecond($request->sample_sent_date);
        $request['if_dead_date'] = $this->dateToMiliSecond($request->if_dead_date);
        $request['insulation_end_date'] = $this->dateToMiliSecond($request->insulation_end_date);
        $request['id_issue_date'] = $this->dateToMiliSecond($request->id_issue_date);
        $request['dest_exit_date'] = $this->dateToMiliSecond($request->dest_exit_date);
        $request['birth_date'] = $this->dateToMiliSecond($request->birth_date);

        if ($request->is_comming_from_other_country == 1)
            $request['last_zone_visit_id'] = null;

        if ($request->bp_from == 'align')
            $request['district_code'] = null;


        $person = BlockedPerson::create(array_merge($request->all(),
            [
                'entry_date' => strtotime('now') * 1000,
                'req_id' => auth()->user()->id,
                'created_by' => auth()->user()->id]));
        return response(['data' => $person->id], 200);
    }

    public function sumBlockPersonsAccordingForCenterData($type = 'block_persons')
    {
        return view('blockPersons.sumBlockPersonsAccordingForCenterData')->with('type', $type);


    }

    public function check($id, $type = 'check')
    {
//        return dd('f');
//        if (Auth::user()->can('show worksTeams') == false)
//            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        $block_persons = new BlockPersonsDataTable($id, $type);
        return $block_persons->render('blockPersons.check', ['type' => $type]);
    }


    public function getBlockPersonsData($government, $zone, $center, $gender, $from_date, $to_date, $type_query, $nationality)
    {
        $filter_zones = [];
        if ($zone == 'all' or $government == 'all') {
            $filter_zones = getZones_childs_ids($government,'district','getSumBlockPersons');
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
        if ($nationality == 'all') {
            $nationality_v = 0;
            $nationality_col = 'blocked_people.id';
            $nationality_op = '>';

        } elseif ($nationality == 'yemeni') {
            $nationality_v = '%' . $nationality . '%';
            $nationality_col = 'blocked_people.bp_from';
            $nationality_op = 'like';

        } else {
            $nationality_v = '%' . $nationality . '%';
            $nationality_col = 'blocked_people.bp_from';
            $nationality_op = 'not like';

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
        } elseif ($type_query == 'runAway_block_peoples') {
            $bp_type_v = 'runAway';
            $bp_type_op = 'like';
            $bp_type_col = 'blocked_people.typeStatus';
        } else {
            $bp_type_col = 'blocked_people.id';
            $bp_type_v = 0;
            $bp_type_op = '>';
        }


        //        zone_id,check_point_id,quarantine_area_id,last_zone_visit_id,if_transfer_where

        $data = DB::table('blocked_people')
            ->leftJoin('zones as Zone', 'blocked_people.district_code', '=', 'Zone.code')
            ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
            ->leftJoin('check_points', 'blocked_people.check_point_id', '=', 'check_points.id')
            ->leftJoin('quarantine_areas', 'blocked_people.quarantine_area_id', '=', 'quarantine_areas.id')
            ->leftJoin('zones as visit_zone', 'blocked_people.last_zone_visit_id', '=', 'visit_zone.code')
            ->leftJoin('zones as visit_ParentZone', 'visit_zone.parent', '=', 'visit_ParentZone.code')
            ->leftJoin('quarantine_areas as quarantine_areas_transfer', 'blocked_people.if_transfer_where', '=', 'quarantine_areas_transfer.id')
            ->leftJoin('zones as transfer_zone', 'quarantine_areas_transfer.zone_id', '=', 'transfer_zone.code')
            ->leftJoin('zones as transfer_ParentZone', 'transfer_zone.parent', '=', 'transfer_ParentZone.code')
            ->leftJoin('zones as health_center_zone', 'check_points.zone_id', '=', 'health_center_zone.code')
            ->leftJoin('zones as health_center_parent_zone', 'health_center_zone.parent', '=', 'health_center_parent_zone.code')
            ->leftJoin('zones as check_point_zone', 'blocked_people.district_code', '=', 'check_point_zone.code')
            ->leftJoin('zones as check_point_parent_zone', 'check_point_zone.parent', '=', 'check_point_parent_zone.code')
            ->select('blocked_people.*',
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24*365)) as age_year "),
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24*30)) as age_month "),
                DB::raw("round((unix_timestamp(now()) - birth_date/1000)/(60*60*24)) as age_day "),
                DB::raw("FROM_UNIXTIME(start_date_symptoms/1000,'%Y-%m-%d') as start_date_symptoms "),
                DB::raw("FROM_UNIXTIME(start_date_symptoms/1000,'%Y-%m-%d') as birth_date "),
                DB::raw("FROM_UNIXTIME(sleep_date/1000,'%Y-%m-%d') as sleep_date "),
                DB::raw("FROM_UNIXTIME(insulation_date/1000,'%Y-%m-%d') as insulation_date "),
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
            ->whereIn('blocked_people.district_code', $filter_zones)
            ->whereBetween('blocked_people.check_date', [$from_date, $to_date])
            ->where($gender_col, $gender_op, $gender_v)
//            ->where($place_column, $op, $val)
            ->where($nationality_col, $nationality_op, $nationality_v)
            ->where($bp_type_col, $bp_type_op, $bp_type_v)
            ->orderByDesc('id')->get();


        return $data;
    }

    public function create()
    {
//        if (Auth::user()->can('manage pointTeams') == false)
//            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        return view('blockPersons.create');
    }


    public function getSumBlockPersonsAccordingForCenterData($government, $zone, $center, $gender, $from_date, $to_date, $type_query, $nationality)

    {
        $filter_zones = [];
        if ($zone == 'all' or $government == 'all') {
            $filter_zones = getZones_childs_ids($government,'district','getSumBlockPersons');
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

        if ($nationality == 'all')
            $nationalityCondition = '';
        elseif ($nationality == 'yemeni')
            $nationalityCondition = " and blocked_people.bp_from like '%$nationality%' ";

        else
            $nationalityCondition = " and blocked_people.bp_from not like '%$nationality%' ";


        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;


        //        zone_id,check_point_id,quarantine_area_id,last_zone_visit_id,if_transfer_where

        $data = DB::table('quarantine_areas')
            ->leftJoin('zones as Zone', 'quarantine_areas.zone_id', '=', 'Zone.code')
            ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.code')
            ->select('quarantine_areas.*',
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people 
                WHERE blocked_people.quarantine_area_id = quarantine_areas.id " . $dateCondition . $genderCondition . $nationalityCondition . "
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
                                   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleTransform"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.insulation_end_date  > 0 
                                   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleOut"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                                WHERE blocked_people.quarantine_area_id = quarantine_areas.id and
                                  blocked_people.insulation_end_date  is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null
                                   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleNotOut"),
                'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name'
            )
//
            ->whereIn('quarantine_areas.zone_id', $filter_zones)
            ->orderByDesc('id')->get();


        return $data;
    }


    public function getSumBlockPersonsAccordingForZoneData($government, $gender, $from_date, $to_date, $type_query, $nationality)

    {
        $filter_zones = [];
		
        if ($government == 'all') {
            $filter_zones  = getZones_childs_ids($government,'district','ZoneData');
        } else
            $filter_zones [] = $government;

        if ($gender == 'all')
            $genderCondition = '';
        else
            $genderCondition = " and blocked_people.gender like '%$gender%' ";
        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;

        if ($nationality == 'all')
            $nationalityCondition = '';
        elseif ($nationality == 'yemeni')
            $nationalityCondition = " and blocked_people.bp_from like '%$nationality%' ";

        else
            $nationalityCondition = " and blocked_people.bp_from not like '%$nationality%' ";
		
        $data = DB::table('zones')
            ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.code')
            ->select('zones.*', 'zones.name_ar as zone_name', 'ParentZone.name_ar as government_name',
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE zones.code = quarantine_areas.zone_id
                                 " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeople"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE zones.code = quarantine_areas.zone_id and blocked_people.if_dead_date > 1000 
                                 " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleDead"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                              WHERE zones.code = quarantine_areas.zone_id and  blocked_people.if_transfer_where > 0 
                                 " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleTransform"),
                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                            WHERE  zones.code = quarantine_areas.zone_id and   blocked_people.insulation_end_date  > 0 
                                 " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleOut"),

                DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                            WHERE  zones.code = quarantine_areas.zone_id and   blocked_people.insulation_end_date  is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null
                                 " . $dateCondition . $genderCondition . $nationalityCondition . "
                                ) 
                                as allBlockPeopleNotOut")
            )
			->whereIn('zones.parent', $filter_zones)
            ->orderByDesc('id')->get();

		return $data;
    }

    public function getSumBlockPersonsAccordingForGovernmentData($gender, $from_date, $to_date, $type_query, $nationality)

    {

        if ($gender == 'all')
            $genderCondition = '';
        else
            $genderCondition = " and blocked_people.gender like '%$gender%' ";

        if ($nationality == 'all')
            $nationalityCondition = '';
        elseif ($nationality == 'yemeni')
            $nationalityCondition = " and blocked_people.bp_from like '%$nationality%' ";

        else
            $nationalityCondition = " and blocked_people.bp_from not like '%$nationality%' ";


        $dateCondition = ' and blocked_people.check_date BETWEEN ' . $from_date . ' AND ' . $to_date;

        $cols = [
            'zones.*',
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT code FROM zones as subZones where subZones.parent=zones.code )
                                    " . $dateCondition . $genderCondition . $nationalityCondition . "
                                  ) 
                                as allBlockPeople"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT code FROM zones as subZones where subZones.parent=zones.code )
                                   and blocked_people.if_dead_date > 1000   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                  ) 
                                as allBlockPeopleDead"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT code FROM zones as subZones where subZones.parent=zones.code )
                                   and blocked_people.if_transfer_where > 0   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                  ) 
                                as allBlockPeopleTransform"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT code FROM zones as subZones where subZones.parent=zones.code )
                                   and    blocked_people.insulation_end_date  is null  and blocked_people.if_transfer_where is null
                                  and if_dead_date is null   " . $dateCondition . $genderCondition . $nationalityCondition . "
                                  ) 
                                as allBlockPeopleOut"),
            DB::raw("(SELECT count(blocked_people.id) FROM blocked_people
                INNER JOIN quarantine_areas ON quarantine_areas.id=blocked_people.quarantine_area_id
                                WHERE
                                  quarantine_areas.zone_id IN (SELECT code FROM zones as subZones where subZones.parent=zones.code )
                                   and  blocked_people.insulation_end_date  > 0    " . $dateCondition . $genderCondition . $nationalityCondition . "
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
            $filter_zones = getZones_childs_ids($government,'district','SumQuarantine');
        } else
            $filter_zones [] = $government;
		
		
        $types = QuarantineAreaType::all();
        $cols = ['zones.name_ar as zone_name', 'ParentZone.name_ar as government_name'];
        $cols[] = DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                                WHERE zones.code = quarantine_areas.zone_id
                                )
                                as allTypes");
        foreach ($types as $type) {
            $cols[] =
                DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                                WHERE zones.code = quarantine_areas.zone_id and  quarantine_areas.quarantine_area_type_id=" . $type->id . "
                                )
                                as type_$type->id");
        }

        $data = DB::table('zones')
            ->leftJoin('zones as ParentZone', 'zones.parent', '=', 'ParentZone.code')
            ->select($cols)->whereIn('zones.id', $filter_zones)
            ->get();
        return $data;
    }

    public function getSumQuarantineGovData()

    {
        $types = QuarantineAreaType::all();
        $cols = ['zones.name_ar as government_name'];
        $cols[] = DB::raw("(SELECT count(quarantine_areas.id) FROM quarantine_areas
                              INNER JOIN zones as SubZone ON quarantine_areas.zone_id=SubZone.code
                                WHERE 
                                zones.code = SubZone.parent 
                                )
                                as allTypes");
        foreach ($types as $type) {
            $cols[] =
                DB::raw("(SELECT count(quarantine_areas.id)
                 FROM quarantine_areas
                 INNER JOIN zones as SubZone ON quarantine_areas.zone_id=SubZone.code
                                WHERE 
                                zones.code = SubZone.parent and
                                  quarantine_areas.quarantine_area_type_id=" . $type->id . "
                                )
                                as type_$type->id");
        }

        $data = DB::table('zones')
            ->select($cols)->where('zones.parent', '=', 0)
            ->get();
        return $data;
    }

    public function filterBlockPersons(Request $request)
    {
        //government, zone, from_date, to_date, gender, workTeamType

        $center = $request->center;
        $government = $request->government;
        $zone = $request->zone;
        $nationality = $request->nationality;
        $type_query = $request->type_query;
        $gender = $request->gender;
        $from = ($request->from_date == null) ? date('0000-00-00') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $from = strtotime($from) * 1000;
        $to = strtotime($to) * 1000;

        //(Auth::user()->can('sumBlockPersons reports') == true) or
        //                              (Auth::user()->can('point_daily reports') == true) or
        //                              (Auth::user()->can('quarantines reports') == true) or
        //                              (Auth::user()->can('health_satiation reports') == true)
        if (
            ($type_query == 'sumBlockPersons'
                or ($type_query == 'sumBlockPersons_zone')
                or ($type_query == 'sumBlockPersons_gov')
            )
            and Auth::user()->can('sumBlockPersons reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        elseif (($type_query == 'truck_driver' or $type_query == 'people_in_port' or $type_query == 'runAway_block_peoples')
            and Auth::user()->can('point_daily reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        elseif (($type_query == 'quarantines_zone' or $type_query == 'quarantines_gov')
            and Auth::user()->can('quarantines reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        elseif (Auth::user()->can('sumBlockPersons reports') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        if ($type_query == 'sumBlockPersons')
            $data = $this->getSumBlockPersonsAccordingForCenterData($government, $zone, $center, $gender, $from, $to, $type_query, $nationality);
        elseif ($type_query == 'sumBlockPersons_zone')
            $data = $this->getSumBlockPersonsAccordingForZoneData($government, $gender, $from, $to, $type_query, $nationality);
        elseif ($type_query == 'sumBlockPersons_gov')
            $data = $this->getSumBlockPersonsAccordingForGovernmentData($gender, $from, $to, $type_query, $nationality);
        elseif ($type_query == 'quarantines_zone')
            $data = $this->getSumQuarantineData($government);
        elseif ($type_query == 'quarantines_gov')
            $data = $this->getSumQuarantineGovData();
        else
            $data = $this->getBlockPersonsData($government, $zone, $center, $gender, $from, $to, $type_query, $nationality);

        return datatables()->of($data)
            ->addIndexColumn()
            ->rawColumns([
            ])->make(true);

    }


}
