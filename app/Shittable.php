<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Shittable
{
    public $shittable = true;
    public function userShits() {
        return count(Shit::where('user_id', auth()->id())->where('object', self::class)->where('object_id', $this->id)->get()) ? true : false;
    }
}
