<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movietypes')->insert([
            [
                'name' => 'Phim lẻ',
                'slug' => 'phim-le',
                'type' => 'single',
            ],
            [
                'name' => 'Phim bộ',
                'slug' => 'phim-bo',
                'type' => 'series',
            ],
            [
                'name' => 'Phim hoạt hình',
                'slug' => 'phim-hoat-hinh',
                'type' => 'cartoon',
            ],
            [
                'name' => 'TV Shows',
                'slug' => 'tv-shows',
                'type' => 'tvshows',
            ],
        ]);
    }
}
