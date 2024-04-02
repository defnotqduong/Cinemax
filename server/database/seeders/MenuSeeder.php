<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $homeMenu = Menu::firstOrCreate(['name' => 'Trang chủ', 'link' => '/', 'type' => 'internal_link']);
        $seriesMenu = Menu::firstOrCreate(['name' => 'Phim bộ', 'link' => '/the-loai/phim-bo', 'type' => 'internal_link']);
        $singleMenu = Menu::firstOrCreate(['name' => 'Phim lẻ', 'link' => '/the-loai/phim-le', 'type' => 'internal_link']);

        $categoryGroup = Menu::firstOrCreate(['name' => 'Thể loại', 'link' => '#', 'type' => 'internal_link']);
        $categories = Category::all();
        foreach ($categories as $category) {
            Menu::updateOrCreate([
                'name' => $category->name,
            ], [
                'link' => $category->getUrl(),
                'type' => 'internal_link',
                'parent_id' => $categoryGroup->id
            ]);
        }

        $regionGroup = Menu::firstOrCreate(['name' => 'Quốc gia', 'link' => '#', 'type' => 'internal_link']);
        $regions = Region::all();
        foreach ($regions as $region) {
            Menu::updateOrCreate([
                'name' => $region->name,
            ], [
                'link' => $region->getUrl(),
                'type' => 'internal_link',
                'parent_id' => $regionGroup->id
            ]);
        }
    }
}
