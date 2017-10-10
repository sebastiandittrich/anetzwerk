<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activity;
use App\Deleted;

class Activity extends Model
{
    use UniversalProperties;
    use Belonging;
    protected $fillable = ['user_id', 'action', 'object', 'object_id', 'time_index'];

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
        $object = ('\\'.$this->object)::find($this->object_id);
        return $object; //!= null ? $object : new Deleted;
    }

    public function objectClass() {
        return get_class($this->object());
    }

    public static function store(string $action, string $class, int $id, int $time_index = 1){
        $activity = Activity::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'object' => $class, 
            'object_id' => $id,
        ]);
    }

    public static function reactableFilter($element) {
        return $element != null && (property_exists($element, 'likeable') || property_exists($element, 'commentable'));
    }

    public static function oldfeed() {
        return Activity::where('user_id', "!=" , auth()->id())->where('action', 'create')->orderBy('updated_at', 'desc')->get();
    }

    public static function feed($user = null) {
        $ids = [];
        $activities = Activity::where('action', 'create');
        if($user == null && auth()->check()) {
            $activities = $activities->where('user_id', '!=', auth()->id());
        } else if($user != null) {
            $activities = $activities->where('user_id', $user->id);
        }
        foreach($activities->get() as $activity) {
            if(self::reactablefilter($activity->object())) $ids[] = $activity->id;
        }
        return Activity::whereIn('id', $ids)->orderBy('updated_at', 'desc')->get();
    }
}