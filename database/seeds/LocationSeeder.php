<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Location::truncate();
        \App\Models\Location::firstOrCreate([
            'name' => 'Bolsward'
        ]);
        \App\Models\Location::firstOrCreate([
            'name' => 'Harlingen'
        ]);
        \App\Models\Location::firstOrCreate([
            'name' => 'Anders'
        ]);
    }
}