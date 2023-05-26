<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class BookingResource
 *
 * @property int $id
 * @property int|null $holiday_type_id
 * @property int $receive_newsletter
 * @property int|null $agency_id
 * @property string $last_name
 * @property string $email
 * @property string $passport
 * @property string $address
 * @package App\Http\Resources
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Agency[] $agencies
 */
class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'holiday_type_id' => (int)$this->holiday_type_id,
            'receive_newsletter' => (int)$this->receive_newsletter,
            'agencies' => $this->agencies,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'passport' => $this->passport,
            'address' => $this->passport
        ];
    }
}
