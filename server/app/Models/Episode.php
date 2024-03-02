<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Episode extends Model
{
    use HasFactory, HasSlug;

    public $table = 'episodes';

    protected $fillable = ['movie_id', 'link', 'server_name', 'episode', 'slug'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('episode')
            ->saveSlugsTo('slug');
    }
}
