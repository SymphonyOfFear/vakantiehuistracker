<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Types\Relations\Role as RelationsRole;
use Spatie\Permission\Contracts\Permission as ContractsPermission;

class ResultsController extends Controller
{
    // Dashboard 
    public function index()
    {



        $users = User::all()->count();
        $permissions = Permission::all()->count();

        return view('admin.dashboard', compact('users', 'permissions'));
    }

    // Users
    public function usersIndex()
    {
        $users = User::with('roles')->get(); // Fetch all users with their roles
        return view('admin.users.index', compact('users'));
    }

    // Permissions
    public function permissionsIndex()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('roles', 'permissions'));
    }

    // Settings 
    public function settings()
    {
        return view('admin.settings');
    }

    public function edit()
    {
        return view('admin.users.edit');
    }
    public function destroy() {}
}
