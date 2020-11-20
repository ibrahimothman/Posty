<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // validation
        $this->validate($request, [
            'name' => 'required|max:225|min:4',
            'username' => 'required|max:225|unique:users,username',
            'email' => 'required|email|max:225|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        // store user
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // log user in
        auth()->attempt($request->only(['email', 'password']));

        // redirect
        return redirect()->route('dashboard');
    }
}
