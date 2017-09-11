<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    function __construct()
    {
        
    }

    public function create()
    {
        return view('session.create');
    }

    public function store()
    {
        if(!auth()->attempt(request(['username', 'password']))) {
            return back()->withErrors([
                'message' => 'Bitte überprüfe deine Eingaben und versuche es erneut.'
            ]);
        }
        return redirect()->home();
    }
    
    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }
}
