<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Shittable
{
    public $shittable = true;
    public function userShits() {
        return count(Shit::where('user_id', auth()->id())->where('object', self::class)->where('object_id', $this->id)->get()) ? true : false;
    }

    public function shits(User $user = null) {
        if($user == null) {
            return $this->hasManyUniversal(Shit::class);
        }
        if(count(Shit::where('user_id', auth()->id())->where('object', self::class)->where('object_id', $this->id)->get())) {
            return true;
        } else {
            return false;
        }
    }
}
