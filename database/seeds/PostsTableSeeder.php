<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Dummy 1',
                'category_id' => 1,
                'content' => 'lorem epsum dummy',
                'image' => 'dummy',
            ],
            [
                'title' => 'Dummy 1',
                'category_id' => 1,
                'content' => 'lorem epsum dummy',
                'image' => 'dummy'
            ],
            [
                'title' => 'Dummy 1',
                'category_id' => 1,
                'content' => 'lorem epsum dummy',
                'image' => 'dummy'
            ]
        ];
        DB::table('posts')->insert($posts);
    }
}
