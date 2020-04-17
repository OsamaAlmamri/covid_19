<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;


class AdminAuth extends Controller
{


    public function login()
    {
        return view('admin.login');

    }


    public function dologin(Request $request)
    {
        //   dd($request->email);
        $rememberme = request('rememberme') == 1 ? true : false;

        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {

            return redirect('admin/home');

        } else {
            // session()->flush('error',);
            return redirect('admin/login')->with('error', trans('admin.inccorrect_information_login'));
        }
    }


    public function logout()
    {
        admin()->logout();
        return redirect('admin/login');
    }

    public function forgot_password()
    {
        return view('admin.forgot_password');
    }

    public function forgot_password_post()
    {
        $admin = Admin::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            //    Mail::to($admin->email)->send( new AdminResetPassword(['data'=>$admin,'token'=>$token]));
            // session()->flash('success', trans('admin.the_link_reset_send'));
            //  return back();
            return new AdminResetPassword(['data' => $admin, 'token' => $token]);

        }
        return back();

    }

    public function reset_password($token)
    {
        $check = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if (!empty($check)) {
            return view('admin.reset_password', ['data' => $check]);
        } else {
            return redirect('forgot/password');
        }
    }

    public function reset_password_final($token)
    {
        $this->validate(request(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ], [], [
            'password' => 'password',
            'password_confirmation' => ' confirmation password',
        ]);
        $check = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if (!empty($check)) {
            $admin = Admin::where('email', $check->email)->update([
                'email' => $check->email,
                'password' => bcrypt(request('password'))
            ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            admin()->attempt(['email' => $check->email, 'password' => request('password')], true);
            // admin()->login($admin);
            return redirect(aurl('home'));
        } else {
            return redirect('forgot/password');
        }
    }
}
