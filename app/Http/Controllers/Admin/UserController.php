<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Helpers\FileHelper;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Http\Controllers\AppBaseController;
use Request;

class UserController extends AppBaseController
{

    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(UserCreateRequest $request)
    {
        $status = $request->status ?? 0;
        $imageName = FileHelper::uploadImage($request, NULL, ['avatar', 'avatarHeight' => 50, 'avatarWidth' => 50]);
        User::create(array_merge($request->validated(), ['image' => $imageName, 'status' => $status, 'password' => bcrypt($request->password)]));
        notify()->success("User Created Successful.", "Success");
        return redirect(route('admin.users.index'));
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show')->with('user', $user);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('user', $user);
    }


    public function update($id, UserUpdateRequest $request)
    {
        $user = User::findOrFail($id);
        $imageName = FileHelper::uploadImage($request, $user, ['avatar', 'avatarHeight' => 50, 'avatarWidth' => 50]);
        if ($request->password) {
            $password = bcrypt($request->password);
        } else {
            $password = $user->password;
        }
        $status = $request->status ?? 0;
        $user->fill(array_merge($request->validated(), ['image' => $imageName, 'password' => $password, 'status' => $status,]))->save();
        notify()->success("User Updated Successful.", "Success");
        return back();
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        FileHelper::deleteImage($user);
        $user->delete();
    }
}
