<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ApiBaseRequest;

/**
 * Class CreateUserRequest
 *
 * @property string $email
 * @property int $role
 *
 * @package App\Http\Requests\User
 */
class CreateUserRequest extends ApiBaseRequest
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
            'email' => 'required|email',
            'role' => 'required|string'
        ];
    }
}