<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
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
                'name' => 'React Native',
                'slug' => 'react-native',
                'created_at' => '2020-03-25 07:07:34'
            ],
        ];

        DB::table('tags')->insert($tags);
    }
}
