<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show Register Form
    public function create(){
        return view('users.register');
    }

    // Create New User
    public function store(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        // Hash password
        $credentials['password'] = bcrypt($credentials['password']);
        // Create User
        $user = User::create($credentials);
        //Log In
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Logout
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('users.login');
    }

    // Show Login Form
    public function login(){
        return view('users.login');
    }

    // Login User
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        // Remember Me
        $remember = $request->has('remember');

        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => '入力情報に誤りがあります'])->onlyInput('email');
    }

}
