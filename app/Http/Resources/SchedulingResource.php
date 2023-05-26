<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SchedulingResource
 * @package App\Http\Resources
 * @property int $id
 * @property int|null $user_id
 * @property int $city_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $color_id
 * @property string $title
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Color $color
 */
class SchedulingResource extends JsonResource
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
            'id' => $this->id,
            'user' => $this->user,
            'city_id' => $this->city,
            'start_date' => Carbon::parse($this->start_date)->format('Y-m-d H:i:s'),
            'end_date' => Carbon::parse($this->end_date)->format('Y-m-d H:i:s'),
            'color' => $this->color,
            'title' => $this->title
        ];
    }
}
