<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionsController extends Controller
{
    //
    public function __construct()
    {

//        $this->middleware('auth');
//        $this->middleware('permission:show permissions', ['only' => ['index']]);
//        $this->middleware('permission:manage permissions', ['only' => ['create', 'edit', 'update', 'delete', 'deleteMulti']]);
//        $this->middleware('permission:manage deleted permissions', ['only' => ['deleted', 'forceDelete', 'restore', 'delete']]);

    }

    private function addRoles()
    {
        $role = Role::create(['guard_name' => 'web', 'name' => 'SuperAdmin']);
        $role = Role::create(['guard_name' => 'web', 'name' => 'Admin']);
        $role = Role::create(['guard_name' => 'web', 'name' => 'DataEntry']);
    }

    private function addPermissions()
    {
        ///////////////////////
        //php artisan cache:forget spatie.permission.cache
        //php artisan cache:clear
        /////////////////////////////
        /********************* Permissions  *********************/
        $permission = Permission::create(['name' => 'show permissions']);
        $permission = Permission::create(['name' => 'manage permissions']);//add ,update , delete
        $permission = Permission::create(['name' => 'setup permissions']);//restore forceDelete

        /*********************Super Admins  *********************/
        $permission = Permission::create(['name' => 'show superAdmins']);
        $permission = Permission::create(['name' => 'active superAdmins']);
        $permission = Permission::create(['name' => 'manage superAdmins']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted superAdmins']);//restore forceDelete

        /********************* Admins  *********************/
        $permission = Permission::create(['name' => 'show admins']);
        $permission = Permission::create(['name' => 'active admins']);
        $permission = Permission::create(['name' => 'manage admins']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted admins']);//restore forceDelete

        /********************* Users  *********************/
        $permission = Permission::create(['name' => 'show users']);
        $permission = Permission::create(['name' => 'active users']);
        $permission = Permission::create(['name' => 'manage users']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted users']);//restore forceDelete

        /********************* healthTeams  *********************/
        $permission = Permission::create(['name' => 'show healthTeams']);
        $permission = Permission::create(['name' => 'active healthTeams']);
        $permission = Permission::create(['name' => 'manage healthTeams']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted healthTeams']);//restore forceDelete

        /********************* Reports  *********************/
        $permission = Permission::create(['name' => 'show Reports']);

        /********************* quarantines  *********************/
        $permission = Permission::create(['name' => 'show blockPersons']);
        $permission = Permission::create(['name' => 'active blockPersons']);
        $permission = Permission::create(['name' => 'manage blockPersons']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted blockPersons']);//restore forceDelete

        /********************* quarantines  *********************/
        $permission = Permission::create(['name' => 'show quarantines']);
        $permission = Permission::create(['name' => 'active quarantines']);
        $permission = Permission::create(['name' => 'manage quarantines']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted quarantines']);//restore forceDelete

        /********************* quarantineTypes   *********************/
        $permission = Permission::create(['name' => 'show quarantineTypes']);
        $permission = Permission::create(['name' => 'manage quarantineTypes']);//add ,update , delete

        /********************* checkPoints  *********************/
        $permission = Permission::create(['name' => 'show checkPoints']);
        $permission = Permission::create(['name' => 'active checkPoints']);
        $permission = Permission::create(['name' => 'manage checkPoints']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted checkPoints']);//restore forceDelete

        /********************* pointTeams  *********************/
        $permission = Permission::create(['name' => 'show pointTeams']);
        $permission = Permission::create(['name' => 'active pointTeams']);
        $permission = Permission::create(['name' => 'manage pointTeams']);//add ,update , delete
        $permission = Permission::create(['name' => 'manage deleted pointTeams']);//restore forceDelete


    }
/// Create a superadmin role for the admin days_qrs
//$role = Role::create(['guard_name' => ['admin', 'web', 'api'], 'name' => 'superadmin']);
//
//// Define a `publish articles` permission for the admin customer belonging to the admin guard
//$permission = Permission::create(['guard_name' => ['admin', 'web', 'api'], 'name' => 'publish articles']);
//
//// Define a *different* `publish articles` permission for the regular customer belonging to the web guard
//$permission = Permission::create(['guard_name' => ['admin', 'web', 'api'], 'name' => 'publish articles']);


// get a list of all permissions directly assigned to the user
//$permissionNames = $user->getPermissionNames(); // collection of name strings
//$permissions = $user->permissions; // collection of permission objects
//
//// get all permissions for the user, either directly, or from roles, or from both
//$permissions = $user->getDirectPermissions();
//$permissions = $user->getPermissionsViaRoles();
//$permissions = $user->getAllPermissions();

// get the names of the user's roles
//$roles = $user->getRoleNames(); // Returns a collection
    public function index()
    {

//        updateUserRole(auth()->user()->id, 'SuperAdmin');
        $roles = Role::all();
//        return dd(Role::all());
//        $this->addPermissions();
        return view('permissions.index')
            ->with('roles', $roles);
//        return var_dump("xxxxx");
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $RolePermission = $role->getAllPermissions();
        $oldRolePermission = [];
        foreach ($RolePermission as $old) {
            $oldRolePermission[] = $old->id;
        }
        $permissions = Permission::all();
        $subPermissins = [];
        foreach ($permissions as $permission) {
            $t = explode(' ', $permission->name);
            $t = $t[count($t) - 1];
            $subPermissins[$t][] = $permission;
        }
        return view('permissions.create')
            ->with('role', $role)
            ->with('oldRolePermission', $oldRolePermission)
            ->with('permissions', $subPermissins);


    }

    public function updateUserRole($user_id, $role)
    {
        $user = User::find($user_id);
        $user->syncRoles([$role]);

//        $user->assignRole($role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->name;
        $role->save;
        $permissions = isset($request->permissions) ? $request->permissions : [];
        $allPermissions = Permission::all()->whereIn('id', $permissions);
        $role->syncPermissions($allPermissions);
        return redirect()->route('permissions.index')->with('success', '  permissions updated successfully');
    }


}



