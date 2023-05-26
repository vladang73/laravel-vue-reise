<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate([
            'email' => 'johan@example.com',
            'first_name' => 'admin',
            'password' => 'Pass@word1'
        ]);
    }
}
