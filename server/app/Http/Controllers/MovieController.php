<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpKernel\Exception\ResolverNotFoundException;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllMovie', 'getMovie']]);
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

    public function getMovie($id)
    {
        try {
            $movie = Movie::where('movies.id', $id)
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

    public function createMovie(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'nullable',
                'status' => 'required|boolean',
                'thumbnail' => 'required|file',
                'resolution' => 'required|numeric',
                'subtitle' => 'required|boolean',
                'category_id' => 'required|numeric',
                'country_id' => 'required|numeric',
                'genre_id' => 'required|numeric',
            ]);

            $movie = new Movie();


            $image_url = cloudinary()->upload($request->file('thumbnail')->getRealPath(), [
                'folder' => 'images',
            ])->getSecurePath();

            $movie->title = $request->title;
            $movie->description = $request->description;
            $movie->status = $request->status;
            $movie->thumbnail = $image_url;
            $movie->resolution = $request->resolution;
            $movie->subtitle = $request->subtitle;
            $movie->category_id = $request->category_id;
            $movie->country_id = $request->country_id;
            $movie->genre_id = $request->genre_id;

            $movie->save();

            return response()->json([
                'success' => true,
                'movie' => 'Movie Created Successfully!',
                'moive' => $movie
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editMovie(Request $request, $id)
    {

        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'nullable',
                'status' => 'required|boolean',
                'thumbnail' => 'required|file',
                'resolution' => 'required|numeric',
                'subtitle' => 'required|boolean',
                'category_id' => 'required|numeric',
                'country_id' => 'required|numeric',
                'genre_id' => 'required|numeric',
            ]);

            $movie = Movie::find($id);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            $image_url = $movie->image;
            $filename = pathinfo($image_url)['filename'];
            $public_id = 'images/' . $filename;

            cloudinary()->destroy($public_id);

            $image_url = cloudinary()->upload($request->file('thumbnail')->getRealPath(), [
                'folder' => 'images',
            ])->getSecurePath();

            $movie->image = $image_url;

            $movie->title = $request->title;
            $movie->description = $request->description;
            $movie->status = $request->status;
            $movie->thumbnail = $image_url;
            $movie->resolution = $request->resolution;
            $movie->subtitle = $request->subtitle;
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
