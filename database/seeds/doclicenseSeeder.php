<?php

use Illuminate\Database\Seeder;

class doclicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $licenses = ['111111111', '222222222', '333333333', '444444444', '555555555', '666666666', '777777777', '888888888', '999999999', '000000000'];
         foreach ($licenses as $license) {
             \App\Models\doclicense::create([
                 'license_code' => $license,
                 'created_at'   => now(),
             ]);
         }
    }
}
