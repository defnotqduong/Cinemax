<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\BaseCrawler;

class Crawler extends BaseCrawler
{
    public function handle()
    {
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        $payload = json_decode(file_get_contents($this->link, false, $context), true);

        $this->checkIsInExcludedList($payload);

        $info = (new Collector($payload, $this->fields))->get();

        $movie =  Movie::updateOrCreate(
            ['name' => $info['name']],
            $info
        );

        $this->syncCategories($movie, $payload);
        $this->syncRegions($movie, $payload);
        $this->updateEpisodes($movie, $payload);
    }

    protected function checkIsInExcludedList($payload)
    {
        $newType = $payload['movie']['type'];
        if (in_array($newType, $this->excludedType)) {
            throw new \Exception("Thuộc định dạng đã loại trừ");
        }

        $newCategories = collect($payload['movie']['category'])->pluck('name')->toArray();
        if (array_intersect($newCategories, $this->excludedCategories)) {
            throw new \Exception("Thuộc thể loại đã loại trừ");
        }

        $newRegions = collect($payload['movie']['country'])->pluck('name')->toArray();
        if (array_intersect($newRegions, $this->excludedRegions)) {
            throw new \Exception("Thuộc quốc gia đã loại trừ");
        }
    }

    protected function syncCategories($movie, array $payload)
    {
        if (!in_array('categories', $this->fields)) return;
        $categories = [];
        foreach ($payload['movie']['category'] as $category) {
            if (!trim($category['name'])) continue;
            $categories[] = Category::firstOrCreate(['name' => trim($category['name'])])->id;
        }
        if ($payload['movie']['type'] === 'hoathinh') $categories[] = Category::firstOrCreate(['name' => 'Hoạt Hình'])->id;
        if ($payload['movie']['type'] === 'tvshows') $categories[] = Category::firstOrCreate(['name' => 'TV Shows'])->id;

        $movie->categories()->sync($categories);
    }

    protected function syncRegions($movie, array $payload)
    {
        if (!in_array('regions', $this->fields)) return;

        $regions = [];
        foreach ($payload['movie']['country'] as $region) {
            if (!trim($region['name'])) continue;
            $regions[] = Region::firstOrCreate(['name' => trim($region['name'])])->id;
        }
        $movie->regions()->sync($regions);
    }

    protected function updateEpisodes($movie, $payload)
    {
        if (!in_array('episodes', $this->fields)) return;
        $flag = 0;
        foreach ($payload['episodes'] as $server) {
            foreach ($server['server_data'] as $episode) {
                if ($episode['link_embed']) {
                    Episode::updateOrCreate([
                        'name' => $movie->episodes[$flag]->name ?? null,
                        'movie_id' => $movie->id,
                    ], [
                        'name' => $episode['name'],
                        'movie_id' => $movie->id,
                        'server' => $server['server_name'],
                        'type' => 'embed',
                        'link' => $episode['link_embed'],
                    ]);
                    $flag++;
                }
            }
        }
        for ($i = $flag; $i < count($movie->episodes); $i++) {
            $movie->episodes[$i]->delete();
        }
    }
}
