<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use UniversalProperties;
    protected $fillable = ['user_id', 'follows'];
    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }
}
