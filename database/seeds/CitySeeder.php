<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\City::firstOrCreate([
            'name' => 'Bolsward'
        ]);
        \App\Models\City::firstOrCreate([
            'name' => 'Harlingen'
        ]);
    }
}