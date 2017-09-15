<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait UniversalProperties
{
    public function hasManyUniversal(string $classname) {
        $entrys = ("\\".$classname)::where('object', self::class)->where('object_id', $this->id)->get();
        foreach($entrys as $entry) {
            $entry->object_name = $entry->object;
            $entry->object = ("\\".$entry->object)::find($entry->object_id);
        }
        return $entrys;
    }
}
