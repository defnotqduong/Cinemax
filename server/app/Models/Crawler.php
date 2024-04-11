<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ophim\Crawler\OphimCrawler\Contracts\BaseCrawler;

class Crawler extends BaseCrawler
{
    public function handle()
    {
        $payload = json_decode($body = file_get_contents($this->link), true);
        $this->checkIsInExcludedList($payload);
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
}
