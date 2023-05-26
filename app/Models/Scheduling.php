<?php

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Scheduling
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $city_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int $color_id
 * @property string $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Scheduling whereUserId($value)
 * @mixin \Eloquent
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Color $color
 * @property-write mixed $set_end_date
 * @property-write mixed $set_start_date
 */
class Scheduling extends Model
{

    public $table = 'scheduling';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'city_id', 'start_date', 'end_date', 'color_id', 'title', 'count_scheduling_id'
    ];

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromTimestamp($value, 'Europe/Berlin');
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromTimestamp($value, 'Europe/Berlin');
    }

    public function  user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
