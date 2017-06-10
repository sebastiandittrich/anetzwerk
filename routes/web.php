<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Carbon\Carbon::setLocale('de');

// Home
Route::get('/', 'HomeController@home')->name('home');
Route::get('/home', 'HomeController@home');

// Login and Register
Route::get('/register', 'RegisterController@create');
Route::post('/register', 'RegisterController@store');
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

// Posts
Route::get('/posts', 'PostsController@showall');
Route::get('/posts/{post}/details', 'PostsController@show');
Route::get('/posts/new', 'PostsController@create');
Route::post('/posts/new', 'PostsController@store');
Route::get('/posts/{post}/delete', 'PostsController@delete');

// Comments
Route::post('/posts/{post}/comments/new', 'CommentsController@store');

// Shits
Route::post('/posts/{post}/shits/new', 'ShitsController@store');

// Tags
Route::get('/tags/{tag}', 'TagsController@show');

// Users
Route::get('/users', 'UsersController@showall');
Route::get('/users/{user}', 'UsersController@showsingle');
Route::get('/users/{user}/delete', 'UsersController@delete');
