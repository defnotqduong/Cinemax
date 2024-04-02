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
                'type' => 'single',
                'paginate' => 12,
                'des' => 'Des Phim lẻ mới cập nhật',
            ],
            [
                'name' => 'Phim bộ',
                'slug' => 'phim-bo',
                'type' => 'series',
                'paginate' => 12,
                'des' => 'Des Phim bộ mới cập nhật',
            ],
            [
                'name' => 'Phim hoạt hình mới',
                'slug' => 'phim-hoat-hinh',
                'type' => 'cartoon',
                'paginate' => 12,
                'des' => 'Des Phim hoạt hình mới cập nhật',
            ],
        ]);
    }
}
