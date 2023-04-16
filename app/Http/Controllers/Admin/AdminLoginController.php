<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laratrust\Traits\LaratrustUserTrait;

class AdminLoginController extends Controller
{
    use LaratrustUserTrait;
    use AuthenticatesUsers;
    
    public function showAdminLoginForm () 
    {
        $title = env('APP_NAME');
        return view('admin.auth.login')->with('name', $title);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
    
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
                                                              
    public function logAdminIn(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
