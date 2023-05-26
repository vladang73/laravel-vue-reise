<?php

namespace App\Models\Booking;


use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Booking\Agency
 *
 * @property int $booking_id
 * @property int $agency_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Agency whereAgencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Agency whereBookingId($value)
 * @mixin \Eloquent
 */
class Agency extends Model
{

    public $table = 'booking_agencies';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id', 'agency_id'
    ];
}
