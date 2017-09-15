<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Shit;
use App\Image;
use App\Follow;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    use UniversalProperties;
    use Shittable;
    use Commentable;

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

    protected $elements = ['images', 'posts', 'quotes'];

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

    public static function compare_elements($a, $b) {
        if($a->updated_at->eq($b->updated_at)) return 0;
        return $a->updated_at->lt($b->updated_at) ? 1 : -1;
    }

    public function elements() {
        $ret = [];
        foreach($this->elements as $typename) {
            foreach($this->$typename as $element) {
                $found = DB::table('collection_element')->where('element', get_class($element))->where('element_id', $element->id)->first();
                if($found != null) {
                    if(Collection::find($found->collection_id)->user_id != $this->id) {
                        $ret[] = $element;
                    }
                } else {
                    $ret[] = $element;
                }
            }
        }
        foreach($this->collections as $collection) $ret[] = $collection;
        usort($ret, ['App\User', 'compare_elements']);
        return $ret;
    }

    public function collections() {
        return $this->hasMany(Collection::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function activities(int $limit) {
        return Activity::where('user_id', $this->id)->orderBy('updated_at', 'desc')->limit($limit)->get();
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

    public function getURL() {
        return '/users/'.$this->id;
    }

    public function displayName() {
        return $this->username;
    }
}
