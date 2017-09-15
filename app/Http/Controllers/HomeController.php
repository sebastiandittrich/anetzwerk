<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Activity;

class HomeController extends Controller
{
    public function home()
    {
        return view('home.home');
    }
}
