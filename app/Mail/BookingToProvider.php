<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingToProvider extends Mailable
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
        return $this->from(env('MANDRILL_USERNAME_REISBUREAU'))
            ->subject('Nieuwe boeking')
            ->view('mail/reisbureauBooking')->with([
                'booking' => $this->booking
            ]);
    }
}
