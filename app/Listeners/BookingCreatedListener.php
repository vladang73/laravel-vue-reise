<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\SendBookingCreatedEmail;
use App\Jobs\SendBookingEmailToProvider;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(BookingCreated $event)
    {
        dispatch(new SendBookingCreatedEmail($event->booking));
        //dispatch(new SendBookingEmailToProvider($event->booking));
    }
}
