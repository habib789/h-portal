<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
           'email' => 'admin@portal.com',
           'password' => bcrypt('admin111111'),
           'email_verified_at' => now(),
           'role' => 'admin'
        ]);
    }
}
