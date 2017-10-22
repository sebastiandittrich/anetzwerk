<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class SearchController extends Controller
{
    protected static $searchable = [
        'App\\User' => [
            'username', 'first_name', 'last_name'
        ],
        'App\\Post' => [
            'content'
        ],
        'App\\Quote' => [
            'content', 'real_author', 'fake_author'
        ],
        'App\\Tag' => [
            'name'
        ]
    ];
    public function all() {
        $query = request('query');
        $foundelements = [];
        $filteredelements = [];
        $allactivities = [];
        $allusers = [];
        foreach(self::$searchable as $classname => $class) {
            foreach($class as $property) {
                $elements = ('\\'.$classname)::where($property, 'LIKE', '%' . $query . '%')->get();
                foreach($elements as $element) {
                    $foundelements[] = $element;
                }
            }
        }

        foreach($foundelements as $element) {
            if(method_exists($element, 'collection') && count($element->collection())) {
                foreach($element->collection() as $collection) {
                    $foundcollections = 0;
                    foreach($filteredelements as $otherelement) {
                        if(get_class($otherelement) == get_class($collection) && $otherelement->id == $collection->id) {
                            $foundcollections++;
                        }
                    }
                    if($foundcollections < 1) {
                        $filteredelements[] = $collection;
                    }
                }
            } else {
                $foundcollections = 0;
                foreach($filteredelements as $otherelement) {
                    if(get_class($otherelement) == get_class($element) && $otherelement->id == $element->id) {
                        $foundcollections++;
                    }
                }
                if($foundcollections < 1) {
                    $filteredelements[] = $element;
                }
            }
        }

        foreach($filteredelements as $element) {
            if(get_class($element) == 'App\\User') {
                $foundusers = 0;
                foreach($allusers as $otheruser) {
                    if($otheruser->id == $element->id) {
                        $foundusers++;
                    }
                }
                if(!$foundusers) {
                    $allusers[] = $element;
                }
            }
        }
        foreach($filteredelements as $element) {
            $activities = Activity::where('object', get_class($element))->where('object_id', $element->id)->orderBy('updated_at', 'desc')->get();
            foreach($activities as $activity) {
                $foundactivities = 0;
                foreach($allactivities as $otheractivity) {
                    if($otheractivity->id == $activity->id) {
                        $foundactivities++;
                    }
                }
                if($foundactivities < 1 && $activity->object != 'App\\User') {
                    $allactivities[] = $activity;
                } else if($activity->object == 'App\\User') {
                    
                }
            }
        }
        return view('search.results', ['meta' => ['counter' => count($allactivities) + count($allusers), 'query' => $query], 'results' => ['activities' => $allactivities, 'user' => $allusers]]);
    }
}