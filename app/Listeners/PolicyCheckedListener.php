<?php

namespace App\Listeners;

use App\Events\PolicyChecked;
use App\Jobs\SendPolicyCheckedEmail;
use App\Models\Booking;
use App\Models\Provider;
use DrewM\MailChimp\MailChimp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Sendinblue\Mailin;

class PolicyCheckedListener
{

    private $lists = [];
    private $segments = [];

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
    public function handle(PolicyChecked $event)
    {
        dispatch(new SendPolicyCheckedEmail($event));
        $booking = Booking::find($event->data['id']);

        $mailin = new Mailin("https://api.sendinblue.com/v2.0", env('SENDINBLUE_KEY'));

        if($event->data['data']['wantNews']) {
            if($booking->provider_id === Provider::PREISDALER) {
                $data = [
                    "email" => $booking->email,
                    "attributes" => ["LASTNAME"=> $booking->last_name, "MAN_VROUW"=> $booking->gender_id === 1 ? 'meneer' : 'mevrouw'],
                    "listid" => [5],
                    "listid_unlink" => []
                ];
                $mailin->create_update_user($data);
            } else {
                $data = [
                    "email" => $booking->email,
                    "attributes" => ["LASTNAME"=> $booking->last_name, "MAN_VROUW"=> $booking->gender_id === 1 ? 'meneer' : 'mevrouw'],
                    "listid" => [10],
                    "listid_unlink" => []
                ];
                $mailin->create_update_user($data);
            }
        }
        if($event->data['data']['newsOnEmail']) {
            if($booking->provider_id === Provider::PREISDALER) {
                $data = [
                    "email" => $booking->email,
                    "attributes" => ["LASTNAME"=> $booking->last_name, "MAN_VROUW"=> $booking->gender_id === 1 ? 'meneer' : 'mevrouw'],
                    "listid" => [6],
                    "listid_unlink" => []
                ];
                $mailin->create_update_user($data);
            } else {
                $data = [
                    "email" => $booking->email,
                    "attributes" => ["LASTNAME"=> $booking->last_name, "MAN_VROUW"=> $booking->gender_id === 1 ? 'meneer' : 'mevrouw'],
                    "listid" => [9],
                    "listid_unlink" => []
                ];
                $mailin->create_update_user($data);
            }
        }
    }
}
