<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Shit;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'first_name', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authenticate($die = true)
    {
        if(auth()->id() == $this->id) {
            return true;
        } else {
            if($die) {
                die(view('errors.notallowed'));
            } else {
                return false;
            }
        }
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function shits()
    {
        return $this->hasMany(Shit::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function shit(Post $post) {
        if(count(Shit::where('user_id', auth()->id())->where('post_id', $post->id)->get())) {
            return true;
        } else {
            return false;
        }
    }
}
