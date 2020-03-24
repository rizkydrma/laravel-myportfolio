<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'PHP',
                'slug' => 'php'
            ],
            [
                'name' => 'Javascript',
                'slug' => 'javascript'
            ],
            [
                'name' => 'Phyton',
                'slug' => 'phyton'
            ]
        ];

        DB::table('categories')->insert($category);
    }
}
