<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\City;
use App\Models\Color;
use App\Models\Gender;
use App\Models\Location;
use App\Models\Provider;
use App\Traits\ApiTrait;
use App\Http\Controllers\Controller;

class HandbookController extends Controller
{
    use ApiTrait;

    public function getColors()
    {
        $colors = Color::get();
        return $colors;
    }

    public function getCities()
    {
        $cities = City::get();
        return $cities;
    }

    public function getProviders()
    {
        $providers = Provider::get();
        return $providers;
    }

    public function getGenders()
    {
        $genders = Gender::get();
        return $genders;
    }

    public function getLocations()
    {
        $locations = Location::get();
        return $locations;
    }
}
