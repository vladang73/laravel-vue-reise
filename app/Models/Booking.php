<?php

namespace App\Models;


use App\Models\Holiday\Type;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Booking
 *
 * @property int $id
 * @property int|null $holiday_type_id
 * @property int $receive_newsletter
 * @property int|null $agency_id
 * @property string $last_name
 * @property string $email
 * @property string $passport
 * @property string $address
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereHolidayTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking wherePassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereReceiveNewsletter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Agency[] $agencies
 * @property-read \App\Models\Holiday\Type|null $holiday
 * @property int $provider_id
 * @property-read \App\Models\Provider $provider
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereProviderId($value)
 * @property int|null $gender_id
 * @property int|null $location_id
 * @property-read \App\Models\Gender|null $gender
 * @property-read \App\Models\Location|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereGenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking whereLocationId($value)
 */
class Booking extends Model
{

    public $table = 'booking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'holiday_type_id', 'agency_id', 'last_name', 'email', 'provider_id', 'gender_id', 'location_id',
        'anvr_conditions_apply', 'own_conditions_apply'
    ];

    public function holiday()
    {
        return $this->belongsTo(Type::class, 'holiday_type_id', 'id');
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function agencies()
    {
        return $this->hasManyThrough(
            Agency::class,
            Booking\Agency::class,
            'booking_id',
            'id',
            'id',
            'agency_id'
        );
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
