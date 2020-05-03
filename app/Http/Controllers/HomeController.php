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



        $all = $users = User::all()->count();
        $dataEntry = User::role('dataEntry')->count();
        $admins = User::role('Admin')->count();
        $SuperAdmin = User::role('SuperAdmin')->count();

        $district = Zone::all()->where('parent', '>', 0)->where('type', 'like','district')->count();
        $sub_dis = SubDi::all()->where('parent', '>', 0)->where('type', 'like','sub_dis')->count();
        $hara_vil = HaraVil::all()->where('parent', '>', 0)->where('type', 'like','hara_vil')->count();
        $sub_hara_vil = SubHaraVil::all()->where('parent', '>', 0)->where('type', 'like','sub_hara_vil')->count();
        $governments = Zone::all()->where('parent', '=', 0)->count();
        $quarantines = QuarantineArea::all()->count();
        $checkPoints = CheckPoint::all()->count();

        $workTeams = WorkTeam::all()->count();
        $workTeams_male = WorkTeam::all()->where('gender', '=', 'male')->count();
        $workTeams_female = WorkTeam::all()->where('gender', '=', 'female')->count();
        $s_healthTeams = HealthTeam::all()->count();
        $s_pointTeams = PointTeam::all()->count();
        $s_block_persons = BlockedPerson::all()->count();
        $block_persons_male = BlockedPerson::all()->where('gender', '=', 'male')->count();
        $block_persons_female = BlockedPerson::all()->where('gender', '=', 'female')->count();


        return view('home')->with([
            'allUsers' => $all,
            'dataEntry' => $dataEntry,
            'admins' => $admins + $SuperAdmin,

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
