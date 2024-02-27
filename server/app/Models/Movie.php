<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Movie extends Model
{
    use HasFactory, HasSlug;

    public $table = 'movies';

    protected $fillable = [
        'title',
        'slug',
        'name_eng',
        'description',
        'thumbnail',
        'status',
        'season',
        'eps',
        'year',
        'duration',
        'resolution',
        'subtitle',
        'tags',
        'category_id',
        'genre_id',
        'country_id'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
