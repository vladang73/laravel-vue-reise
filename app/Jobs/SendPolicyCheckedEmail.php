<?php

namespace App\Jobs;

use App\Events\PolicyChecked;
use App\Mail\PolicyCheckedEmail;
use App\Mail\PolicyEmail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendPolicyCheckedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct(PolicyChecked $data)
    {
        $this->data = $data->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $booking = Booking::find($this->data['id']);
        $this->data['booking'] = $booking;
        $email = new PolicyEmail($this->data);
        if($booking->provider_id === 1) {
            Mail::to(env('MANDRILL_USERNAME_PREISDALER'))
                ->queue($email);
        } else {
            if($booking->location_id === 1) {
                Mail::to('bolsward@reisbureaufriesland.nl')
                    ->queue($email);
            }
            if($booking->location_id === 2) {
                Mail::to('harlingen@reisbureaufriesland.nl')
                    ->queue($email);
            }
            if($booking->location_id === 3) {
                Mail::to('info@reisbureaufriesland.nl')
                    ->queue($email);
            }
        }
        Mail::to($booking->email)
            ->queue($email);
    }
}
