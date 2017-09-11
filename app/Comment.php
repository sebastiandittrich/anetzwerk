<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use UniversalProperties;
    protected $fillable = ['content', 'object', 'object_id', 'user_id'];

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
