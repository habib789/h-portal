<?php

use Illuminate\Database\Seeder;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['medicine', 'baby Care', 'feminine hygiene', 'health and beauty', 'medical equipment', 'other'];
        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name'   => $category,
                'slug'   => \Illuminate\Support\Str::slug($category),
                'active' => 1,
            ]);
        }
    }
}
