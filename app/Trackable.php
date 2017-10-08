<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Trackable
{
    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
        return $this;
    }

    public function untrack() {
        Activity::where('object', self::class)->where('object_id', $this->id)->delete();
        return $this;
    }
}
