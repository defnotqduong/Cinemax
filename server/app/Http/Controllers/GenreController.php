<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Exception;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllGenre', 'getInitialGenre', 'getGenre']]);
    }

    public function createGenre(Request $request)
    {
        $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);
        try {

            $genre = new Genre();

            $genre->title = $request->title;
            $genre->description = $request->description;
            $genre->status = $request->status;


            $genre->save();

            return response()->json([
                'success' => true,
                'message' => 'Genre created Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getInitialGenre()
    {
        try {
            $genres = Genre::all();

            return response()->json([
                'success' => true,
                'message' => 'Countries Fetched Successfully!',
                'genres' => $genres
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getAllGenre()
    {
        try {
            $genres = Genre::paginate();

            return response()->json([
                'success' => true,
                'message' => 'Countries Fetched Successfully!',
                'genres' => $genres
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getGenre($slug)
    {
        try {
            $genre  = Genre::findBySlug($slug);

            if (!$genre) return response()->json([
                'success' => false,
                'message' => 'Genre Not Found!'
            ], 404);

            return response()->json([
                'success' => true,
                'message' => 'Country Found!',
                'genre' => $genre
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function editGenre(Request $request, $slug)
    {
        try {
            $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);

            $genre = Genre::findBySlug($slug);

            if (!$genre) return response()->json([
                'success' => false,
                'message' => 'Genre Not Found!'
            ], 404);

            $genre->title = $request->title;
            $genre->description = $request->description;
            $genre->status = $request->status;

            $genre->save();

            return response()->json([
                'success' => true,
                'message' => 'Genre Edited Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['seccess' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteGenre($id)
    {
        try {
            $genre  = Genre::find($id);

            if (!$genre) return response()->json([
                'success' => false,
                'message' => 'Genre Not Found!'
            ], 404);

            $genre->delete();

            return response()->json([
                'success' => true,
                'message' => 'Genre deleted Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
