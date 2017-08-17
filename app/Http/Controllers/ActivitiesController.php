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

    public function create() {
        return view('activity.create');
    }

    public function store() {
        $this->validate(request(), [
            'objects' => 'required'
        ]);
        $i = 0;
        foreach(request('objects') as $object) {
            if(!$object['object_id']) {
                $params = [];
                foreach($object as $key => $value) {
                    if($key != 'object' && $key != 'object_id') {
                        $params[$key] = $value;
                    }
                }
                $params['user_id'] = auth()->id();
                $model = ("\\".$object['object'])::create($params);
                if(get_class($model) == \App\Post::class) {
                    if(!$model->htmlTagCheck()) {
                        $model->delete();
                        return view('layout.formerrors')->withErrors(['message' => 'Eines deiner Textfelder enthält ungültigen HTML-Code. Überprüfe das noch einmal.']);
                    }
                }
                $object['object_id'] = $model->id;
            }
            Activity::create([
                'user_id' => auth()->id(),
                'object' => $object['object'],
                'object_id' => $object['object_id'],
                'action' => 'create',
                'time_index' => $i
            ]);
            $i++;
        }
        return "true";
    }
}
