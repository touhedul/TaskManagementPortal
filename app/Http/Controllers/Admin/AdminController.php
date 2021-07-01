<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\AdminDataTable;
use App\Http\Requests;
use App\Helpers\FileHelper;
use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use App\Http\Controllers\AppBaseController;
class AdminController extends AppBaseController
{

    public function __construct()
    {
        $this->middleware('superAdmin');
    }

    
    public function index(AdminDataTable $adminDataTable)
    {
        return $adminDataTable->render('admin.admins.index');
    }


    public function create()
    {
        return view('admin.admins.create');
    }


    public function store(AdminCreateRequest $request)
    {
        $input = $request->validated();
        Admin::create(array_merge($request->validated(), ['password' => bcrypt($request->password)]));
        //$imageName = FileHelper::uploadImage($request);      
        //Admin::create(array_merge($request->validated(), ['image' => $imageName]));
        notify()->success("Admin Created Successful.", "Success");
        return redirect(route('admin.admins.index'));
    }


    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.show')->with('admin', $admin);
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit')->with('admin', $admin);
    }


    public function update($id, AdminUpdateRequest $request)
    {
        $admin = Admin::findOrFail($id);
         if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $admin->password;
        }
        // $imageName = FileHelper::uploadImage($request, $admin);
        // $admin->fill(array_merge($request->validated(), ['image' => $imageName]))->save();
        $admin->fill(array_merge($request->validated(), ['password' => $password]))->save();
        notify()->success("Admin Updated Successful.", "Success");
        return back();
    }


    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        //FileHelper::deleteImage($admin);
        $admin->delete();
    }
}
