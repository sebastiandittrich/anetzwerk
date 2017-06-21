<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['post_id', 'path', 'user_id'];

    public static $supportedExtensions = ['png', 'gif', 'jpeg', 'bmp', 'xpm', 'wbmp', 'webp', 'xbm'];

    public function track(string $action) {
        Activity::store($action, self::class, $this->id);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public static function getImagePath() {
        return public_path('storage/images/');
    }

    public function getSubFolderPath() {
        return Image::getImagePath().substr($this->path, 0, 3);
    }

    public function getImageFullPath() {
        return $this->getSubFolderPath().$this->getImageName();
    }

    public function getImageName() {
        return substr($this->path, 3);
    }

    public function getURL() {
        return asset('storage/images/'.$this->path);
    }

    public function removeAll()
    {
        unlink($this->getImageFullPath());
        Image::find($this->id)->delete();
    }

    public function createThumbnail($image)
    {
        $ext = strtolower($image->getClientOriginalExtension());
        $loadedimage;
        if($ext == 'png') {
            $loadedimage = \ImageCreateFromPNG($this->getImageFullPath());
        } elseif ($ext == 'jpeg') {
            $loadedimage = \imagecreatefromjpeg($this->getImageFullPath());
        } elseif ($ext == 'gif') {
            $loadedimage = \imagecreatefromgif($this->getImageFullPath());
        } else {
            return;
        }
        
        list($width_orig, $height_orig) = getimagesize($this->getImageFullPath());
        
        $newheight = $height_orig;
        $newwidth = $width_orig;
        while($newheight > 100) {
            $newheight = $newheight -1;
            $newwidth = $newwidth -1;
        }

        $thumbnail = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($thumbnail, $loadedimage, 0, 0, 0, 0, $newwidth, $newheight, $width_orig, $height_orig);
        imagepng($thumnail, $this->getImageFullPath.".thumbnail.png");
    }
}
