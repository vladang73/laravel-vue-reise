<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->booking->provider_id) {
            case Provider::PREISDALER:
                return $this->from(env('MANDRILL_USERNAME_PREISDALER'))
                    ->subject('Boeking gemaakt')
                    ->view('mail/preisdalerBooking')->with([
                    'booking' => $this->booking
                ]);
            case Provider::REISBUREAU:
                return $this->from(env('MANDRILL_USERNAME_REISBUREAU'))
                    ->subject('Boeking gemaakt')
                    ->view('mail/reisbureauBooking')->with([
                    'booking' => $this->booking
                ]);
        }
    }
}
