<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('login');
    }

    public function proses_login(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('username', 'password');

        if(Auth::attempt($credential))
        {
            $user=Auth::user();

            if($user->level == 'superadmin')
            {
                return redirect()->intended('dashboard');
            }
            elseif($user->level == 'admin')
            {
                return redirect()->intended('dashboard');
            }

            return redirect()->intended('/');
        }

        return redirect('login')->withInput()->withErrors(['login_gagal' => 'These credentials do not match our records.']);;
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('login');
    }
}
