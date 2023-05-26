<?php

namespace App\Http\Controllers;


use App\Models\Booking;
use DrewM\MailChimp\MailChimp;

class TestController extends Controller
{
    /*private $lists = [];
    private $segments = [];

    public function index()
    {
        $mailChimp = new MailChimp(env('MAILCHIMP_APIKEY'));
        $this->lists = $mailChimp->get('lists');
        $batch = $mailChimp->new_batch();
        $preisdalerListId = $this->getListIdByName('Preisdaler');
        $reibureauListId = $this->getListIdByName('Reisbureau Friesland');

        $this->segments = $mailChimp->get("lists/$preisdalerListId/segments");

    }

    private function getListIdByName(string $name)
    {
        foreach ($this->lists['lists'] as $list) {
            if($list['name'] === $name) {
                return $list['id'];
            }
        }
        return false;
    }


    private function getSegmentIdByName($name)
    {
        foreach ($this->segments['segmants'] as $segment) {
            if($segment['name'] === $name) {
                return $segment['id'];
            }
        }
        return false;
    }*/
}
