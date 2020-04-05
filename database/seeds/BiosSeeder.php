<?php

use Illuminate\Database\Seeder;

class BiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bio = [
            [
                'user_id' => 1,
                'about' => 'Hai nama saya Rizky Darma, saya adalah seorang mahasiswa teknik di salah satu perguruan tinggi di Bandung. menjadi seorang Web Developer adalah salah satu impian saya dan saat ini sedang berusaha saya capai & motto hidup saya adalah Hardwork, doing good, living well, following the rules, creative, funny, and being the best i can be.'
            ]
        ];

        DB::table('bios')->insert($bio);
    }
}
