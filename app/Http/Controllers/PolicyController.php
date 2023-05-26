<?php

namespace App\Http\Controllers;


use App\Events\PolicyChecked;
use App\Models\Booking;
use App\Models\Provider;
use App\Models\Texts;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    private $booking;

    public function privacy($provider, $id, $email)
    {
        $this->booking = Booking::find($id);
        if(null === $this->booking || $this->booking->email != $email) {
            abort(404);
        }

        $text = Texts::where('provider_id', '=', $this->booking->provider_id)->first();
        $text->first_paragraph = $this->pasteVars($text->first_paragraph);
        $text->second_paragraph = $this->pasteVars($text->second_paragraph);
        $text->third_paragraph = $this->pasteVars($text->third_paragraph);
        $text->epilogue = $this->pasteVars($text->epilogue);
        switch ($this->booking->provider_id) {
            case Provider::PREISDALER:
                return view('policy/privacyPreisdaler', ['text' => $text, 'booking' => $this->booking]);
            case Provider::REISBUREAU:
                return view('policy/privacyReisbureau', ['text' => $text, 'booking' => $this->booking]);
        }
    }

    public function save(Request $request)
    {
        event(new PolicyChecked($request->all()));
    }

    private function pasteVars($text)
    {
        $_agency = '';
        foreach ($this->booking->agencies as $agency) {
            $name = $agency->name . ', ';
            $_agency .= $name;
        }
        $_agency = substr($_agency, 0, strlen($_agency) - 2);
        if(!$this->booking->holiday) {
            $text = str_replace('%type_reis%', 'Doorverkoper', $text);
        } else {
            $text = str_replace('%type_reis%', $this->booking->holiday->name, $text);
        }
        if($this->booking->location_id) {
            $text = str_replace('%location%', $this->booking->location->name, $text);
        }
        $text = str_replace('%agency%', $_agency, $text);
        return $text;
    }
}
