<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Activity;

trait Deletable
{
    public function deleteAll($dimension) {
        if(method_exists($this, 'deleteExtra')) {
            $this->deleteExtra($dimension);
        }
        if($this->commentable) {
            foreach($this->comments() as $comment) {
                $comment->deleteAll("notrack");
            }
        }
        if($this->shittable) {
            foreach($this->shits() as $shit) {
                $shit->deleteAll("notrack");
            }
        }
        $this->untrack();
        if($dimension != 'notrack' && $dimension == 'all') {
            $this->track('delete');
        }
        if($dimension == 'all') {
            $this->delete();
        }
    }
}
