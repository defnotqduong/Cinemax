<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'title' => 'One Piece',
                'slug' => 'one-piece',
                'description' => 'One Piece des',
                'status' => true,
                'thumbnail' => 'https://res.cloudinary.com/movie-animer/image/upload/v1708751665/images/vrgbjl9ktcn56wxks42s.jpg',
                'resolution' => 0,
                'category_id' => 1,
                'genre_id' => 1,
                'country_id' => 1
            ]
        ]);
    }
}
