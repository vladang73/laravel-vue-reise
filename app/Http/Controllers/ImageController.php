<?php

namespace App\Http\Controllers;


use App\Http\Services\ImageCacheService;

class ImageController extends Controller
{
    public function getCachedImage($template, $width, $height,$path)
    {
        $cacheService = new ImageCacheService($template, $width, $height,$path);
        return $cacheService->getImage();
    }
}
