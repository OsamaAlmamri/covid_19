<?php

namespace App\Http\Controllers;

use App\DataTables\CustomersDataTable;
use App\DataTables\UserDataTable;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UsersRequest;
use App\User;
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
        return view('users.create')
            ->with('roles', $this->permissionsForUsers());;
    }

//    public function store(UserRequest $request)
    public function store(UsersRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $avatar = saveImage('images/Users/' . $request['username'], $request->file('avatar'));
        $request['birthDate'] = setEntryDateAttribute($request['birthDate']);
        $request['join_date'] = setEntryDateAttribute($request['join_date']);
        $user = User::create(array_merge($request->all(),
            [
                'status' => 1,
                'avatar' => $avatar,
                'created_by' => Auth::user()->id,
            ]));
        (Auth::user()->can('manage superUsers') == true) ? $user->syncRoles([$request->role]) : $user->syncRoles(['Employee']);

        return redirect()->route('users.index', $request->type)->with('success', $request->role . ' add successfully');

    }

    public function update(UsersRequest $request, User $user)
    {
//        return dd($request);
        $avatar = updateImage('images/Users/' . $request['username'], $request->file('avatar'), $user->avatar);
        $request['birthDate'] = setEntryDateAttribute($request['birthDate']);
        $request['join_date'] = setEntryDateAttribute($request['join_date']);

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

        $User = User::find(decrypt($id));
//        return dd($User->profile);
//        if ($User->open_courses->count() > 0)
//            return redirect(route('Users.index'))->with('warning', 'Not allow to delete because this member has OpenCourses  ');
        $User->deleted_by = Auth::user()->id;
        $User->save();
        $User->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');


    }

    public function forceDelete($id)
    {

        $User = User::onlyTrashed()->find(decrypt($id));
        File::delete(public_path($User->avatar));
        $User->forceDelete();

        return redirect(route('users.index', 'deleted'))->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {

        $User = User::onlyTrashed()->find(decrypt($id));
        $User->restore();
        return redirect(route('users.index', 'deleted'))->with('success', 'User restored successfully');
    }

    public function destroy($id)
    {
        //
    }


}
