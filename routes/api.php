<?php

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Shit;
use App\Tag;
use App\Image;
use App\Comment;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Users
Route::get('/users', function() {
    return User::all();
});
Route::get('/users/{user}', function(User $user) {
    return $user;
});

// Posts
Route::get('/posts', function() {
    return Post::all();
});
Route::get('/posts/{post}', function(Post $post) {
    return $post;
});

// Shits
Route::get('/posts/{post}/shits', function(Post $post) {
    return $post->shits;
});
Route::get('/shits/{shit}', function(Shit $shit) {
    return $shit;
});

// Tags
Route::get('/posts/{post}/tags', function(Post $post) {
    return $post->tags;
});
Route::get('/tags/{tag}', function(Tag $tag) {
    return $tag;
});

// Image
Route::get('/images', function() {
    return Image::all();
});
Route::get('/images/{image}', function(Image $image) {
    return $image;
});
Route::get('/posts/{post}/images', function(Post $post) {
    return $post->images;
});

// Comments
Route::get('/posts/{post}/comments', function(Post $post) {
    return $post->comments;
});
Route::get('/comments/', function() {
    return Comment::all();
});
Route::get('/comments/{comment}', function(Comment $comment) {
    return $comment;
});