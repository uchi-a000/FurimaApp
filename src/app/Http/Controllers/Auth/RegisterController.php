<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function create()
    {
        return view('auth.register');
    }
}
