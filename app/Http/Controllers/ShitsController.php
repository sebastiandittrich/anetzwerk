<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Shit;

class ShitsController extends Controller
{
    public function store(Post $post)
    {
        $found = Shit::where('user_id', auth()->id())->where('post_id', $post->id)->first();
        if(count($found)) {
            $found->track('delete');
            $found->delete();
            echo "false";
        } else {
            Shit::create([
                'post_id' => $post->id,
                'user_id' => auth()->id()
            ])->track('create');

            echo "true";
        }
    }
}
