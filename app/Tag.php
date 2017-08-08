<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'user_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'desc');
    }
}
