<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Tag;
use App\Activity;

class PostsController extends Controller
{
    public function showAll() {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('post.all', compact('posts'));
    }
    
    public function show(Post $post)
    {
        return view('post.single', compact('post'));
    }

    public function create()
    {
        $this->middleware('auth');
        return view('post.create');
    }


    public function store()
    {
        $this->middleware('auth');

        $this->validate(request(), [
            'header' => 'required|string|max:255',
        ]);

        $content = request('content') ? request('content') : '';
        $alltagnames = count(json_decode(request('tagdata'))) ? json_decode(request('tagdata')) : [];

        $alltags = [];
        $post = Post::create([
            'header' => request('header'),
            'content' => $content,
            'user_id' => auth()->id()
        ]);

        foreach($alltagnames as $tagname) {
            $post->saveTag($tagname);
        }

        foreach(count(request('files')) ? request('files') : [] as $image) {
            $post->addImage($image);
        }

        $post->track('create');

        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $post->checkOwner();
        $post->track('delete');
        $post->removeAll();
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post) {
        $this->validate(request(), [
            'header' => 'string|required|max:255'
        ]);

        if(request('content')) {
            $post->content = request("content");
        } else {
            $post->content = "";
        }

        $post->header = request('header');
        $post->save();
        $post->track('update');

        return redirect('/posts/'.$post->id.'/details');
    }
}
