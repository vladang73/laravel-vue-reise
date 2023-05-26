<?php

namespace App\Repositories;

use App\Models\Agency;

class TravelAgencyRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return Agency::class;
    }
}