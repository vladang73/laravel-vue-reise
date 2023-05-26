<?php

namespace App\Listeners;

use App\Events\AgencyDeleted;
use App\Models\Agency\Document;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AgencyDeletedListener
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
    public function handle(AgencyDeleted $event)
    {
        $documents = Document::where('agency_id', '=', $event->agencyId)->get();
        foreach ($documents as $document) {
            $document->delete();
        }
    }
}
