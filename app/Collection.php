<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Trackable;
use Illuminate\Support\Facades\DB;
use App\Deleted;

class Collection extends Model
{
    use Trackable;
    use UniversalProperties;
    use Shittable;
    use Commentable;
    use Belonging;
    protected $fillable = ['user_id'];

    public function addElement($element_id, $element_name, $index) {
        DB::table('collection_element')->insert([
            'collection_id' => $this->id,
            'element' => $element_name,
            'element_id' => $element_id,
            'index' => $index
        ]);
    }

    public function elements() {
        $element_ids = DB::table('collection_element')->where('collection_id', $this->id)->orderBy('index')->get()->toArray();
        $elements = [];
        foreach($element_ids as $element_id) {
            $element = ('\\'.$element_id->element)::find($element_id->element_id);
            $elements[] = $element;// != null ? $element : new Deleted;
        }
        return $elements;
    }
}
