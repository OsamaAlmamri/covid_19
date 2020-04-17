<?php

namespace App\Http\Controllers;


use App\Rules\MatchOldPassword;
use App\User;
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

//        $qr = DaysQr::all()->last()->name;
//        return dd(   $qr->created_at);
////        return dd(    Carbon::today()->day);
//        return dd(    $qr->created_at->day);
//        return dd(    Carbon::());

//        return dd(auth()->user()->hasRole('SuperAdmin'));

//        if (auth()->user()->hasRole('SuperAdmin') or auth()->user()->hasRole('Admin')) {

        $all = $users = User::all()->count();
        $employee = 0;
        $admins = 0;
        $SuperAdmin = 0;
//        $employee = $users = User::role('Employee')->count();
//        $admins = $users = User::role('Admin')->count();
//        $SuperAdmin = $users = User::role('SuperAdmin')->count();
        $projects = 0;
        $periods = 0;
        $qrs = 0;
        $tasks = 0;

//        } else {
////            $tasks = Task::all()->where('user_i')->count();
//
//        }


        return view('home')->with([
            'allUsers' => $all,
            'employees' => $employee,
            'admins' => $admins + $SuperAdmin,
            'projects' => $projects,
            'periods' => $periods,
            'qrs' => $qrs,
            'tasks' => $tasks,
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
