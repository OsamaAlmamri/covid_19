<?php

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
                return 'en';
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
    $roles = $user->getRoleNames();
    return isset($roles) ? null : $roles[0];
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
    foreach ($roles as $role) {
        $allRoles[$role->id] = $role->name;
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
        $allUsers[$user->id] = $user->name;
    }
    return $allUsers;
}

function getProjectTeams($project)
{
    $users = $project->users;
    $allUsers = [];
    foreach ($users as $user) {
        $allUsers[$user->id] = $user->name;
    }
    return $allUsers;
}


function assignUser($phase)
{
    $tasks = \App\Task::all()->where('phase_id', $phase->id);
    $allUsers = [];
    foreach ($tasks as $task) {
        if ($task->user != null)
            $allUsers[$task->user->id] = $task->user->id;
    }
    $allUsersData = User::all()->whereIn('id', $allUsers);
    return $allUsersData;
}


function workTeamTypes()
{
    return ['point' => trans('menu.work_point'),
        'health' => trans('menu.work_health'),

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

function getZones_childs_ids($parent)
{
//        $zone = Zone::find($parent);
    if ($parent == 'all')
        $to_zones = Zone::all();
    else
        $to_zones = Zone::all()->where('parent', '=', $parent);
    $to_Zone_ids = [];
    foreach ($to_zones as $zone) {
        $to_Zone_ids[] = $zone->id;
    }
    return $to_Zone_ids;
}

function getGovernorates()
{
    $allGovernorate = \App\Zone::all()->where('parent', '=', 0);
    $governorates = [];
    foreach ($allGovernorate as $governorate) {
        $governorates[$governorate->id] = $governorate->name_ar;
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

function getZones($governorate_id = 0, $withAll = 0)
{


    if ($governorate_id === 0) {
        $governorate = \App\Zone::where('parent', '=', '0')->first();
        if ($governorate != null)
            $governorate_id = $governorate->id;
        else
            return [];

    }

    if ($governorate_id == 'all')
        $allZones = \App\Zone::all()->where('parent', '>', 0);

    else
        $allZones = \App\Zone::all()->where('parent', '=', $governorate_id);

    $zones = [];
    if ($withAll == 1)
        $zones['all'] = trans('menu.all');

    foreach ($allZones as $zone) {
        $zones[($zone->id)] = $zone->name_ar;
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
