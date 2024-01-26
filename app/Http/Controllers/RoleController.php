<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if (!empty($request->query('keyword'))) {
            $roles = Role::orderBy('id', 'DESC')
                ->where('name', 'LIKE', '%' . $request->query('keyword') . '%')
                ->paginate(5);
        } else {
            $roles = Role::orderBy('id', 'DESC')->paginate(5);
        }
        return view('roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $permission = Permission::get();
        $permissionQTY = [];
        foreach ($permission as $row) {
            $permissionQTY[$row->group][$row->id]['id'] = $row->id;
            $permissionQTY[$row->group][$row->id]['name'] = $row->name;
            $permissionQTY[$row->group][$row->id]['description'] = $row->description;
        }
        return view('roles.create', compact('permissionQTY'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        Log::info('username : ' . auth()->user()->username . ' IP : ' . request()->ip() . ' | Role created successfully : ' . json_encode($request->all(), true));

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $permissionQTY = [];
        foreach ($permission as $row) {
            $permissionQTY[$row->group][$row->id]['id'] = $row->id;
            $permissionQTY[$row->group][$row->id]['name'] = $row->name;
            $permissionQTY[$row->group][$row->id]['description'] = $row->description;
        }
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('roles.edit', compact('role', 'permissionQTY', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        Log::info('username : ' . auth()->user()->username . ' IP : ' . request()->ip() . ' | Role updated successfully : ' . json_encode($request->all(), true));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $roles = Role::find($id);
        Log::info('username : ' . auth()->user()->username . ' IP : ' . request()->ip() . ' | Role destroy successfully : ' . json_encode($roles, true));
        $roles->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
