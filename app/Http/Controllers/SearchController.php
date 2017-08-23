<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        foreach(self::$searchable as $typename => $type) {
            foreach($type as $property) {
                $results[] = ['name' => $typename, 'results' => ('\\'.$typename)::where($property, 'LIKE', '%' . $query . '%')->get()];
            }
        }

        $results['meta'] = ['counter' => count(array_flatten($results)), 'query' => $query];
        
        return view('search.results', compact('results'));
    }
}
