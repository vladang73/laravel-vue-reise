<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingCreatedToCustomer extends Mailable
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
        return $this->from('admin@rereisbureaufportal.com')
            ->subject('Bevestig uw boeking')
            ->view('mail/bookingToCustomer')->with([
                'booking' => $this->booking
            ]);
    }
}
