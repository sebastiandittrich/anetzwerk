<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Activity;

class HomeController extends Controller
{
    public function home()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get();
        foreach ($activities as $activity) {
            $activity->prepare();
        }
        return view('home.home', compact('activities'));
    }
}
