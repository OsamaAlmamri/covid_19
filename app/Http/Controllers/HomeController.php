<?php

namespace App\Http\Controllers;


use App\BlockedPerson;
use App\CheckPoint;
use App\HaraVil;
use App\HealthTeam;
use App\PointTeam;
use App\QuarantineArea;
use App\Rules\MatchOldPassword;
use App\SubDi;
use App\SubHaraVil;
use App\User;
use App\WorkTeam;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
//        $this->middleware('auth')->except('index');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        if (auth()->user()->government == 0)
            $government = 'all';
        else
            $government = auth()->user()->government;
        $filter_zones = getZones_childs_ids($government);


        $all = DB::table('users')
            ->leftJoin('work_teams', 'work_teams.id', '=', 'users.work_team_id')
            ->leftJoin('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->WhereNull('users.deleted_at');
        if (auth()->user()->getRoleNames()->first() !== 'Developer')
            $all = $all->where('roles.name', '<>', 'Developer');
        $all = $all->count();
        $dataEntry = User::role('dataEntry')->count();
        $admins = User::role('Admin')->count();
        $SuperAdmin = User::role('SuperAdmin')->count();
        $CheckPointAdmin = User::role('CheckPointAdmin')->count();
        $QuarantineAdmin = User::role('QuarantineAdmin')->count();

        $district = Zone::all()->where('parent', '>', 0)->where('type', 'like', 'district')->count();
        $sub_dis = SubDi::all()->where('parent', '>', 0)->where('type', 'like', 'sub_dis')->count();
        $hara_vil = HaraVil::all()->where('parent', '>', 0)->where('type', 'like', 'hara_vil')->count();
        $sub_hara_vil = SubHaraVil::all()->where('parent', '>', 0)->where('type', 'like', 'sub_hara_vil')->count();
        $governments = Zone::all()->where('parent', '=', 0)->count();
        $quarantines = QuarantineArea::all()->whereIn('zone_id', $filter_zones)->count();
        $checkPoints = CheckPoint::all()->whereIn('zone_id', $filter_zones)->count();

        $workTeams = WorkTeam::all()->whereIn('zone_id', $filter_zones)->count();
        $workTeams_male = WorkTeam::all()->whereIn('zone_id', $filter_zones)->where('gender', '=', 'male')->count();
        $workTeams_female = WorkTeam::all()->whereIn('zone_id', $filter_zones)->where('gender', '=', 'female')->count();
        $s_healthTeams = HealthTeam::all()->whereIn('zone_id', $filter_zones)->count();
        $s_pointTeams = PointTeam::all()->whereIn('zone_id', $filter_zones)->count();
        $all_block_persons = BlockedPerson::all()->whereIn('dest_zone_id', $filter_zones)->count();
        $not_block_persons = BlockedPerson::all()->whereIn('dest_zone_id', $filter_zones)->whereNull('quarantine_area_id')->count();
        $s_block_persons = BlockedPerson::all()->whereIn('quarantine_area_id',getQuarByZones($filter_zones) )->count();
        $block_persons_male = BlockedPerson::all()->whereIn('quarantine_area_id', getQuarByZones($filter_zones))->where('quarantine_area_id', '>', 0)->where('gender', '=', 'male')->count();
        $block_persons_female = BlockedPerson::all()->whereIn('quarantine_area_id', getQuarByZones($filter_zones))->where('quarantine_area_id', '>', 0)->where('gender', '=', 'female')->count();
//        $user->deleted_at=0;
//        $user['deleted_at']=0;

        return dd(getQuarByZones($filter_zones));
        $user = User::where('id', auth()->user()->id)->get();


        return view('home')->with([
            'allUsers' => $all,
            'dataEntry' => $dataEntry,
            'admins' => $admins + $SuperAdmin+$CheckPointAdmin+$QuarantineAdmin,

            'sub_hara_vil' => $sub_hara_vil,
            'hara_vil' => $hara_vil,
            'sub_dis' => $sub_dis,
            'district' => $district,
            'governments' => $governments,
            'quarantines' => $quarantines,
            'checkPoints' => $checkPoints,

            'workTeams' => $workTeams,
            'workTeams_male' => $workTeams_male,
            'workTeams_female' => $workTeams_female,

            's_healthTeams' => $s_healthTeams,
            's_pointTeams' => $s_pointTeams,

            'all_block_persons' => $all_block_persons,
            'not_block_persons' => $not_block_persons,
            's_block_persons' => $s_block_persons,
            'block_persons_male' => $block_persons_male,
            'block_persons_female' => $block_persons_female,


        ]);

//        date_default_timezone_set("Asia/Aden");

    }


    public function profile()
    {
        return view('profile');
    }

    public function erroe404()
    {
        return view('404');
    }

    public function change_image(Request $request)
    {
        $user = auth()->guard(get_guard_name())->user();
        if ($request->type == 'avatar') {
            $r = updateImage('images/' . get_guard_name() . '/' . $user->id, $request->file('file'), $user->avatar);
            $user->update(['avatar' => $r]);

        } else {
            $r = updateImage('images/' . get_guard_name() . '/' . $user->id, $request->file('file'), $user->truck_image);
            $user->update(['truck_image' => $r]);

        }

        return response(['data' => $r, 'status' => 'error'], 200);

    }


    public function changePassword(Request $request)
    {
        $match = new MatchOldPassword;
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', $match],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ],
            [
//                'current_password.required' => 'كلمة  المرور الحالية مطلوبة',
                'new_password.required' => 'كلمة  المرور الجديدة مطلوبة',
                'new_confirm_password.same' => 'كلمة  المرور الجديدة غير متطابقة ',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);

        }
        $user = auth()->guard(get_guard_name())->user();
        $user->update(['password' => Hash::make($request->new_password)]);
        return response()->json(['message' => 'تم تغيير كلمة المرور بنجاح ', 'status' => 'success'], 200);

    }

    public function changeProfile_info(ProfileRequest $request)
    {
//        return dd($request);
        $user = auth()->guard(get_guard_name())->user();
        $user->update($request->all());
        return redirect()->back()->with('success', ' تم تحديث المعلومات بنجاح ');


    }

    public function notifaction()
    {
        return view('profile');
    }


}
