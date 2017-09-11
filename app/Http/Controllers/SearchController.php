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
            'content', 'real_author', 'real_author'
        ],
        'App\\Tag' => [
            'name'
        ]
    ];
    public function all() {
        $query = request('query');
        $results = [];
        $activityresults = [];
        foreach(self::$searchable as $typename => $type) {
            foreach($type as $property) {
                $results[$typename] = array_has($results, $typename) ? array_merge($results[$typename], ('\\'.$typename)::where($property, 'LIKE', '%' . $query . '%')->get(['id'])->toArray()):('\\'.$typename)::where($property, 'LIKE', '%' . $query . '%')->get(['id'])->toArray();
            }
        }

        foreach($results as $type => $typeresults) {
            foreach($typeresults as $result) {
                $actualresults = Activity::where('object', $type)->where('object_id', $result['id'])->get()->toArray();
                foreach($actualresults as $singleresult) {
                    $activityresults[] = $singleresult['id'];
                }
                $actualresults = [];
            }
        }


        $results = Activity::prepareMany(Activity::whereIn('id', $activityresults)->get());
        
        return view('search.results', compact('results'));
    }
}