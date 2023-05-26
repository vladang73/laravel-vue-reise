<?php

namespace App\Repositories;

use App\Models\CountScheduling;

class CountSchedulingRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return CountScheduling::class;
    }
}