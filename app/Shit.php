<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shit extends Model
{
    protected $fillable = ['user_id', 'object', 'object_id'];

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
