<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use PhpOption\Option;

class Collector
{
    protected $fields;
    protected $payload;

    public function __construct(array $payload, array $fields)
    {
        $this->fields = $fields;
        $this->payload = $payload;
    }

    public function get(): array
    {
        $info = $this->payload['movie'] ?? [];

        $data = [
            'name' => $info['name'],
            'origin_name' => $info['origin_name'],
            'year' => $info['year'],
            'content' => $info['content'],
            'type' =>  $this->getMovieType($info),
            'status' => $info['status'],
            'thumb_url' => $info['thumb_url'],
            'poster_url' => $info['poster_url'],
            'trailer_url' => $this->getTrailerUrl($info),
            'quality' => $info['quality'],
            'language' => $info['lang'],
            'episode_time' => $info['time'],
            'episode_current' => $info['episode_current'],
            'episode_total' => $info['episode_total'],
            'notify' => $info['notify'],
            'showtimes' => $info['showtimes'],
            'is_show_in_theater' => $info['chieurap'],
        ];

        return $data;
    }

    protected function getMovieType($info)
    {
        return $info['type'] == 'series' ? 'series'
            : ($info['type'] == 'single' ? 'single'
                : ($info['type'] == 'hoathinh' ? 'cartoon'
                    : ($info['type'] === 'tvshows' ? 'tvshows' : 'unknown')));
    }

    protected function getTrailerUrl($info)
    {
        if (isset($info['trailer_url']) && !empty($info['trailer_url'])) {

            $parsedUrl = parse_url($info['trailer_url']);

            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $queryParams);
                if (isset($queryParams['v'])) {
                    return 'https://www.youtube.com/embed/' . $queryParams['v'];
                }
            }
        }

        return null;
    }
}
