<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{   
    function __construct()
    {
        $this->middleware('guest');
    }

    public function create() {
        return view('register.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'username' => 'required|max:255|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $firstname = request('first_name') == null ? "" : request('first_name');
        $lastname = request('last_name') == null ? "" : request('last_name');

        $user = User::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'first_name' => $firstname,
            'last_name' => $lastname
        ]);

        auth()->login($user);

        $user->track('create');

        return redirect()->home();
    }
}
