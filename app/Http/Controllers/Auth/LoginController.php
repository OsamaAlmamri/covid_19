<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
//        return dd('d');
        return view('auth.login')->with('type', 'admin');

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

        if (
            Auth::attempt($credential_email)
            or Auth::attempt($credential_username)
        ) {

            return redirect()->route('home');
        } else {
            session()->flash('auth.failed', 'ok');
            return back();

        }
    }


}
