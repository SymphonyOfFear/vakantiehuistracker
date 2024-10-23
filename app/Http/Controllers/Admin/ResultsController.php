<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    public function index(AdminRequest $request)
    {
        $users = User::count();
        $permissions = Permission::count();
        return view('admin.dashboard', compact('users', 'permissions'));
    }

    public function checkAdminAccess(AdminRequest $request)
    {
        return $request;
    }
}
