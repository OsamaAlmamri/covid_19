<?php

use App\HaraVil;
use App\SubDi;
use App\SubHaraVil;
use App\User;
use App\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;


if (!function_exists('currencydecimal')) {
    /**
     * Generate an currency path for the application.
     * @param $amount
     *
     * @return string
     */
    function currencydecimal($amount)
    {
//        $symbol = Setting::get('currency', '₹');
        $amount = number_format($amount, 2, '.', '');
        return $amount;
//        return $symbol . $amount;
    }
}

if (!function_exists('HostUrl')) {
    function HostUrl($url = null)
    {
        if (url('') == 'http:/xxxxxx.com')
            return url('xxxxx/public/' . $url);
        else
            return url($url);
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            if (setting('default_lang') != null)
                return setting('default_lang');
            else
                return 'ar';
        }
    }
}
if (!function_exists('get_guard_name')) {
    function get_guard_name()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        } elseif (Auth::guard('customer')->check()) {
            return "customer";
        } elseif (Auth::guard('company')->check()) {
            return "company";
        } elseif (Auth::guard('web')->check()) {
            return "web";
        }
    }
}
if (!function_exists('get_api_guard_name')) {
    function get_api_guard_name($type)
    {
        if ($type == 'customer')
            return "customerApi";
        else
            return "api";
    }
}
if (!function_exists('get_guard_auth_name')) {
    function get_guard_auth_name()
    {
        if (Auth::guard('admin')->check()) {
            return "admin";
        } elseif (Auth::guard('customer')->check()) {
            return "customer";
        } elseif (Auth::guard('company')->check()) {
            return "company";
        } elseif (Auth::guard('web')->check()) {
            return "auth";
        }
    }
}
if (!function_exists('getOtherLang')) {
    function getOtherLang()
    {
        if (session()->has('lang') and session('lang') == 'ar') {
            return 'en';
        } else {
            return 'ar';
        }
    }
}


if (!function_exists('datatable_lang')) {
    function datatable_lang()
    {
        return [
            'sEmptyTable' => trans('dataTable.sEmptyTable'),
            'sInfo' => trans('dataTable.sInfo'),
            'sInfoEmpty' => trans('dataTable.sInfoEmpty'),
            'sInfoFiltered' => trans('dataTable.sInfoFiltered'),
            'sInfoPostFix' => trans('dataTable.sInfoPostFix'),
            'sLengthMenu' => trans('dataTable.sLengthMenu'),
            'sInfoThousands' => trans('dataTable.sInfoThousands'),
            'sLoadingRecords' => trans('dataTable.sLoadingRecords'),
            'sProcessing' => trans('dataTable.sProcessing'),
            'sZeroRecords' => trans('dataTable.sZeroRecords'),
            'sSearch' => trans('dataTable.sSearch'),
            'oPaginate' => [
                'sNext' => trans('dataTable.sNext'),
                'sPrevious' => trans('dataTable.sPrevious'),
                'sFirst' => trans('dataTable.sFirst'),
                'sLast' => trans('dataTable.sLast'),
            ],
            'oAria' => [
                'sSortAscending' => trans('dataTable.sSortAscending'),
                'sSortDescending' => trans('dataTable.sSortDescending'),
            ],
        ];

    }
}


function pageParse($content)
{
    return eval('?>' . $content);
}


function updateUserRole($user_id, $role)
{
    $user = User::find($user_id);
    $user->syncRoles([$role]);
    return;
}

function getUserRole($user_id)
{
    $user = User::find($user_id);
    return $user->getRoleNames();
}

function getFirstRole($user_id)
{
    $user = \App\User::withTrashed()->find($user_id);
    $roles = $user->getRoleNames()->first();
    if (($roles != null))
        $r = Role::all()->where('name', $roles)->first();

    return (($roles == null) ? null : $r->id);
}

function getRole($user_id)
{
    $user = \App\User::withTrashed()->find($user_id);
    $roles = $user->getRoleNames();
    return $roles;
}

