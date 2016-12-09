<?php

use App\Video;
use Illuminate\Database\Seeder;

class VideosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::create([
            'title' => 'Mannequin challenge',
            'url' => 'https://youtu.be/gB4zh_-FF2w',
            'enabled' => true
        ]);
    }
}
