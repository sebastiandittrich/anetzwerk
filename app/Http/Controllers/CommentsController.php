<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Post $post)
    {
        $this->middleware('auth');

        $this->validate(request(), [
            'content' => 'required|string'
        ]);

        $request = request()->all();

        $request['user_id'] = auth()->id();
        $request['post_id'] = $post->id;

        Comment::create($request);

        return back();
    }
}
