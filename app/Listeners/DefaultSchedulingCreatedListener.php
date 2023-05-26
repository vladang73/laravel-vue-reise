<?php

namespace App\Listeners;

use App\Events\DefaultSchedulingCreated;
use App\Repositories\SchedulingRepository;
use Carbon\Carbon;

class DefaultSchedulingCreatedListener
{
    private $schedulingRepository;

    public function __construct(SchedulingRepository $schedulingRepository)
    {
        $this->schedulingRepository = $schedulingRepository;
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     */
    public function handle(DefaultSchedulingCreated $event)
    {
        $dateObjectStart = Carbon::createFromTimestamp(strtotime($event->scheduling->start_date), 'Europe/Berlin');
        $dateObjectEnd = Carbon::createFromTimestamp(strtotime($event->scheduling->end_date), 'Europe/Berlin');
        $currentYear = $dateObjectStart->year;
        $data = $event->scheduling->toArray();
        while($dateObjectStart->year < ($currentYear + 1)) {
            $dateObjectStart->addWeeks(2);
            $dateObjectEnd->addWeeks(2);
            $data['count_scheduling_id'] = $event->countScheduling->id;
            $data['start_date'] = $dateObjectStart->getTimestamp();
            $data['end_date'] = $dateObjectEnd->getTimestamp();
            $this->schedulingRepository->create($data);
        }
    }
}
