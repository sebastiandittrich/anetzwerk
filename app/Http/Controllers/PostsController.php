<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Image;
use App\Tag;

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

        return redirect('/posts');
    }

    public function delete(Post $post)
    {
        $post->checkOwner();
        $post->removeAll();
        return redirect('/posts');
    }
}