function getAllRole()
{
    $roles = Role::all();
    $allRoles = [];
//    return dd(auth()->user()->getRoleNames()->first());
    foreach ($roles as $role) {
        if (auth()->user()->getRoleNames()->first() === 'SuperAdmin') {
            if ($role->name != 'Developer')
                $allRoles[$role->id] = $role->name;
        } else {
            if ($role->name != 'SuperAdmin' or $role->name != 'Developer')
                $allRoles[$role->id] = $role->name;
        }
    }
    return $allRoles;
}


function getRatio($n1, $n2)
{
    if ($n2 == 0)
        return 0;
    else
        return ($n1 / $n2) * 100;

}

function dateViewFormat($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return Carbon::parse($date)->day . '/' . Carbon::parse($date)->monthName . '/' . Carbon::parse($date)->year;
}

function dateFormFormat($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return Carbon::parse($date)->month . '/' . Carbon::parse($date)->day . '/' . Carbon::parse($date)->year;
}

function getAllManagers()
{
    $users = User::all();
    $allUsers = [];
    foreach ($users as $user) {
        $allUsers[$user->id] = $user->username;
    }
    return $allUsers;
}

function getAllWorker()
{
    $users = \App\WorkTeam::all();
    $allUsers = [];
    foreach ($users as $user) {
        $allUsers[$user->id] = $user->name . '/' . $user->workType;
    }
    return $allUsers;
}


function workTeamTypes()
{
    return ['point' => trans('menu.work_point'),
        'health' => trans('menu.work_health'),
//        'admin' => trans('menu.admin'),


    ];
}


function getReporsType()
{

    return [
        'all' => trans('menu.all'),
        'block_persons' => trans('menu.sumBlockPersons'),
        'sumBlockPersons_zone' => trans('menu.sumBlockPersons_zone'),
        'sumBlockPersons_gov' => trans('menu.sumBlockPersons_gov'),
        'quarantines_gov' => trans('menu.quarantines_gov'),
        'quarantines_zone' => trans('menu.quarantines_zone'),
        'quarantines_reports' => trans('menu.quarantines_reports'),
        'point_daily_reports' => trans('menu.point_daily_reports'),
        'people_in_port' => trans('menu.people_in_port'),
        'truck_driver' => trans('menu.truck_driver'),
    ];
}

function getUserName($id)
{

    $u = \App\User::withTrashed()->find($id);
    if ($u)
        return $u->name;
    else
        return "";
}

function getZones_childs_ids($parent, $type = 'district', $op = 'getSumBlockPersons')
{

    if ($parent == 'all') {
        switch ($type) {
            case 'gov':
                $to_zones = Zone::all()->where('id', '<', 24);
                break;
            case 'district':
                $to_zones = Zone::all()->where('id', '>', 23);
                break;
            case 'hara_vil':
                $to_zones = HaraVil::all()->where('type', 'like', $type);
                break;
            case 'sub_hara_vil':
                $to_zones = SubHaraVil::all()->where('type', 'like', $type);
                break;
            case 'sub_dis':
                $to_zones = SubDi::all()->where('type', 'like', $type);
                break;
        }
    } else {
        switch ($type) {
            case 'gov':
                $to_zones = Zone::all()->where('id', '<', 24);
                break;
            case 'district':
                $to_zones = Zone::all()->where('id', '>', 23)->where('parent', '=', $parent);
                break;
            case 'hara_vil':
                $to_zones = HaraVil::all()->where('type', 'like', $type)->where('parent', '=', $parent);
                break;
            case 'sub_hara_vil':
                $to_zones = SubHaraVil::all()->where('type', 'like', $type)->where('parent', '=', $parent);
                break;
            case 'sub_dis':
                $to_zones = SubDi::all()->where('type', 'like', $type)->where('parent', '=', $parent);
                break;
        }
    }

    $to_Zone_ids = [];
    foreach ($to_zones as $zone) {
//		if($op != 'getSumBlockPersons')
//			$to_Zone_ids[] = $zone->parent;
//		else
        $to_Zone_ids[] = $zone->code;
    }

    return $to_Zone_ids;
}

function getGovernorates()
{
    $allGovernorate = \App\Zone::all()->where('parent', '=', 0);
    $governorates = [];
    foreach ($allGovernorate as $governorate) {
        $governorates[$governorate->code] = $governorate->name_ar;
    }

    return $governorates;
}

