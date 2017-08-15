<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Shit;
use App\Image;
use App\Follow;

class User extends Authenticatable
{
    use Notifiable;
    use UniversalProperties;

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'image', 'email', 'password', 'first_name', 'last_name'
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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function shit(Post $post) {
        if(count(Shit::where('user_id', auth()->id())->where('object', 'App\\Post')->where('object_id', $post->id)->get())) {
            return true;
        } else {
            return false;
        }
    }

    public function activities(int $limit) {
        return Activity::prepareMany(Activity::where('user_id', $this->id)->orderBy('updated_at', 'desc')->limit($limit)->get());
    }

    public function profileimage() {
        return Image::find($this->image_id);
    }

    public function gofollow(User $user) {
        Follow::create([
            'user_id' => $this->id,
            'follows' => $user->id
        ])->track('create');

    }

    public function follows() {
        $follows = [];
        foreach (Follow::where('user_id', $this->id)->get() as $follow) {
            $follows[] = User::find($follow->follows);
        }
        return $follows;
    }
}
