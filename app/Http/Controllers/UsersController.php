<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function showAll()
    {
        $users = User::orderBy('username')->get();
        return view('user.all', compact('users'));
    }

    public function showsingle(User $user)
    {
        return view('user.single', compact('user'));
    }

    public function delete(User $user)
    {
        $user->authenticate();
        $user->comments()->delete();
        $user->shits()->delete();
        foreach ($user->posts as $post) {
            $post->removeAll();
        }
        User::find($user->id)->delete();

        return redirect('/users');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->validate(request(), [
            'email' => 'required|string|max:255'
        ]);

        $user->email = request('email');

        if(request('first_name')) {
            $user->first_name = request('first_name');
        }
        if(request('last_name')) {
            $user->last_name = request('last_name');
        }

        $user->save();
    }
}
