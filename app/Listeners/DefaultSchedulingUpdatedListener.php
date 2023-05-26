<?php

namespace App\Listeners;

use App\Events\DefaultSchedulingUpdated;
use App\Repositories\SchedulingRepository;

class DefaultSchedulingUpdatedListener
{
    private $schedulingRepository;
    private $request;

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
    public function handle(DefaultSchedulingUpdated $event)
    {
        $object = $this->schedulingRepository->find($event->request->get('id'));
        $schedulings = $this->schedulingRepository->where('count_scheduling_id', '=', $object->count_scheduling_id)->get();
        foreach ($schedulings as $scheduling){
            $scheduling->title = $event->request->get('title');
            $scheduling->color_id = $event->request->get('color_id');
            $scheduling->user_id = $event->request->get('user_id');
            $scheduling->city_id = $event->request->get('city_id');
            $scheduling->save();
        }
    }
}
