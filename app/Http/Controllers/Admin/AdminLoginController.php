<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email','password'))){
            if(auth()->user()->is_admin){
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
        }

        return back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function logout(Request $request){
    // Auth::guard('web')->logout();
        if(auth()->user()->is_admin){
            Auth::logout();
        }
        return redirect('/admin/login');
    }
}