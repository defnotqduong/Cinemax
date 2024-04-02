<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function getMovieForSlide()
    {
        $movies = Movie::orderBy('created_at', 'desc')->take(8)->get();

        return response()->json(['success' => true, 'movies' => $movies], 200);
    }

    public function getMoviesByCatalog()
    {
        $catalogs = Catalog::all();

        $result = [];
        foreach ($catalogs as $catalog) {
            $movies = Movie::where('type', $catalog->type)->orderBy('created_at', 'desc')->take($catalog->paginate)->get();

            $result[] = [
                'name' => $catalog->name,
                'slug' => $catalog->slug,
                'movies' => $movies
            ];
        }

        return response()->json(['success' => true, 'result' => $result], 200);
    }

    public function getMovie()
    {
    }
}
