<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Quote extends Model
{
    protected $fillable = ['content', 'real_author', 'fake_author', 'user_id'];
    use UniversalProperties;
    use Shittable;
    use Commentable;
    use Belonging;
    use Deletable;

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }
}
