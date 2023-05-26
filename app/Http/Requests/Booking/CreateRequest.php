<?php

namespace App\Http\Requests\Booking;

use App\Http\Requests\ApiBaseRequest;

/**
 * Class CreateUserRequest
 * @property int $id
 * @property int|null $holiday_type_id
 * @property int $receive_newsletter
 * @property int|null $agency_id
 * @property string $last_name
 * @property string $email
 * @property string $passport
 * @property string $address
 *
 * @package App\Http\Requests\User
 */
class CreateRequest extends ApiBaseRequest
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
            'holiday_type_id' => 'required',
            'agencies' => 'required|array',
            'last_name' => 'required',
            'email' => 'required|email',
            'gender_id' => 'required'
        ];
    }
}