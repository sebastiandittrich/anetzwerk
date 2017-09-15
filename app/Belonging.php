<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

trait Belonging
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
