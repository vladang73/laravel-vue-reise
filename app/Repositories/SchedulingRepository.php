<?php

namespace App\Repositories;

use App\Models\Scheduling;

class SchedulingRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return Scheduling::class;
    }
}