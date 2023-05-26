<?php

namespace App\Repositories;

use App\Models\Holiday\Type;

class HolidayTypeRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return Type::class;
    }
}