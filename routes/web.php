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
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

// Posts
Route::get('/posts', 'PostsController@showall');
Route::get('/posts/{post}/details', 'PostsController@show');
Route::get('/posts/new', 'PostsController@create')->middleware('auth');
Route::post('/posts/new', 'PostsController@store')->middleware('auth');
Route::get('/posts/{post}/delete', 'PostsController@delete')->middleware('auth');
Route::get('/posts/{post}/edit', 'PostsController@edit')->middleware('auth');
Route::post('/posts/{post}/edit', 'PostsController@update')->middleware('auth');

// Comments
Route::post('/posts/{post}/comments/new', 'CommentsController@store')->middleware('auth');

// Shits
Route::post('/posts/{post}/shits/new', 'ShitsController@store')->middleware('auth');

// Tags
Route::get('/tags/{tag}', 'TagsController@show');

// Users
Route::get('/users', 'UsersController@showall');
Route::get('/users/{user}', 'UsersController@showsingle');
Route::get('/users/{user}/delete', 'UsersController@delete')->middleware('auth');
Route::get('/users/{user}/edit', 'UsersController@edit')->middleware('auth');
Route::post('/users/{user}/edit', 'UsersController@update')->middleware('auth');
Route::post('/users/{user}/edit/profilepicture', 'UsersController@changeprofilepicture')->middleware('auth');

// Zitate
Route::get('/quotes', 'QuotesController@all');
Route::get('/quotes/{quote}/details', 'QuotesController@show');
Route::get('/quotes/new', 'QuotesController@create')->middleware('auth');
Route::post('/quotes/new', 'QuotesController@store')->middleware('auth');

// Aktivitäten
Route::get('/activities', 'ActivitiesController@showall');
Route::get('/activities/new', 'ActivitiesController@create')->middleware('auth');
Route::post('/activities/new', 'ActivitiesController@store')->middleware('auth');

// Bilder
Route::post('/images/new', 'ImagesController@store')->middleware('auth');

// Suche
Route::get('/search/all/', 'SearchController@all');

// Ajax 
Route::get('/ajax/{element}', function($element) {
    return view($element);
});
