<?php

namespace App\Repositories;

use App\Models\Texts;

class TextsRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return Texts::class;
    }
}