<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImagesController extends Controller
{
    public function store() {
        $this->validate(request(), ['files' => 'required']);
        $savedimages = [];

        foreach(request('files') as $file) {
            $savedimage = Image::create([
                'path' => Image::getRandomPath($file),
                'user_id' => auth()->id()
            ]);
            $savedimage->track('create');
            try {
                if(!is_dir(Image::getImagePath().substr($savedimage->path, 0, 2))) {
                    mkdir(Image::getImagePath().substr($savedimage->path, 0, 2));
                }

                $file->move($savedimage->getSubFolderPath(), $savedimage->getImageName());
                $savedimages[] = [$savedimage->id, $savedimage->getURL()];
            } catch(Exception $e) {
                Image::find($savedimage->id)->delete();
            }
        }
        return $savedimages;
    }
}
