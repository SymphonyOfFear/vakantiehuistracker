<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    // Index pagina met de totale gebruikers / permissies
    // de request wordt gebruikt om te checken of die een admin is
    public function index()
    {
        $users = User::count();
        $permissions = Permission::count();
        return view('admin.dashboard', compact('users', 'permissions'));
    }
    // Checken of de gebruiker toegang heeft tot de pagina
    public function checkAdminAccess(AdminRequest $request)
    {
        $users = User::count();
        $permissions = Permission::count();
        if ($request->authorize()) {
            return view('admin.dashboard', compact('users', 'permissions'));  // Or appropriate view for the admin dashboard
        }

        return redirect()->route('home');
    }
}
