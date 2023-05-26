<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return Booking::class;
    }
}