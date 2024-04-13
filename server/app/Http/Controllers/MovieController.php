<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Region;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function getMovieForSlide()
    {
        $movies = Movie::whereNotIn('type', ['cartoon'])->orderBy('created_at', 'desc')->take(10)->get();

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

    public function getMovieByCategory(Request $request)
    {
        $slug = $request->query('slug');
        $page = $request->query('page');

        $catalog = Catalog::where('slug', $slug)->first();

        if ($catalog) {
            $movies = Movie::where('type', $catalog->type)->orderBy('created_at', 'desc')->paginate(20);
            return response()->json([
                'success' => true,
                'name' => $catalog->getTypeLabel(),
                'movies' => $movies
            ], 200);
        }

        $category = Category::where('slug', $slug)->first();

        if ($category) {

            $query = $category->movies()->orderBy('created_at', 'desc');

            if ($category->slug != 'hoat-hinh') {
                $query = $query->whereNotIn('type', ['cartoon']);
            }

            $movies = $query->paginate(20);

            return response()->json([
                'success' => true,
                'name' => $category->name,
                'movies' => $movies
            ], 200);
        }

        return response(['success' => false], 404);
    }


    public function getMovieByRegion(Request $request)
    {
        $slug = $request->query('slug');
        $page = $request->query('page');

        $region = Region::where('slug', $slug)->first();

        if (!$region) return response(['success' => false], 404);

        if ($region) {
            $movies  = $region->movies()
                ->whereNotIn('type', ['cartoon'])
                ->orderBy('created_at', 'desc')
                ->paginate(20);

            return response()->json([
                'success' => true,
                'name' => $region->name,
                'movies' => $movies
            ], 200);
        }
    }

    public function getMovie(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->with('categories', 'regions')->first();

        if (!$movie) return response(['success' => false, 'message' => 'Movie not found'], 404);

        return response()->json(['success' => true, 'movie' => $movie], 200);
    }

    public function getEpisodes($slug)
    {
        $movie = Movie::where('slug', $slug)->first();

        if (!$movie)  return response()->json(['success' => false, 'message' => 'Movie not found'], 404);

        $episodes = $movie->episodes()
            ->orderByRaw("CAST(LPAD(name, 2, '0') AS UNSIGNED) ASC")
            ->get();


        $result = [];

        foreach ($episodes as $episode) {
            $serverName = $episode->server;

            if (!isset($result[$serverName])) {
                $result[$serverName] = [];
            }
            $result[$serverName][] = [
                'id' => $episode->id,
                'name' => $episode->name,
                'server' => $episode->server,
                'type' => $episode->type,
                'link' => $episode->link,
            ];
        }

        $newEpisodes = [];
        foreach ($result as $serverName => $episodes) {
            $newEpisodes[] = [
                'server_name' => $serverName,
                'server_data' => $episodes,
            ];
        }

        return response()->json([
            'success' => true,
            'movie' => $movie,
            'episodes' => $newEpisodes,
        ], 200);
    }
}
