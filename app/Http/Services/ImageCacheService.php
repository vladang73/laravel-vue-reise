<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class ImageCacheService
{
    public $template;
    public $width;
    public $height;
    public $path;
    public $pageBase64Info;
    public $img;

    public function __construct($template, $width, $height, $path)
    {
        $this->template = $template;
        if(!in_array($template, ['fit', 'crop'])) {
            die();
        }
        $this->width = (int)$width;
        $this->height = (int)$height;
        if(!in_array([$width, $height], config('resize.available'))) {
            die();
        }
        $this->path = $path;
    }

    public function getImage()
    {
        $image = $this->returnCachedImageIfExists();
        if($image) {
            return $image;
        }

        $this->setImageSize();
        $this->cacheImage();
        $image = $this->loadImage();
        return $image;
    }

    private function returnCachedImageIfExists()
    {
        if (config('resize.cache')){
            $image_info = json_encode(['template'=>$this->template,'first'=>$this->width,'second'=>$this->height,'path'=>$this->path]);
            $this->pageBase64Info = base64_encode($image_info);
            if (Cache::get($this->pageBase64Info,NULL)){
                return Cache::get($this->pageBase64Info);
            }
        }
        return null;
    }

    private function setImageSize()
    {
        list($width, $height, $type, $attr) = getimagesize(public_path().'/'.$this->path);
        if ($this->height === 0){
            $this->height = ($this->width * $height) / $width;
            $this->height = (int) $this->height;
        }
        if ($this->width === 0){
            $this->width = ($this->height * $width) / $height;
            $this->width = (int) $this->width;
        }
    }

    private function cacheImage()
    {
        $path = $this->path;
        $width = $this->width;
        $height = $this->height;
        if ($this->template == 'fit')
        {
            $this->img = Image::cache(function($image) use ($path, $width, $height) {
                return $image->make(public_path().'/'.$path)->fit($width, $height);
            });
        }
        if ($this->template == 'crop')
        {
            $this->img = Image::cache(function($image) use ($path, $width, $height) {
                return $image->make(public_path().'/'.$path)->crop($width, $height);
            });
        }
    }

    private function loadImage()
    {
        $img = Response::make($this->img, 200, ['Content-Type' => 'image/jpeg']);
        if(config('resize.cache')) {
            Cache::forever($this->pageBase64Info, $img);
        }
        return $img;
    }
}