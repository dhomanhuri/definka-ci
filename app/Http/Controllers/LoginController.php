<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function home()
    {
        if (session()->has('id')) {
            return redirect('/beranda');
        } else {
            return view('index');
        }
    }

    public function index()
    {
        if (session()->has('id')) {
            return redirect('/beranda');
        } else {
            return view('loginpage');
        }
    }

    public function post_login(Request $request)
    {
        request()->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ]);

            
        $username = $request->input('username');
        $password = $request->input('password');
        
        if (User::where('username', $username)->exists()) {
            $user = User::where('username', '=', $username)->first();
            if ($user->password == $password) {
                session()->put('id', $user->id);
                session()->put('name', $user->name);
                session()->put('password', $user->password);
                session()->put('role', $user->role);
                return redirect('/beranda');
            }
            return back()->withErrors(['Username atau Password Salah.']);
        } else {
            return back()->withErrors(['Username tidak ditemukan.']);
        }
           
    }

    public function logout()
    {
       session()->flush();
       return redirect('/');
    }
}
