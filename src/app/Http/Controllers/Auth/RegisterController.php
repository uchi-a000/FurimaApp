<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;



class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'nick_name' => $request->nick_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function create()
    {
        return view('auth.register');
    }

}
