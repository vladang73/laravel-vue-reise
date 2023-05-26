<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PolicyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->data['booking']->provider_id === Provider::PREISDALER) {
            return $this->from(env('MANDRILL_USERNAME_PREISDALER'))
                ->subject('Bevestiging voorwaarden reservering')
                ->view('mail/policyChecked')->with([
                    'data' => $this->data
                ]);
        } else {
            return $this->from(env('MANDRILL_USERNAME_REISBUREAU'))
                ->subject('Bevestiging voorwaarden reservering')
                ->view('mail/policyChecked')->with([
                    'data' => $this->data
                ]);
        }
    }
}
