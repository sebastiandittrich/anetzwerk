<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shit extends Model
{
    protected $fillable = ['user_id', 'object', 'object_id'];
    use UniversalProperties;
    use Belonging;
    use Deletable;

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }
}
