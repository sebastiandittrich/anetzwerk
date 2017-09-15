<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Commentable
{
    public $commentable = true;
    public function userCommented() {
        return count(Comment::where('user_id', auth()->id())->where('object', self::class)->where('object_id', $this->id)->get()) ? true : false;
    }

    public function comments() {
        return $this->hasManyUniversal(Comment::class);
    }
}
