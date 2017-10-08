<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use UniversalProperties;
    use Belonging;
    use Trackable;
    use Deletable;
    protected $fillable = ['content', 'object', 'object_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
