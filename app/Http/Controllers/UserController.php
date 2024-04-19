<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $data = $request->only('email', 'password');
        if(Auth::attempt($data)) {
            return redirect('/landing');
        } else {
            return back()->with('error','');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required',
            'address' => 'required',
        ]);

        $data = $request->only('name','username','email','address');
        $data['password'] = Hash::make($request->password);

        User::create($data);
        return redirect('/')->with('success_register', '');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
