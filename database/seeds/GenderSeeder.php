<?php

use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Gender::truncate();
        \App\Models\Gender::firstOrCreate([
            'name' => 'Man'
        ]);
        \App\Models\Gender::firstOrCreate([
            'name' => 'Vrouw'
        ]);
    }
}