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
                'slug' => 'php',
                'created_at' => '2020-03-25 07:07:34'

            ],
            [
                'name' => 'Javascript',
                'slug' => 'javascript',
                'created_at' => '2020-03-25 07:07:34'

            ],
            [
                'name' => 'Phyton',
                'slug' => 'phyton',
                'created_at' => '2020-03-25 07:07:34'

            ]
        ];

        DB::table('categories')->insert($category);
    }
}
