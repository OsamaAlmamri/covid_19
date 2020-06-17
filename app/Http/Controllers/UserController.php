<?php

namespace App\Http\Controllers;

use App\BlockedPerson;
use App\CheckPoint;
use App\DataTables\CustomersDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UsersRequest;
use App\QuarantineArea;
use App\User;
use App\WorkTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index($UserType = '')
    {

//        $_SESSION['lang']='ar';
        if (Auth::user()->can('show users') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $User = new UserDataTable($UserType);
        return $User->render('users.index', ['title' => 'Users', 'deleted' => ($UserType == '') ? false : true]);
    }


    private function permissionsForUsers()
    {

        return (Auth::user()->can('manage superUsers') == true) ?
            [
                'User' => 'User',
                'SuperUser' => 'SuperUser'
            ] : [
                'User' => 'User',
            ];
    }

    public function create()
    {
        if (Auth::user()->can('manage users') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        return view('users.create')
            ->with('roles', $this->permissionsForUsers());;
    }

//    public function store(UserRequest $request)
    public function store(UsersRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $avatar = saveImage('images/Users/' . $request['username'], $request->file('avatar'));
        $user = User::create(array_merge($request->all(),
            [
                'status' => 1,
                'avatar' => $avatar,
                'created_by' => Auth::user()->id,
            ]));
        (Auth::user()->can('manage superUsers') == true) ? $user->syncRoles([$request->role]) : $user->syncRoles(['DataEntry']);

        return redirect()->route('users.index', $request->type)->with('success', $request->role . ' add successfully');

    }

    public function update(UsersRequest $request, User $user)
    {
//        return dd($request);
        $avatar = updateImage('images/Users/' . $request['username'], $request->file('avatar'), $user->avatar);
        if ($request->password == '') {
            $user->update(array_merge($request->except('password'), ['avatar' => $avatar]));
        } else {
            $request['password'] = Hash::make($request->password);
            $user->update(array_merge($request->all(), ['avatar' => $avatar]));
        }
//        (Auth::user()->can('manage superAdmins') == true) ? $user->syncRoles([$request->role]) : $user->syncRoles(['Admin']);;
        $user->syncRoles([$request->role]);
        return redirect()->route('users.index')->with('success', '  User updated successfully');


    }


    public function permissions($id)
    {
        if (Auth::user()->can('manage permissions') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $role = getUserrRole($id)[0];
        $User = User::find($id);
        $directPermissions = $User->getDirectPermissions();
        $role = Role::where('name', 'like', $role)->first();
        $RolePermission = $role->getAllPermissions();
        $oldRolePermission = [];
        $alldirectPermissions = [];
        foreach ($RolePermission as $old) {
            $oldRolePermission[] = $old->id;
        }
        foreach ($directPermissions as $old) {
            $alldirectPermissions[] = $old->id;
        }
        $permissions = Permission::all();
        $subPermissins = [];
        foreach ($permissions as $permission) {
            $t = explode(' ', $permission->name);
            $t = $t[count($t) - 1];
            $subPermissins[$t][] = $permission;
        }
        return view('Users.permissions')
            ->with('User', $User)
            ->with('oldRolePermission', $oldRolePermission)
            ->with('directPermissions', $alldirectPermissions)
            ->with('permissions', $subPermissins);

    }

    public function updatePermissions(Request $request, $id)
    {
        if (Auth::user()->can('manage permissions') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
//        return dd($request);
        $user = User::find($id);
        $permissions = isset($request->permissions) ? $request->permissions : [];
        $allPermissions = Permission::all()->whereIn('id', $permissions);

        $user->syncPermissions($allPermissions);

        return redirect()->route('Users.index')->with('success', '  member permission updated successfully');

    }

    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $user = User::withTrashed()->find($r->id);
        $user->status = $new_status;
        $user->save();
        return $new_status;
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('users.create', compact('user'));
    }


    public function delete($id)
    {
        if (Auth::user()->can('manage users') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $User = User::find(decrypt($id));
        $b = BlockedPerson::all()->where('created_by',$User->id)->count();
        $u = User::all()->where('created_by', $User->id)->count();
        $w = WorkTeam::all()->where('created_by', $User->id)->count();
        $c = CheckPoint::all()->where('created_by', $User->id)->count();
        $q = QuarantineArea::all()->where('created_by', $User->id)->count();
//        return dd($User->profile);
        if ($b > 0 or $u > 0 or $w > 0 or $c > 0 or $q > 0)
            return redirect(route('Users.index'))->with('warning', 'غير مسمو ح بحذف هذا الحساب بسسب هناك بيانات مرتبطة بة ');
        $User->deleted_by = Auth::user()->id;
        $User->save();
        $User->delete();
        return redirect()->route('users.index')->with('success', 'تم الحذف بنجاح');


    }

    public function forceDelete($id)
    {
        if (Auth::user()->can('manage deleted users') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');
        $User = User::onlyTrashed()->find(decrypt($id));

        $b = BlockedPerson::all()->where('created_by',$User->id)->count();
        $u = User::all()->where('created_by', $User->id)->count();
        $w = WorkTeam::all()->where('created_by', $User->id)->count();
        $c = CheckPoint::all()->where('created_by', $User->id)->count();
        $q = QuarantineArea::all()->where('created_by', $User->id)->count();
//        return dd($User->profile);
        if ($b > 0 or $u > 0 or $w > 0 or $c > 0 or $q > 0)
            return redirect(route('users.index','deleted'))->with('warning', 'غير مسمو ح بحذف هذا الحساب بسسب هناك بيانات مرتبطة بة ');

        File::delete(public_path($User->avatar));
        $User->forceDelete();

        return redirect(route('users.index', 'deleted'))->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {
        if (Auth::user()->can('manage deleted users') == false)
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية الوصول');

        $User = User::onlyTrashed()->find(decrypt($id));
        $User->restore();
        return redirect(route('users.index', 'deleted'))->with('success', 'User restored successfully');
    }

    public function destroy($id)
    {
        //
    }

    public function AuthRouteAPI(Request $request)
    {
        return $request->user();
    }


}
