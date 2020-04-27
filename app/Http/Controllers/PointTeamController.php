<?php

namespace App\Http\Controllers;

use App\CheckPoint;
use App\QuarantineArea;
use App\WorkTeam;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PointTeamController extends Controller
{


    public function __construct()
    {
//        $this->middleware('auth');
//        $this->middleware('permission:manage admins', ['only' => ['j']]);
//        $this->middleware('permission:show admins', ['only' => ['index']]);
    }

    public function index($type = 'point', $id = 0)
    {
        if (Auth::user()->can('show pointTeams') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        if ($type == 'point' and $id > 0)
            $center = CheckPoint::find($id);
        elseif ($type != 'point' and $id > 0)
            $center = QuarantineArea::find($id);
        else
            $center = null;

//        return dd($center->zone->parent);
        return view('workTeams.point_teams')->with('workers_type', $type)->with('center', $center);

//                return dd($this->getTeamWorkerData('all','all','point','male'));
//        return datatables()->of($this->getTeamWorkerData('all','all','point','male'))
//            ->addIndexColumn()
//            ->addColumn('assign', 'workTeams.btn.assign')
//            ->rawColumns([
//                'assign',
//            ])->make(true);
    }

    public function getTeamWorkerData($government, $zone, $workTeamType, $gender, $from_date = '1920-01-01', $to_date = '9999-09-09')
    {
        $filter_zones = [];
        if ($zone == 'all' or $government == 'all') {
            $filter_zones = getZones_childs_ids($government);
        } else
            $filter_zones [] = $zone;
        $workTeamType = '%' . $workTeamType . '%';
        if ($gender == 'all') {
            $gender_v = 0;
            $gender_col = 'work_teams.id';
            $gender_op = '>';

        } else {
            $gender_v = '%' . $gender . '%';
            $gender_col = 'work_teams.gender';
            $gender_op = 'like';

        }


        $data = DB::table('work_teams')
            ->leftJoin('zones as Zone', 'work_teams.zone_id', '=', 'Zone.id')
            ->leftJoin('zones as ParentZone', 'Zone.parent', '=', 'ParentZone.id')
            ->leftJoin('point_teams', 'point_teams.work_team_id', '=', 'work_teams.id')
            ->leftJoin('check_points', 'point_teams.check_point_id', '=', 'check_points.id')
            ->leftJoin('health_teams', 'health_teams.work_team_id', '=', 'work_teams.id')
            ->leftJoin('quarantine_areas', 'health_teams.quarantine_area_id', '=', 'quarantine_areas.id')
            ->leftJoin('zones as pointZone', 'check_points.zone_id', '=', 'pointZone.id')
            ->leftJoin('zones as pointParentZone', 'pointZone.parent', '=', 'pointParentZone.id')
            ->leftJoin('zones as teamZone', 'work_teams.zone_id', '=', 'teamZone.id')
            ->leftJoin('zones as teamParentZone', 'teamZone.parent', '=', 'teamParentZone.id')
            ->select('work_teams.*',
                'quarantine_areas.name as quarantine_area_name', 'check_points.name as check_point_name',
                'teamZone.name_ar as team_zone_name', 'teamParentZone.name_ar as team_government_name',
                'pointZone.name_ar as point_zone_name', 'pointParentZone.name_ar as point_government_name',
                'Zone.name_ar as zone_name', 'ParentZone.name_ar as government_name')
//            ->WhereNotNull('work_teams.deleted_at')
            ->whereIn('work_teams.zone_id', $filter_zones)
            ->whereBetween('work_teams.birth_date', [$from_date, $to_date])
            ->where('work_teams.workType', 'like', $workTeamType)
            ->where($gender_col, $gender_op, $gender_v)
            ->orderByDesc('id')->get();


        return $data;
    }


    public function filterTeamWorker(Request $request)
    {
        //government, zone, from_date, to_date, gender, workTeamType

        $workTeamType = $request->workTeamType;
        $gender = $request->gender;
        $government = $request->government;
        $zone = $request->zone;
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getTeamWorkerData($government, $zone, $workTeamType, $gender, $from, $to);

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('assign', 'workTeams.btn.assign')
            ->rawColumns([
                'assign',
            ])->make(true);

    }


//changeDisputeBy

    public function filterPlace_type(Request $request)
    {
        $ids = [];
        if ($request->zone_id == 'all' and $request->government_id == 'all') {
            $zones = Zone::all()->where('parent', '>', 0);
            foreach ($zones as $zone) {
                $ids[] = $zone->id;
            }
        } elseif ($request->zone_id == 'all') {
            $zones = Zone::all()->where('parent', '=', $request->government_id);
            foreach ($zones as $zone) {
                $ids[] = $zone->id;
            }
        } else
            $ids[] = $request->zone_id;

        if ($request->type == 'point') {
            $data = CheckPoint::all()->whereIn('zone_id', $ids);
        } else {
            $data = QuarantineArea::all()->whereIn('zone_id', $ids);
        }
        $firstData = '';
        if ($request->type == 'point' and $request->point_id > 0) {
            $d = CheckPoint::find($request->point_id);
            $firstData = $this->getMembers($d);
        } elseif ($request->type != 'point' and $request->point_id > 0) {
            $d = QuarantineArea::find($request->point_id);
            $firstData = $this->getMembers($d);
        } elseif ($data->first() != null) {
            $data_members = $data->first();
            $firstData = $this->getMembers($data_members);
        }


        $select = ' ';
        if (isset($request->all) and $request->all == 'all')
            $select .= '<option value="all">' . trans('menu.all') . '</option>';

        foreach ($data as $info) {
            $select .= '<option value="' . $info->id . '"> ' . $info->name . '</option>';
        }

        return response(['select' => $select, 'firstData' => $firstData], 200);

    }

    public
    function changePointOrCenter(Request $request)
    {
        if ($request->type == 'point') {
            $data = CheckPoint::find($request->point);
        } else {
            $data = QuarantineArea::find($request->point);
        }
        $firstData = $this->getMembers($data);

        return response(['firstData' => $firstData], 200);

    }

    private
    function getMembers($data)
    {
        $firstData = '';
        foreach ($data->workTeams as $team) {
            $firstData .= '<div class="checkbox-fade fade-in-primary" id="member_row' . $team->id . '">
                            <input type="hidden" class="membersArray" value="' . $team->id . '" name="membersArray"> 
                                 <label>
                                    <button type="button" onclick="$(\'#member_row' . $team->id . '\').remove();"><i class="fa fa-trash"> </i></button>
                                </label>
                                <div> ' . $team->name . '</div>
                            </div>';

        }

        return $firstData;
    }

    public
    function savePointTeamList(Request $request)
    {
//   + '&point=' + $("#pointOrCenter_id").val()
//                    + '&type=' + $("#center_workTeamType").val()
//                    + '&membersArray=' + values,
        $u = explode(',', $request->membersArray);

        if ($request->type == 'point')
            $table = CheckPoint::find($request->point);
        else
            $table = QuarantineArea::find($request->point);

        $workMembers = WorkTeam::find($u);
        $table->workTeams()->sync($workMembers);
        $data = '';
        foreach ($workMembers as $k => $department) {
            $data .= ' <tr>
                                            <td>' . $department->name . '</td>
                                            <td>' . $department->id . '</td>
                                        </tr>  ';
        }

        return response(['departments' => $data, 'status' => 'success'], 200);


    }


}
