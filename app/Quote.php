<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Quote extends Model
{
    protected $fillable = ['content', 'real_author', 'fake_author', 'user_id'];
    use UniversalProperties;
    use Shittable;

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
