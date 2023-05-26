<?php

namespace App\Http\Requests\Upload;

use App\Http\Requests\ApiBaseRequest;

/**
 * Class Image
 *
 * @property string $image
 *
 * @package App\Http\Requests\Auth
 */
class ImageRequest extends ApiBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required'
        ];
    }
}