<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PermissionRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;

class PermissionController extends Controller
{
    public function index(AdminRequest $request)
    {
        $roles = Role::all();
        return view('admin.permissions.index', compact('roles'));
    }

    public function edit($id, AdminRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::with('permissions')->get();
        return view('admin.permissions.edit', compact('permission', 'roles'));
    }

    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->validated());
        $permission->roles()->sync($request->input('roles', []));
        return redirect()->route('admin.permissions.index')->with('success', 'Permissie succesvol bijgewerkt.');
    }

    public function destroy($id, AdminRequest $request)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->with('success', 'Permissie succesvol verwijderd.');
    }


    public function roles(AdminRequest $adminRequest, PermissionRequest $request)
    {
        $roles = Role::with('permissions')->get();

        $selectedRole = null;
        $permissions = Permission::all();

        if ($request->has('role')) {
            $selectedRole = Role::findOrFail($request->get('role'));
        }

        return view('admin.permissions.index', compact('roles', 'selectedRole', 'permissions'));
    }
}
