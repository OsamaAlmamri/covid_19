<?php

use App\Category;
use App\Section;
use App\Truck;
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

if (!function_exists('getAdminsOrderNotifucationIds')) {
    function getAdminsOrderNotifucationIds()
    {
        $admins = \App\Admin::all('id');
        $ids = [];
        foreach ($admins as $admin) {
            $ids[] = $admin->id;
        }
        return $ids;
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

    function getAllPriority()
    {
        return [
            'low' => trans('task.priority.low'),
            'medium' => trans('task.priority.medium'),
            'high' => trans('task.priority.high'),
            'very_high' => trans('task.priority.very_high'),
        ];
    }

    function getAllTaskStatus()
    {
        return [
            'new' => trans('task.status.new'),
            'assign' => trans('task.status.assign'),
            'inProgress' => trans('task.status.inProgress'),
            'complete' => trans('task.status.complete'),
            'rejected' => trans('task.status.rejected'),
            'approved' => trans('task.status.approved'),
        ];
    }

    function getAllPhaseStatus()
    {
        return [
            'new' => trans('phase.status.new'),
            'inProgress' => trans('phase.status.inProgress'),
            'complete' => trans('phase.status.complete'),
        ];
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

    function getProjectTeams($project)
    {
        $users = $project->users;
        $allUsers = [];
        foreach ($users as $user) {
            $allUsers[$user->id] = $user->name;
        }
        return $allUsers;
    }

    function getProjectServeceIds($project_id)
    {
        $project = \App\Project::find($project_id);
        $allPhases = [];
        foreach ($project->phases as $p) {
            $allPhases[] = $p->id;
        }
        return $allPhases;
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

    function getProjectTeam($project)
    {
        $users = $project->users;
        $allUsers = [];
        foreach ($users as $user) {
            $allUsers[] = $user->id;
        }
        return $allUsers;
    }

    function countCourseStudents($id)
    {
        $c = \App\OpenCourse::find($id);
        return count($c->students);
//    return $id;
    }

    function getCourePrice($id)
    {
        $c = \App\OpenCourse::withTrashed()->find($id);
        return $c->price;
//    return $id;
    }

    function orderStatus()
    {
        return ['all' => trans('order.status.all'),
            'ORDERED' => trans('order.status.ORDERED'),
            'ASSIGNED' => trans('order.status.ASSIGNED'),
            'RECEIVED' => trans('order.status.RECEIVED'),
            'CANCELLED' => trans('order.status.CANCELLED'),
            'SEARCHING' => trans('order.status.SEARCHING'),
            'NOTFOUND' => trans('order.status.NOTFOUND'),
            'FOUND' => trans('order.status.FOUND'),
            'INCOMING' => trans('order.status.INCOMING'),
            'REACHED' => trans('order.status.REACHED'),
            'DELIVERY' => trans('order.status.DELIVERY'),
            'NOTPAID' => trans('order.status.NOTPAID'),
            'COMPLETED' => trans('order.status.COMPLETED')
        ];
    }

    function orderDisputesStatus()
    {
        return ['all' => trans('order.dispute.all'),
            'assign' => trans('order.dispute.assign'),
            'not_assign' => trans('order.dispute.notAssign'),

        ];
    }

    function orderDisputesByStatus()
    {
        return ['all' => trans('order.dispute.all'),
            'admin' => trans('order.dispute.admin'),
            'user' => trans('order.dispute.user'),
            'customer' => trans('order.dispute.customer'),

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

    function searchTruck($request)
    {
        $height = 0;
        $width = 0;
        $ton = 0;
        $modal = '%%';
        $type = '%%';
        $moreThanLength = 0;
        $lessThanLength = 1000000;
        if (isset($request->modal) and $request->modal != null and $request->modal != 'الكل')
            $modal = '%' . $request->modal . '%';
        if (isset($request->type) and $request->type != null and $request->modal != 'الكل')
            $type = '%' . $request->type . '%';
        if (isset($request->ton) and $request->ton != null)
            $ton = $request->ton;
        if (isset($request->width) and $request->width != null)
            $width = $request->width;
        if (isset($request->height) and $request->height != null)
            $height = $request->height;
        if (isset($request->moreThanLength) and $request->moreThanLength != null)
            $moreThanLength = $request->moreThanLength;
        if (isset($request->lessThanLength) and $request->lessThanLength != null)
            $lessThanLength = $request->lessThanLength;

        $trucks = Truck::where('height', '>=', $height)
            ->where('width', '>=', $width)
            ->where('maxCapacity', '>=', $ton)
            ->where('modal', 'LIKE', $modal)
            ->where(function ($query) use ($type) {
                $query->where('type_en', 'like', $type)
                    ->orWhere('type_ar', 'like', $type);
            })
            ->whereBetween('length', [$moreThanLength, $lessThanLength])->get();
        $trucks_ids = [];
        foreach ($trucks as $truck) {
            $trucks_ids[] = $truck->id;

        }
        $from_zone = 'all';
        $to_zone = 'all';
        if (isset($request->from) and $request->from)
            $from_zone = $request->from;

        if (isset($request->to) and $request->to)
            $to_zone = $request->to;

        $f_zones_id = getZones_childs_ids($from_zone);
        $to_zones_id = getZones_childs_ids($to_zone);
        if (isset($request->from) and $request->from)
            $f_zones_id[] = $from_zone;
        if (isset($request->to) and $request->to)
            $to_zones_id[] = $to_zone;

        $customers = DB::table('customers')
//                ->leftJoin('admins', 'customers.created_by', '=', 'admins.id')
            ->leftJoin('zones', 'customers.current_location', '=', 'zones.id')
            ->leftJoin('zones as governorate_current_location', 'zones.parent', '=', 'governorate_current_location.id')
            ->leftJoin('zones as governorate_zone', 'customers.governorate_id', '=', 'governorate_zone.id')
            ->leftJoin('zones as zone_zone', 'customers.zone_id', '=', 'zone_zone.id')
            ->leftJoin('trucks', 'customers.truck_id', '=', 'trucks.id')
            ->leftJoin('companies', 'customers.company_id', '=', 'companies.id')
            ->select('customers.name', 'customers.phone', 'customers.status', 'customers.created_by as ',
                'customers.attester_1_id', 'customers.attester_2_id', 'customers.current_location', 'customers.governorate_id',
                'customers.zone_id',
                'customers.id as customer_id',
                'customers.truck_image',
                'companies.name as company_name',
                'zones.name_ar as zone_current_location_ar', 'zones.name_en as zone_current_location_en',
                'governorate_current_location.name_ar as governorate_current_location_ar', 'governorate_current_location.name_en as governorate_current_location_en',
                'governorate_zone.name_ar as governorate_zone_ar', 'governorate_zone.name_en as governorate_zone_en',
                'zone_zone.name_ar as zone_zone_ar', 'zone_zone.name_en as zone_zone_en',
                'trucks.*'/*, 'admins.name as created_by_name'*/)
            ->WhereNull('customers.deleted_at')
            ->whereIn('customers.truck_id', $trucks_ids)
            ->where('customers.status', '=', 1)
            ->where(function ($query) use ($f_zones_id) {
                $query->whereIn('customers.current_location', $f_zones_id)
                    ->orWhereIn('customers.zone_id', $f_zones_id);
            })
            ->where(function ($query) use ($to_zones_id) {
                $query->whereIn('customers.current_location', $to_zones_id)
                    ->orWhereIn('customers.zone_id', $to_zones_id);
            })
            ->where(function ($query) {
                $query->whereNotNull('customers.created_by')
                    ->orWhere(function ($query) {
                        $query->where('attester_2_confirm', '=', 1)
                            ->where('attester_1_confirm', '=', 1);
                    });
            })
            ->orderByDesc('id')->get();


        return $customers;
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


    function getZones($governorate_id = 0)
    {
        if ($governorate_id == 0) {
            $governorate = \App\Zone::where('parent', '=', '0')->first();
            if ($governorate != null)
                $governorate_id = $governorate->id;
            else
                return [];

        }


        $allZones = \App\Zone::all()->where('parent', '=', $governorate_id);

        $zones = [];
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
}


