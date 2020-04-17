<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Settings;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {//  /********************* sections  *********************/


    }

    public function changeSetting(Request $request)
    {
        setting([$request->name => $request->val])->save();

        return $request;
    }

    public function settings(Request $request)
    {
        $lang_path = resource_path('lang');
        $listlang = array_diff(scandir($lang_path), array('..', '.'));
        return view('settings', compact('listlang'));
    }


    public function profile()
    {
        $admin = auth()->user();
        return view('profile', compact('admin'));

    }

    public function editProfile(ProfileRequest $request)
    {
        $admin = auth()->user();
        $avatar = updateImage('images/admins/' . $request['username'], $request->file('avatar2'), $admin->avatar);

//        return dd($avatar);
        if ($request->password == '') {
            $admin->update(array_merge($request->except('password'), ['avatar' => $avatar]));
        } else {
            $request['password'] = Hash::make($request->password);
            $admin->update(array_merge($request->all(), ['avatar' => $avatar]));
        }
        return redirect()->route('home')->with('success', ' profile updated successfully');


    }

    public function settings_store(Request $request)
    {

        $this->validate($request, [
            'site_logo' => 'mimes:jpeg,jpg,bmp,png||max:5242880',
        ]);
        try {

            $settings = $request->all();
            unset($settings['_token']);
            foreach ($settings as $key => $setting) {

                $temp_setting = Settings::where('key', $key)->first();

                if ($temp_setting) {


                    if ($request->file('RIPPLE_BARCODE') == null)
                    {
                        if ($temp_setting->value) {
                            $logo = updateImage('uploads/', $request->file('RIPPLE_BARCODE'), $temp_setting->value);
                        }
                        $temp_setting->value = $logo;

                    }
                    elseif ($temp_setting->key == 'ETHER_BARCODE') {
                        if ($request->file('ETHER_BARCODE') == null) {
                            $logo = updateImage('uploads/', $request->file('ETHER_BARCODE'), $temp_setting->value);

                        }
                        $temp_setting->value = $logo;

                    }
                    elseif ($temp_setting->key == 'site_favicon') {
                        if ($request->file('site_favicon') == null) {

                            $logo = updateImage('uploads/', $request->file('site_favicon'), $temp_setting->value);


                        }
                        $temp_setting->value = $logo;

                    }
                    elseif ($temp_setting->key == 'site_logo')
                    {

                        if ($request->file('site_logo') == null) {
                            $logo = $temp_setting->value;
                            $logo = updateImage('uploads/', $request->file('site_logo'), $temp_setting->value);

                        }
                        $temp_setting->value = $logo;
                    }
                    elseif ($temp_setting->key == 'currency') {
//                        $product_price = \App\ProductPrice::query();
//                        $product_price->update(['currency'=>$request->$key]);
//                        $temp_setting->value = $request->$key;

                    }
                    elseif ($temp_setting->key == 'client_secret') {
                        $client_secret = \DB::table('oauth_clients')->orderBy('id', 'desc')->first()->secret;

                        $temp_setting->value = $client_secret;
                    }
                    elseif ($temp_setting->key == 'payment_mode') {
                        $payment_mode = implode(',', $request->payment_mode);
                        $temp_setting->value = $payment_mode;
                    }
                    else {
                        $temp_setting->value = $request->$key;
                    }
                    $temp_setting->save();
                } else {
                    Setting::set($key, $setting);
                    Setting::save();
                }

            }
            return back()->with('flash_success', trans('form.resource.updated'));
        } catch
        (Exception $e) {
            return back()->with('flash_success', 'form.whoops');
        }

    }

    public function AccountSettingStore(Request $request)
    {
        try {
            Setting::set($request->key, $request->value);
            Setting::save();
            return back()->with('flash_success', trans('form.resource.updated'));
        } catch (Exception $e) {
            return back()->with('flash_danger', 'form.whoops');
        }
    }

}
