<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

//        $this->middleware('guest')->except('logout');
    }

    public function login()
    {

        return view('auth.login');

    }


    public function logout()
    {
        auth()->logout();
//        Auth::guard(get_guard_name())->logout();
        return redirect()->route('home')->with('success', 'you logout successfully');
    }


    public function postlogin(Request $request)
    {

//        return dd('eeeeeeeeeeeeee');
        $credential_email = ['email' => $request->email, 'password' => $request->password, 'status' => 1];
        $credential_username = ['username' => $request->email, 'password' => $request->password, 'status' => 1];

//        $r = User::all()->where('email', 'like', $request->email)
//            ->where('password', 'like', Hash::make($request->password))
//            ->where('status', '=', 1)->count();
//        return dd(Auth::attempt($credential_email));
        //"$2y$10$H1aewqingjVnwT5CTIDJVOWm9kldf495Y3vP2Caq1XpMsO8E9Vnre"
        //  "$2y$10$qTyquJby7p5/uUP8CTygke6Y7ZgCGZE5pOSVNca7u4q.eA3XBUu6i"
        //"$2y$10$4eeMukQSyMsRPq1aQz5sxOSWnArfRk5SU4dKk8eMw.gvD.dSa33Uq"

        if (
            Auth::attempt($credential_email)
            or Auth::attempt($credential_username)
        ) {
            if (auth()->user()->work_team->workType != 'admin') {
//                return dd(auth()->user()->work_team->workType);
                session()->flash('auth.noAllow', 'ok');

                auth()->logout();
                return back();
            }
            else
                return redirect()->route('home');
        } else {
            session()->flash('auth.failed', 'ok');
            return back();

        }
    }


}
