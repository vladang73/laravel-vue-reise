<?php

use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Color::firstOrCreate([
            'name' => 'Ocean'
        ]);
        \App\Models\Color::firstOrCreate([
            'name' => 'Green'
        ]);
        \App\Models\Color::firstOrCreate([
            'name' => 'Violet'
        ]);
        \App\Models\Color::firstOrCreate([
            'name' => 'Red'
        ]);
        \App\Models\Color::firstOrCreate([
            'name' => 'Free'
        ]);
    }
}