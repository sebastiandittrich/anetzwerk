<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Collection;
use Illuminate\Support\Facades\DB;

trait Collectable
{
    public function collection() {
        $found = DB::table('collection_element')->where('object', self::class)->where('object_id', $this->id)->get();
    }
}
