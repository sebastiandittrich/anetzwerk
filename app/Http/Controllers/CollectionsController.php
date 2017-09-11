<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;

class CollectionsController extends Controller
{
    public function create() {
        return view('activity.create');
    }

    public function store() {
        $this->validate(request(), [
            'objects' => 'required'
        ]);
        $i = 0;
        if(count(request('objects')) > 1) {
            $collection = Collection::create([
                'user_id' => auth()->id()
            ])->track('create');
        }
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
                if(count(request('objects')) > 1) {
                    $collection->addElement($model->id, $object['object'], $i);
                } else {
                    $model->track('create');
                }
                $object['object_id'] = $model->id;
            } else {
                if(count(request('objects')) > 1) {
                    $collection->addElement($object['object_id'], $object['object'], $i);
                } else {
                    ("\\".$object['object'])::find($object['object_id'])->track('share');
                }
            }
            $i++;
        }
        return "true";
    }
}
