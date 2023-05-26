<?php

namespace App\Jobs;

use App\Mail\BookingCreated;
use App\Mail\BookingCreatedToProvider;
use App\Mail\BookingToProvider;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookingCreatedEmail implements ShouldQueue
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
        if(!in_array($this->booking->location_id, [1,2])) {
            $email = new BookingCreated($this->booking);
            Mail::to($this->booking->email)->queue($email);
        }
        //$email = new BookingCreatedToProvider($this->booking);
        $ceratedEmail = new BookingToProvider($this->booking);
        if($this->booking->location_id === 1) {
            Mail::to('bolsward@reisbureaufriesland.nl')
//                ->bcc(['johan@johanboerema.nl'])
                ->bcc(['armanbektassov@gmail.com'])
                ->queue($ceratedEmail);
            Log::info('sent to bolsward');
        }
        if($this->booking->location_id === 2) {
            Mail::to('harlingen@reisbureaufriesland.nl')
//                ->bcc(['johan@johanboerema.nl'])
                ->bcc(['armanbektassov@gmail.com'])
                ->queue($ceratedEmail);
            Log::info('sent to harlingen');
        }
    }
}
