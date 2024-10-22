<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    // Dashboard 
    public function index()
    {
        // Get all permissions
        $permissions = Permission::count();
        $users = User::count();
        $userId = Auth::id();
        $user = User::find($userId);

        if ($role = $user->roles()->where('name', 'admin')->first()) {
            return view('admin.dashboard', compact('role', 'permissions', 'users'));
        } else {
            return redirect('home');
        }
        // Pass data to the view

    }

    // Users
    public function usersIndex()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($role = $user->roles()->where('name', 'admin')->first()) {
            $users = User::with('roles')->get();
            return view('admin.users.index', compact('users'));
        } else {
            return view('home');
        }
    }

    // Permissions
    public function permissionsIndex()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($role = $user->roles()->where('name', 'admin')->first()) {
            return view('admin.permissions.index');
        } else {
            return view('home');
        }
    }

    // Settings
    public function settings()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($role = $user->roles()->where('name', 'admin')->first()) {
            return view('admin.settings');
        } else {
            return view('home');
        }
    }

    public function edit()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($role = $user->roles()->where('name', 'admin')->first()) {
            return view('admin.users.edit');
        } else {
            return view('home');
        }
    }


    public function destroy()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        if ($role = $user->roles()->where('name', 'admin')->first()) {
        } else {
            return view('home');
        }
    }
}
