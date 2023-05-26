<?php

namespace App\Repositories;

use App\Models\User;

class UsersRepository extends Repository
{
    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }
}