<?php

namespace App\Http\Services;

use Carbon\Carbon;

class SchedulingService
{
    protected $startWeekDay;
    protected $endWeekDay;
    protected $currentDay;

    public function __construct()
    {
        $this->currentDay = Carbon::now();
        Carbon::setWeekStartsAt(Carbon::MONDAY);
        Carbon::setWeekEndsAt(Carbon::SUNDAY);
    }

    /**
     * @return Carbon
     */
    public function getStartWeekDay(): Carbon
    {
        $now = clone $this->currentDay;
        return $now->startOfWeek();
    }

    /**
     * @return Carbon
     */
    public function getEndWeekDay(): Carbon
    {
        $now = clone $this->currentDay;
        return $now->endOfWeek();
    }

    public function setWeek($year, $week)
    {
        $this->currentDay->setISODate($year, $week);
    }

    public function setFromTimestamp($timestamp)
    {
        $this->currentDay = Carbon::createFromTimestamp($timestamp, 'Europe/Berlin');
        return $this;
    }

}