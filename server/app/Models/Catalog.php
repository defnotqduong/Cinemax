<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Catalog extends Model
{
    use HasFactory, HasSlug;

    public $table = 'catalogs';

    protected $fillable = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getTypeLabel()
    {
        switch ($this->type) {
            case 'series':
                return 'Phim bộ';
                break;
            case 'single':
                return 'Phim lẻ';
                break;
            case 'cartoon':
                return 'Phim hoạt hình';
            default:
                return;
        }
    }
}
