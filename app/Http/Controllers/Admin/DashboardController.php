<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::count();
        $admins = Admin::where('email', '!=', 'admin@admin,com')->whereNotNull('last_login_at')->orderBy('last_login_at','desc')->take(10)->get();
        return view('admin.others.dashboard', compact(
            'users','admins'
        ));
    }
}
