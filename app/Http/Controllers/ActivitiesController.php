<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivitiesController extends Controller
{
    public function showall()
    {
        if(auth()->check()) {
            $activities = Activity::where('user_id', '!=', auth()->id())->orderBy('created_at', 'desc')->get();
        } else {
            $activities = Activity::orderBy('created_at', 'desc')->get();
        }
        $activities = Activity::prepareMany($activities);
        return view('activity.all', compact('activities'));
    }
}
