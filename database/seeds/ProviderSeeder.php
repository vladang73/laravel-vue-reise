<?php

use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Provider::truncate();
        \App\Models\Provider::firstOrCreate([
            'name' => 'Preisdaler'
        ]);
        \App\Models\Provider::firstOrCreate([
            'name' => 'Reisbureau Friesland'
        ]);
    }
}