<?php

namespace App\Http\Services;

use Intervention\Image\Facades\Image;

class FileUploadService
{
    const DIRECTORY_PERMISSIONS = 0755;

    /**
     * Takes base64 string and creates an image on server
     * @param string $image
     * @return bool|string
     */
    public function storeImage(string $image)
    {
        if($image)
        {
            $name = str_random().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $dirName = substr($name, 0, 2);
            $this->createDirIfNotExists($dirName);
            Image::make($image)->save(public_path("images/$dirName/").$name);
            return $dirName . '/' . $name;
        }
        return false;
    }

    /**
     * @param string $name
     */
    private function createDirIfNotExists(string $name)
    {
        if(!file_exists(public_path('images'))) {
            mkdir('images', self::DIRECTORY_PERMISSIONS);
        }
        if(!file_exists(public_path('images/' . $name))) {
            mkdir(public_path('images/' . $name), self::DIRECTORY_PERMISSIONS);
        }
    }
}