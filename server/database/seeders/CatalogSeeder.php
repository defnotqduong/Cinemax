<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('catalogs')->insert([
            [
                'name' => 'Phim lẻ',
                'slug' => 'phim-le',
                'paginate' => 20,
                'des' => 'Des Phim lẻ',
            ],
            [
                'name' => 'Phim bộ',
                'slug' => 'phim-bo',
                'paginate' => 20,
                'des' => 'Des Phim bộ',
            ],
        ]);
    }
}
