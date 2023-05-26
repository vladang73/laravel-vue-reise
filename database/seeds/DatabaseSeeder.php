<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersSeeder::class);
         $this->call(CitySeeder::class);
         $this->call(ColorsSeeder::class);
         $this->call(ProviderSeeder::class);
         $this->call(GenderSeeder::class);
         $this->call(LocationSeeder::class);
         $this->call(PrivacyTextsSeeder::class);
    }
}
