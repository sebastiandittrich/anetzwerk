<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use App\User;

class Post extends Model
{
    protected $fillable = ['header', 'content', 'user_id'];

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }

    public function checkOwner(User $user = null)
    {
        if($user == null) {
            $user = auth()->user();
        }

        if($this->user_id == $user->id) {
            return true;
        } else {
            die(view('errors.notallowed'));
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function shits()
    {
        return $this->hasMany(Shit::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function saveTag(string $tagname)
    {
        $tag = Tag::where('name', $tagname)->first();
        if(count($tag)) {
            DB::table('post_tag')->insert([
                'post_id' => $this->id,
                'tag_id' => $tag->id
            ]);
        } else {
            $tag = new Tag;
            $tag->name = $tagname;
            $this->tags()->save($tag);
        }
    }
    
    public function removeAll() {
        $this->shits()->delete();
        $this->comments()->delete();
        foreach ($this->images as $image) {
            $image->removeAll();
        }
        $this->tags()->delete();
        Post::find($this->id)->delete();
    }

    public function addImage($image) {

        $path = str_random(2)."/".str_random(30).".".$image->getClientOriginalExtension();

        while(count(Image::where('path', $path)->get())) {
            $path = str_random(2)."/".str_random(30).".".$image->getClientOriginalExtension();
        }

        $savedimage = Image::create([
            'post_id' => $this->id,
            'user_id' => auth()->id(),
            'path' => $path
        ]);

        try {
            if(!is_dir(Image::getImagePath().substr($savedimage->path, 0, 2))) {
                mkdir(Image::getImagePath().substr($savedimage->path, 0, 2));
            }

            $image->move($savedimage->getSubFolderPath(), $savedimage->getImageName());
        } catch(Exception $e) {
            Image::find($savedimage->id)->delete();
        }

        return $savedimage;
    }
}
