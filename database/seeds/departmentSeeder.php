<?php

use Illuminate\Database\Seeder;

class departmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = ['Eye Department', 'pediatric', 'dental', 'orthopedics', 'cardiology', 'endocrinology'];
        foreach ($departments as $department) {
            \App\Models\Department::create([
               'name' => $department,
               'slug'=>\Illuminate\Support\Str::slug($department),
               'active' => 1,
            ]);
        }
    }
}
