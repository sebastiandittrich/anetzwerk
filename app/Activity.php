<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;

class Activity extends Model
{
    protected $fillable = ['user_id', 'action', 'object', 'object_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prepare() {
        $this->object_name = $this->object;
        $this->object = ("\\".$this->object)::find($this->object_id);
    }

    public static function store(string $action, string $class, int $id){
        $activity = Activity::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'object' => $class, 
            'object_id' => $id
        ]);
    }
}
