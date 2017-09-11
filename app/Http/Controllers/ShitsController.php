<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Shit;

class ShitsController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'object_name' => 'required',
            'object_id' => 'required'
        ]);
        $found = Shit::where('user_id', auth()->id())->where('object', request('object_name'))->where('object_id', request('object_id'))->first();
        if(count($found)) {
            $found->track('delete');
            $found->delete();
            echo "falsch";
        } else {
            Shit::create([
                'object' => request('object_name'),
                'object_id' => request('object_id'),
                'user_id' => auth()->id()
            ])->track('create');

            echo "richtig";
        }
    }
}
