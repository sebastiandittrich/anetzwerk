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
App::setLocale('de');

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
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::post('/posts/{post}/edit', 'PostsController@update');

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
Route::get('/users/{user}/edit', 'UsersController@edit');
Route::post('/users/{user}/edit', 'UsersController@update');

// Zitate
Route::get('/quotes', 'QuotesController@all');
Route::get('/quotes/{quote}/details', 'QuotesController@show');
Route::get('/quotes/new', 'QuotesController@create');
Route::post('/quotes/new', 'QuotesController@store');

// Aktivitäten
Route::get('/activities', 'ActivitiesController@showall');