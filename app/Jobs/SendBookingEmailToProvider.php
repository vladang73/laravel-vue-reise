<?php

namespace App\Jobs;

use App\Mail\BookingCreated;
use App\Mail\BookingCreatedToCustomer;
use App\Mail\BookingCreatedToProvider;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookingEmailToProvider implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new BookingCreatedToProvider($this->booking);
        if($this->booking->location_id === 1) {
            Mail::to('bolsward@reisbureaufriesland.nl')
                ->bcc(['johan@johanboerema.nl'])
                ->send($email);
            Log::info('sent to bolsward');
        }
        if($this->booking->location_id === 2) {
            Mail::to('harlingen@reisbureaufriesland.nl')
                ->bcc(['johan@johanboerema.nl'])
                ->send($email);
            Log::info('sent to harlingen');
        }
        /*$emailToCustomer = new BookingCreatedToCustomer($this->booking);
        Mail::to($this->booking->email)->send($emailToCustomer);*/
    }
}
