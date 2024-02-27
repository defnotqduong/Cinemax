<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllMovie', 'getMovie', 'findMovieById']]);
    }

    public function getAllMovie()
    {
        try {
            $movies = Movie::join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.*', 'categories.title as category_title', 'categories.slug as category_slug', 'genres.title as genre_title', 'genres.slug as genre_slug', 'countries.title as country_title', 'countries.slug as country_slug')
                ->paginate(16);

            return response()->json([
                'success' => true,
                'message' => 'Movies Fetched Successfully',
                'movies' => $movies
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getMovie($slug)
    {
        try {
            $movie = Movie::where('movies.slug', $slug)
                ->join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.*', 'categories.title as category_title', 'categories.slug as category_slug', 'genres.title as genre_title', 'genres.slug as genre_slug', 'countries.title as country_title', 'countries.slug as country_slug')
                ->first();

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            return response()->json([
                'success' => true,
                'message' => 'Movie Found',
                'movie' => $movie
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function findMovieById($id)
    {
        try {
            $movie = Movie::find($id);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            return response()->json([
                'success' => true,
                'message' => 'Movie Found',
                'movie' => $movie
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'name_eng' => 'nullable|string',
            'image' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'resolution' => 'nullable|numeric',
            'season' => 'nullable|string',
            'eps' => 'nullable|numeric',
            'year' => 'nullable|string',
            'duration' => 'nullable|string',
            'tags' => 'nullable|string',
            'subtitle' => 'nullable|boolean',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
        ]);
        try {

            $movie = new Movie();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('uploads', 'public');
                $movie->thumbnail = asset('storage/' . $path);
            }

            $movie->title = $request->title;
            $movie->name_eng = $request->name_eng;
            $movie->description = $request->description;
            $movie->status = $request->status;
            $movie->resolution = $request->resolution;
            $movie->season = $request->season;
            $movie->eps = $request->eps;
            $movie->year = $request->year;
            $movie->subtitle = $request->subtitle;
            $movie->duration = $request->duration;
            $movie->tags = $request->tags;
            $movie->category_id = $request->category_id;
            $movie->country_id = $request->country_id;
            $movie->genre_id = $request->genre_id;

            $movie->save();

            return response()->json([
                'success' => true,
                'message' => 'Movie Created Successfully!',
                'moive' => $movie
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editMovie(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string',
            'name_eng' => 'nullable|string',
            'image' => 'nullable',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'resolution' => 'nullable|numeric',
            'season' => 'nullable|string',
            'eps' => 'nullable|numeric',
            'year' => 'nullable|string',
            'duration' => 'nullable|string',
            'tags' => 'nullable|string',
            'subtitle' => 'nullable|boolean',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
        ]);
        try {

            $movie = Movie::findBySlug($slug);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            if ($request->hasFile('image')) {

                if ($movie->thumbnail) {
                    $filePath = str_replace(url('/storage'), 'public', $movie->thumbnail);
                    if (Storage::disk('local')->exists($filePath))
                        Storage::disk('local')->delete($filePath);
                }

                $image = $request->file('image');
                $path = $image->store('uploads', 'public');
                $movie->thumbnail = asset('storage/' . $path);
            }

            $movie->title = $request->title;
            $movie->name_eng = $request->name_eng;
            $movie->description = $request->description;
            $movie->status = $request->status;
            $movie->resolution = $request->resolution;
            $movie->season = $request->season;
            $movie->eps = $request->eps;
            $movie->year = $request->year;
            $movie->subtitle = $request->subtitle;
            $movie->duration = $request->duration;
            $movie->tags = $request->tags;
            $movie->category_id = $request->category_id;
            $movie->country_id = $request->country_id;
            $movie->genre_id = $request->genre_id;

            $movie->save();

            return response()->json([
                'success' => true,
                'message' => 'Movie updated Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteMovie($id)
    {
        try {

            $movie = Movie::find($id);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            $movie->delete();

            return response()->json([
                'success' => true,
                'message' => 'Movie deleted Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
