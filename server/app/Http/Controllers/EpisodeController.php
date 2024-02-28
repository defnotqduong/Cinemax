<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class EpisodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllEpisodeByMovieId']]);
    }

    public function getAllEpisodeByMovieId($id)
    {
        try {
            $eps = Episode::where('movie_id', $id)->orderBy('episode', 'asc')->paginate();

            return response()->json([
                'success' => true,
                'message' => 'Episodes Fetched by MovieId Successfully!',
                'episodes' => $eps
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getEpisodeById($id)
    {
        try {
            $ep = Episode::find($id);

            if (!$ep) return response()->json([
                'success' => false,
                'message' => 'Episode not Found!'
            ], 404);


            return response()->json([
                'success' => true,
                'message' => 'Episode Found!',
                'episode' => $ep
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createEpisode(Request $request)

    {
        $request->validate([
            'movie_id' => 'required|numeric',
            'episode' => 'required|numeric',
            'server_name' => 'required|string',
            'link' => 'required|string'
        ]);
        try {

            $movie = Movie::find($request->movie_id);

            if (!$movie) return response()->json([
                'success' => false,
                'message' => 'Movie not Found!'
            ], 404);

            $ep = new Episode();

            $ep->movie_id = $request->movie_id;
            $ep->server_name = $request->server_name;
            $ep->episode = $request->episode;
            $ep->link = $request->link;

            $ep->save();

            return response()->json([
                'success' => true,
                'message' => 'Movie Created Successfully!',
                'episode' => $ep
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editEpisode(Request $request, $id)
    {
        $request->validate([
            'movie_id' => 'required|numeric',
            'episode' => 'required|numeric',
            'server_name' => 'required|string',
            'link' => 'required|string'
        ]);
        try {
            $ep = Episode::find($id);

            if (!$ep) return response()->json([
                'success' => false,
                'message' => 'Episode not Found!'
            ], 404);

            $ep->movie_id = $request->movie_id;
            $ep->server_name = $request->server_name;
            $ep->episode = $request->episode;
            $ep->link = $request->link;

            $ep->save();

            return response()->json([
                'success' => true,
                'message' => 'Episode updated Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteEpisode($id)
    {
        try {
            $ep = Episode::find($id);

            if (!$ep) return response()->json([
                'success' => false,
                'message' => 'Episode not Found!'
            ], 404);

            $ep->delete();

            return response()->json([
                'success' => true,
                'message' => 'Episode deleted Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