function getGovernorateToWork()
{
    $allGovernorate = \App\Zone::all()->where('parent', '=', 0);
    $governorates = [];
    $governorates[0] = trans('menu.all');

    foreach ($allGovernorate as $governorate) {
        $governorates[$governorate->code] = $governorate->name_ar;
    }

    return $governorates;
}


function getAllCustomers()
{
    $allcustomers = DB::table('customers')
        ->whereNotNull('created_by')
        ->orWhere(function ($query) {
            $query->where('attester_2_confirm', '=', 1)
                ->where('attester_1_confirm', '=', 1);
        })->get();

    $customers = [];
    foreach ($allcustomers as $customer) {
        $customers[$customer->id] = $customer->name;
    }

    return $customers;

}

function getAllQuarantineTyprs()
{
    $all = \App\QuarantineAreaType::all();
    $types = [];
    foreach ($all as $type) {
        $types[($type->id)] = $type->name;
    }

    return $types;

}

function getAllQuarantineTypeInfo()
{
    $all = \App\QuarantineAreaType::all();

    return $all;
    $d = [];
//    foreach ($all as $t)
//        $d[] = array(
//            'name' => 'type_' . $t->id,
//            'data' => 'type_' . $t->id,
//            'title' => $t->id,
//        );
//    return json_encode($d);

//        'name': 'type_{{$t->id}}',
//                'data': 'type_{{$t->id}}',
//                'title': "{{$t->name}}",
//            }
//}

}

function getZones($governorate_id = 0, $type = 'district', $withAll = 0)
{


    if ($governorate_id === 0) {
        $governorate = \App\Zone::where('parent', '=', '0')->first();
        if ($governorate != null)
            $governorate_id = $governorate->code;
        else
            return [];

    }
    $allZones = [];
    if ($governorate_id == 'all') {
        switch ($type) {
            case 'gov':
                $allZones = Zone::all()->where('type', 'like', $type)->where('parent', '>', 0);
                break;
            case 'district':
                $allZones = Zone::all()->where('type', 'like', $type)->where('parent', '>', 0);
                break;
            case 'hara_vil':
                $allZones = HaraVil::all()->where('type', 'like', $type)->where('parent', '>', 0);
                break;
            case 'sub_hara_vil':
                $allZones = SubHaraVil::all()->where('type', 'like', $type)->where('parent', '>', 0);
                break;
            case 'sub_dis':
                $allZones = SubDi::all()->where('type', 'like', $type)->where('parent', '>', 0);
                break;
        }
    } else {
        switch ($type) {
            case 'gov':
                $allZones = Zone::all()->where('parent', '=', $governorate_id);
                break;
            case 'district':
                $allZones = Zone::all()->where('parent', '=', $governorate_id);
                break;
            case 'hara_vil':
                $allZones = HaraVil::all()->where('parent', '=', $governorate_id);
                break;
            case 'sub_hara_vil':
                $allZones = SubHaraVil::all()->where('parent', '=', $governorate_id);
                break;
            case 'sub_dis':
                $allZones = SubDi::all()->where('parent', '=', $governorate_id);
                break;
        }
    }

    $zones = [];
    if ($withAll == 1)
        $zones['all'] = trans('menu.all');

    foreach ($allZones as $zone) {
        $zones[($zone->code)] = $zone->name_ar;
    }
    return $zones;

}


function setEntryDateAttribute($input)
{
    return Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
}

function dateFormat($date)
{
    $y = '';
    if (isset($date)) {
        $x = (explode('-', $date));
        $y = $x[1] . '/' . $x[2] . '/' . $x[0];
    }
    return $y;

}

function saveImage($folder, $file)
{
    $folder = '/' . $folder . '/';


    $Image = '';
    if ($file) {
        $Image = time() . $file->getClientOriginalName();
        $file->move(public_path($folder), $Image);
        return $folder . $Image;
    }
    return $folder . 'default.png';
}


function updateImage($folder, $file, $old_image)
{
    $folder = '/' . $folder . '/';
    if ($file) {
        $Image = time() . $file->getClientOriginalName();
        $file->move(public_path($folder), $Image);
        if ($old_image != $folder . 'default.png')
            File::delete(public_path($old_image));
        return $folder . $Image;
    }
    return $old_image;
}
