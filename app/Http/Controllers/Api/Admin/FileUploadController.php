<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Upload\ImageRequest;
use App\Http\Services\FileUploadService;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    use ApiTrait;

    public $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function uploadAvatar(ImageRequest $request)
    {
        $path = $this->fileUploadService->storeImage($request->image);
        return $this->returnJson([
            'success' => true,
            'path' => $path
        ]);
    }
}
