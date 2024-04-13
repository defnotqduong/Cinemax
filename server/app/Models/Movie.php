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

    protected $guarded = ['id'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }


    public function getStatus()
    {
        $statuses = [
            'trailer' => __('Sắp chiếu'),
            'ongoing' => __('Đang chiếu'),
            'completed' => __('Hoàn thành')
        ];
        return $statuses[$this->status];
    }
}
