<?php

namespace App\Services;

use Intervention\Image\Facades\Image;

class imageUploadService
{
    public function imageUpload($image)
    {
        Image::make($image)->save(public_path('assemblies').$image.'.png');
    }

    public function imageUpdate($image)
    {

    }

    public function deleteImage($image)
    {

    }
}
