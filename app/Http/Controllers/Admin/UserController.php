<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(AdminRequest $request)
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id, AdminRequest $request)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(RoleRequest $request, $id, AdminRequest $adminRequest)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validated();

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        $user->roles()->sync([$validatedData['role']]);

        $selectedRole = Role::findOrFail($validatedData['role']);
        if (isset($validatedData['permissions'])) {
            $selectedRole->permissions()->sync($validatedData['permissions']);
        } else {
            $selectedRole->permissions()->detach();
        }

        return redirect()->route('admin.users.index')->with('success', 'User successfully updated.');
    }

    public function destroy($id, AdminRequest $request)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User successfully deleted.');
    }
}
