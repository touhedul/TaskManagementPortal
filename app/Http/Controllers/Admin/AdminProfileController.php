<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function changePasswordView()
    {
        return view('admin.others.change_password');
    }

    public function changePassword(Request $request)
    {
        $message = CommonHelper::changePassword($request, "Admin");
        notify()->info($message);
        return back();
    }
}
