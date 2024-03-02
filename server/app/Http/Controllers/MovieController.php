<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllMovie', 'getInitialMovie', 'getMovieByCategory', 'getMovieByGenre', 'getMovieByCountry', 'getMovie', 'getPublicMovie', 'findMovieById']]);
    }

    public function getAllMovie(Request $request)
    {
        try {
            $limit = $request->query('limit');

            $movies = Movie::where('movies.status', 1)->join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.id', 'movies.title', 'movies.name_eng', 'movies.year', 'movies.thumbnail', 'movies.slug', 'movies.subtitle', 'movies.resolution', 'movies.status', 'movies.poster', 'movies.description', 'movies.episode_current')
                ->orderByDesc('movies.updated_at')
                ->paginate($limit);

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

    public function getInitialMovie(Request $request)
    {
        try {
            $limit = $request->query('limit') ?? 15;

            $movies = Movie::join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.id', 'movies.title', 'movies.name_eng', 'movies.year', 'movies.thumbnail', 'movies.slug', 'movies.subtitle', 'movies.resolution', 'movies.status', 'movies.poster', 'movies.description', 'movies.episode_current')
                ->orderByDesc('movies.updated_at')
                ->paginate($limit);

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


    public function getMovieByCategory(Request $request)
    {
        try {

            $category_id = $request->query('category_id');
            $limit = $request->query('limit') ?? 15;

            $movies = Movie::where('movies.category_id', $category_id)
                ->where('movies.status', 1)
                ->join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.id', 'movies.title', 'movies.name_eng', 'movies.year', 'movies.thumbnail', 'movies.slug', 'movies.subtitle', 'movies.resolution', 'movies.status', 'movies.poster', 'movies.description', 'movies.episode_current')
                ->orderByDesc('movies.updated_at')
                ->paginate($limit);
            return response()->json([
                'success' => true,
                'message' => 'Movies Fetched Successfully',
                'movies' => $movies,

            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function getMovieByGenre(Request $request)
    {
        try {
            $genre_id = $request->query('genre_id');

            $movies = Movie::where('movies.genre_id', $genre_id)
                ->where('movies.status', 1)
                ->join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.id', 'movies.title', 'movies.name_eng', 'movies.year', 'movies.thumbnail', 'movies.slug', 'movies.subtitle', 'movies.resolution', 'movies.status', 'movies.poster', 'movies.description', 'movies.episode_current')
                ->orderByDesc('movies.updated_at')
                ->paginate(15);

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

    public function getMovieByCountry(Request $request)
    {
        try {
            $country_id = $request->query('country_id');

            $movies = Movie::where('movies.country_id', $country_id)
                ->where('movies.status', 1)
                ->join('categories', 'movies.category_id', '=', 'categories.id')
                ->join('genres', 'movies.genre_id', '=', 'genres.id')
                ->join('countries', 'movies.country_id', '=', 'countries.id')
                ->select('movies.id', 'movies.title', 'movies.name_eng', 'movies.year', 'movies.thumbnail', 'movies.slug', 'movies.subtitle', 'movies.resolution', 'movies.status', 'movies.poster', 'movies.description', 'movies.episode_current')
                ->orderByDesc('movies.updated_at')
                ->paginate(15);

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

    public function getPublicMovie($slug)
    {
        try {
            $movie = Movie::where('movies.slug', $slug)
                ->where('movies.status', 1)
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
            'thumb' => 'nullable',
            'poster' => 'nullable',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|string',
            'status' => 'nullable|boolean',
            'resolution' => 'nullable|numeric',
            'season' => 'nullable|string',
            'eps' => 'nullable',
            'episode_current' => 'nullable',
            'year' => 'nullable|string',
            'view' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'tags' => 'nullable|string',
            'subtitle' => 'nullable|boolean',
            'chieurap' => 'nullable|boolean',
            'category_id' => 'required|numeric',
            'country_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
        ]);
        try {

            $movie = new Movie();

            if ($request->hasFile('thumb')) {
                $image = $request->file('thumb');
                $path = $image->store('uploads', 'public');
                $movie->thumbnail = asset('storage/' . $path);
            }

            if ($request->hasFile('poster')) {
                $image = $request->file('poster');
                $path = $image->store('uploads', 'public');
                $movie->poster = asset('storage/' . $path);
            }

            $fields = ['title', 'name_eng', 'trailer_url', 'description', 'status', 'resolution', 'season', 'eps', 'episode_current', 'year', 'view', 'duration', 'tags', 'subtitle', 'chieurap', 'category_id', 'country_id', 'genre_id'];

            foreach ($fields as $field) {
                if ($request->has($field) && $request->$field !== null) {
                    $movie->$field = $request->$field;
                }
            }


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
            'thumb' => 'nullable',
            'poster' => 'nullable',
            'description' => 'nullable|string',
            'trailer_url' => 'nullable|string',
            'status' => 'nullable|boolean',
            'resolution' => 'nullable|numeric',
            'season' => 'nullable|string',
            'eps' => 'nullable',
            'episode_current' => 'nullable',
            'year' => 'nullable|string',
            'view' => 'nullable|numeric',
            'duration' => 'nullable|string',
            'tags' => 'nullable|string',
            'subtitle' => 'nullable|boolean',
            'chieurap' => 'nullable|boolean',
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

            if ($request->hasFile('thumb')) {

                if ($movie->thumbnail) {
                    $filePath = str_replace(url('/storage'), 'public', $movie->thumbnail);
                    if (Storage::disk('local')->exists($filePath))
                        Storage::disk('local')->delete($filePath);
                }

                $image = $request->file('thumb');
                $path = $image->store('uploads', 'public');
                $movie->thumbnail = asset('storage/' . $path);
            }

            if ($request->hasFile('poster')) {

                if ($movie->poster) {
                    $filePath = str_replace(url('/storage'), 'public', $movie->poster);
                    if (Storage::disk('local')->exists($filePath))
                        Storage::disk('local')->delete($filePath);
                }

                $image = $request->file('poster');
                $path = $image->store('uploads', 'public');
                $movie->poster = asset('storage/' . $path);
            }

            $fields = ['title', 'name_eng', 'trailer_url', 'description', 'status', 'resolution', 'season', 'eps', 'episode_current', 'year', 'view', 'duration', 'tags', 'subtitle', 'chieurap', 'category_id', 'country_id', 'genre_id'];

            foreach ($fields as $field) {
                if ($request->has($field) && $request->$field !== null) {
                    $movie->$field = $request->$field;
                }
            }

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

            Episode::where('movie_id', $id)->delete();


            if ($movie->thumbnail) {
                $filePath = str_replace(url('/storage'), 'public', $movie->thumbnail);
                if (Storage::disk('local')->exists($filePath))
                    Storage::disk('local')->delete($filePath);
            }

            if ($movie->poster) {
                $filePath = str_replace(url('/storage'), 'public', $movie->poster);
                if (Storage::disk('local')->exists($filePath))
                    Storage::disk('local')->delete($filePath);
            }

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
