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
        $results = [];
        $ret = [];
        $activityresults = [];
        foreach(self::$searchable as $typename => $type) {
            foreach($type as $property) {
                $results[$typename][] = ('\\'.$typename)::where($property, 'LIKE', '%' . $query . '%')->get();
            }
        }

        $meta = ['query' => request('query'), 'counter' => 0];
        $added = [];

        foreach($results as $typename => $typeresults) {
            foreach($typeresults as $resultcollection) {
                foreach($resultcollection as $result) {
                    if(array_has($added, $typename) && in_array($result->id, $added[$typename])) {
                    } else {
                        $ret[$typename][] = $result;
                        $meta['counter']++;
                        $added[$typename][] = $result->id;
                    }
                }
            }
        }
        $results = $ret;
        
        return view('search.results', compact('results', 'meta'));
    }
}