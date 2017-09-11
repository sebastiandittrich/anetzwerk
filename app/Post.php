<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Shit;

class Post extends Model
{
    use UniversalProperties;
    use Shittable;

    protected $fillable = ['content', 'user_id'];
    protected $whitelist = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'strong', 'p', 'em', 'u', 's', 'pre', 'ol', 'li', 'ul', 'span'];

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

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function shits()
    {
        return $this->hasManyUniversal(Shit::class);
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
        foreach($this->shits() as $shit) {
            $shit->delete();
        }
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
            'user_id' => auth()->id(),
            'path' => $path
        ]);

        $savedimage->track('create');

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

    public function htmlTagCheck() {
        $matches = [];
        preg_match_all('/<(?<tag>.+)>?(.+)<\/(?P=tag)>/', $this->content, $matches);
        foreach($matches['tag'] as $tagname) {
            if(!in_array($tagname, $this->whitelist)) {
                return false;
            }
        }
        return true;
    }
}
