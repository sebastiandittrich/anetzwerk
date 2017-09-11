<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store()
    {
        $this->middleware('auth');
        $this->validate(request(), [
            'object' => 'required',
            'object_id' => 'required',
            'content' => 'required|string'
        ]);

        $request = request()->all();

        $request['user_id'] = auth()->id();

        Comment::create($request)->track('create');
    }
}
