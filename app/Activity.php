<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;

class Activity extends Model
{
    use UniversalProperties;
    protected $fillable = ['user_id', 'action', 'object', 'object_id', 'time_index'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shits() {
        return $this->object()->hasManyUniversal(Shit::class);
    }

    public function comments() {
        return $this->object()->hasManyUniversal(Comment::class);
    }

    public function commented() {
        if(count(Comments::where('object_id', $this->id)->where('object', Activity::class)->where('user_id', auth()->id())->get())) {
            return true;
        } else {
            return false;
        }
    }

    public function object() {
        return ('\\'.$this->object)::find($this->object_id);
    }

    // public function prepare() {
    //     $this->object_name = $this->object;
    //     $this->object = ("\\".$this->object)::find($this->object_id);
    // }

    public static function store(string $action, string $class, int $id, int $time_index = 1){
        $activity = Activity::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'object' => $class, 
            'object_id' => $id,
        ]);
    }

    // public static function prepareMany($data) {
    //     $ordered = [];
    //     $prepared = [];

    //     function my_sort($a, $b) {
    //         if($a->time_index == $b->time_index) return 0;
    //         return ($a->time_index < $b->time_index)?-1:1;
    //     }

    //     foreach($data as $activity){
    //         $activity->prepare();
    //         $ordered[(string)$activity->created_at][(string)$activity->user_id][] = $activity;
    //     }
    //     foreach($ordered as $timestamp => $time) {
    //         foreach($time as $user_id => $collection) {
    //             $prepared[] = $current = (object)[];
    //             $current->user = User::find($user_id);
    //             $current->created_at = $collection[0]->created_at;
    //             $current->updated_at = $collection[0]->updated_at;
    //             $current->collection = $collection;
    //             $current->object_name = (count($current->collection) > 1)?'App\\Collection':$current->collection[0]->object_name;
    //             $current->action = $current->collection[0]->action;
    //             uasort($current->collection, "App\my_sort");
    //         }
    //     }
    //     return $prepared;
    // }
}