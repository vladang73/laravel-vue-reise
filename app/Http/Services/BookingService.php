<?php

namespace App\Http\Services;

use App\Models\Booking\Agency;

class BookingService
{
    public function checkCreateData(array $data)
    {
        if(0 === (int)$data['holiday_type_id'] || 0 === count($data['agencies']))
        {
            return false;
        }

        return true;
    }

    public function saveTravelAgencies(int $bookingId, array $agencies)
    {
        $rows = Agency::where('booking_id', '=', $bookingId)->get();
        foreach ($rows as $row) {
            $row->delete();
        }
        foreach ($agencies as $agencyId) {
            Agency::create([
               'booking_id' => $bookingId,
               'agency_id' => $agencyId
            ]);
        }
        return true;
    }
}