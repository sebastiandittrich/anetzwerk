<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Collection;
use Illuminate\Support\Facades\DB;

trait Collectable
{
    public function collection() {
        $found = DB::table('collection_element')->where('element', self::class)->where('element_id', $this->id)->get(['collection_id'])->toArray();
        $ids = [];
        foreach($found as $entry) {
            $ids[] = $entry->collection_id;
        }
        return Collection::whereIn('id', $ids)->get();
    }
}
