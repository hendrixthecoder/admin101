<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UpdateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function showAdminRegisterForm () {
        $title = env('APP_NAME');
        return view('admin.auth.register', ['title' => $title]);
    }

    public function storeAdminUser (UpdateUser $request) {
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->is_admin = true;
        $user->save();

        $user->attachRole('admin');
        $user->attachPermission('edit-user');
        Auth::login($user);

        return redirect()->route('adminDashboard')->with('user', $user);
    }

}
