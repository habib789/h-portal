<?php

use Illuminate\Database\Seeder;

class daySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = ['Saturday','sunday','monday','tuesday','wednesday','thursday','friday'];
        foreach ($days as $day){
            \App\Models\Days::create([
               'day_name'=>$day,
            ]);
        }
    }
}
