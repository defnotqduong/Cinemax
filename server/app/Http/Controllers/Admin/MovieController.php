<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MovieRequest;
use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Director;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Region;
use App\Models\Studio;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MovieController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }


    public function getAllMovie(Request $request)
    {
        $movies = Movie::with('categories', 'regions')->when(!empty($request['category_id']), function ($movie) {
            return $movie->whereHas('categories', function ($categories) {
                $categories->where('id', request('category_id'));
            });
        })->when(!empty($request['region_id']), function ($movie) {
            return $movie->whereHas('regions', function ($regions) {
                $regions->where('id', request('region_id'));
            });
        })->when(!empty($request['year']), function ($movie) {
            return $movie->where('year', request('year'));
        })->when(!empty($reques['type']), function ($movie) {
            return $movie->where('type', request('type'));
        })->when(!empty($request['search']), function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('origin_name', 'like', '%' . request('search')  . '%');
            })->orderBy('name', 'desc');
        })->when(!empty($request['sort']), function ($movie) {
            if (request('sort') == 'create') {
                return $movie->orderBy('created_at', 'desc');
            }
            if (request('sort') == 'update') {
                return $movie->orderBy('updated_at', 'desc');
            }
            if (request('sort') == 'year') {
                return $movie->orderBy('publish_year', 'desc');
            }
            if (request('sort') == 'view') {
                return $movie->orderBy('view_total', 'desc');
            }
        })->paginate($request->limit ?? 16);

        return response()->json(['success' => true, 'movies' => $movies], 200);
    }

    public function createMovie(MovieRequest $request)
    {
        $request->validate([]);

        $movie = new Movie();

        $movie['name'] = $request['name'];
        $movie['origin_name'] = $request['origin_name'];
        $movie['thumb_url'] =  $request['thumb_url'];
        $movie['poster_url'] =  $request['poster_url'];
        $movie['content'] = $request['content'];
        $movie['type'] = $request['type'];
        $movie['status'] = $request['status'];
        $movie['trailer_url'] = $request['trailer_url'];
        $movie['episode_time'] = $request['episode_time'];
        $movie['episode_current'] = $request['episode_current'];
        $movie['episode_total'] = $request['episode_total'];
        $movie['quality'] = $request['quality'];
        $movie['language'] = $request['language'];
        $movie['notify'] = $request['notify'];
        $movie['showtimes'] = $request['showtimes'];
        $movie['year'] = $request['year'];
        $movie['is_show_in_theater'] = $request['is_show_in_theater'];
        $movie['is_recommended'] = $request['is_recommended'];
        $movie['is_copyright'] = $request['is_copyright'];
        $movie['view_total'] = $request['view_total'];
        $movie['view_day'] = $request['view_day'];
        $movie['view_week'] = $request['view_week'];
        $movie['view_month'] = $request['view_month'];
        $movie['rating_count'] = $request['rating_count'];
        $movie['rating_star'] = $request['rating_star'];
        $movie['user_id'] = $request['user_id'];
        $movie['user_name'] = $request['user_name'];

        $movie->save();

        // $this->getTaxonamies($request);

        $movie_id = $movie->id;

        // $actor_ids = request('actors', []);
        // $director_ids = request('directors', []);
        // $tag_ids = request('tags', []);
        // $studio_ids = request('studios', []);
        $category_ids = request('category_ids', []);
        $region_ids = request('region_ids', []);

        // $movie->actors()->attach(array_map(function ($actor_id) use ($movie_id) {
        //     return ['movie_id' => $movie_id, 'actor_id' => $actor_id];
        // }, $actor_ids));

        // $movie->directors()->attach(array_map(function ($director_id) use ($movie_id) {
        //     return ['movie_id' => $movie_id, 'director_id' => $director_id];
        // }, $director_ids));

        // $movie->tags()->attach(array_map(function ($tag_id) use ($movie_id) {
        //     return ['movie_id' => $movie_id, 'tag_id' => $tag_id];
        // }, $tag_ids));

        // $movie->studios()->attach(array_map(function ($studio_id) use ($movie_id) {
        //     return ['movie_id' => $movie_id, 'studio_id' => $studio_id];
        // }, $studio_ids));

        $movie->categories()->attach(array_map(function ($category_id) use ($movie_id) {
            return ['movie_id' => $movie_id, 'category_id' => $category_id];
        }, $category_ids));

        $movie->regions()->attach(array_map(function ($region_id) use ($movie_id) {
            return ['movie_id' => $movie_id, 'region_id' => $region_id];
        }, $region_ids));

        $this->createEpisode($request, $movie_id);

        return response()->json(['success' => true, 'message' => 'Movie created successfully'], 200);
    }

    public function editMovie(MovieRequest $request)
    {
        $request->validate([]);

        $movie = Movie::find($request->id);

        if (!$movie) return response()->json(['success' => false, 'message' => 'Movie not found'], 404);

        $movie['name'] = $request['name'];
        $movie['origin_name'] = $request['origin_name'];
        $movie['content'] = $request['content'];
        $movie['thumb_url'] = $request['thumb_url'];
        $movie['poster_url'] = $request['poster_url'];
        $movie['type'] = $request['type'];
        $movie['status'] = $request['status'];
        $movie['trailer_url'] = $request['trailer_url'];
        $movie['episode_time'] = $request['episode_time'];
        $movie['episode_current'] = $request['episode_current'];
        $movie['episode_total'] = $request['episode_total'];
        $movie['quality'] = $request['quality'];
        $movie['language'] = $request['language'];
        $movie['notify'] = $request['notify'];
        $movie['showtimes'] = $request['showtimes'];
        $movie['year'] = $request['year'];
        $movie['is_show_in_theater'] = $request['is_show_in_theater'];
        $movie['is_recommended'] = $request['is_recommended'];
        $movie['is_copyright'] = $request['is_copyright'];
        $movie['is_sensitive_content'] = $request['is_sensitive_content'];
        $movie['view_total'] = $request['view_total'];
        $movie['view_day'] = $request['view_day'];
        $movie['view_week'] = $request['view_week'];
        $movie['view_month'] = $request['view_month'];
        $movie['rating_count'] = $request['rating_count'];
        $movie['rating_star'] = $request['rating_star'];
        $movie['user_id'] = $request['user_id'];
        $movie['user_name'] = $request['user_name'];

        $movie->save();

        $category_ids = $request->input('category_ids', []);
        $movie->categories()->sync($category_ids);

        $region_ids = $request->input('region_ids', []);
        $movie->regions()->sync($region_ids);

        // Update episodes
        // Lấy danh sách các tập phim hiện có của bộ phim
        $existingEpisodes = $movie->episodes()->pluck('id')->toArray();

        // Lấy danh sách các tập phim gửi trong yêu cầu
        $receivedEpisodes = $request->input('episodes', []);

        // Lặp qua các tập phim gửi trong yêu cầu
        foreach ($receivedEpisodes as $episodeData) {
            if (!empty($episodeData['server']) && !empty($episodeData['name']) && !empty($episodeData['type'])) {
                $episodeId = $episodeData['id'] ?? null;

                if ($episodeId) {
                    // Nếu tập phim tồn tại trong danh sách hiện tại, cập nhật thông tin
                    if (in_array($episodeId, $existingEpisodes)) {
                        $episode = Episode::find($episodeId);
                        $episode->update($episodeData);
                    }
                } else {
                    // Nếu tập phim không tồn tại trong danh sách hiện tại, tạo mới
                    $movie->episodes()->create($episodeData);
                }
            }
        }

        // Xóa các tập phim không còn trong danh sách gửi
        $deletedEpisodes = array_diff($existingEpisodes, array_column($receivedEpisodes, 'id'));
        Episode::whereIn('id', $deletedEpisodes)->delete();

        return response()->json(['success' => true, 'message' => 'Movie updated successfully'], 200);
    }

    public function getMovieOverview(Request $request, $id)
    {
        $movie = Movie::with('categories', 'regions')->find($id);

        if (!$movie) return response()->json(['success' => false, 'message' => 'Movie not found'], 404);

        $episodes = $movie->episodes()->orderByRaw("CAST(LPAD(name, 2, '0') AS UNSIGNED) ASC")->get();

        $servers = $episodes->pluck('server')->unique()->values()->toArray();


        return response()->json(['success' => true, 'movie' => $movie, 'servers' => $servers, 'episodes' => $episodes], 200);
    }


    public function getMovieOfCategory(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category) return response()->json(['success' => false, 'message' => 'Category not found'], 404);

        $movies = $category->movies()->orderBy('created_at', 'desc')->paginate($request->limit ?? 16);

        return response()->json(['success' => true, 'category' => $category, 'movies' => $movies], 200);
    }

    public function getMovieOfRegion(Request $request, $id)
    {
        $region = Region::find($id);

        if (!$region) return response()->json(['success' => false, 'message' => 'Region not found'], 404);

        $movies = $region->movies()->orderBy('created_at', 'desc')->paginate($request->limit ?? 16);

        return response()->json(['success' => true, 'region' => $region, 'movies' => $movies], 200);
    }


    protected function getTaxonamies(Request $request)
    {
        $actors = request('actors', []);
        $directors = request('directors', []);
        $tags = request('tags', []);
        $studios = request('studios', []);

        $actor_ids = [];
        foreach ($actors as $actor) {
            $actor_ids[] = Actor::firstOrCreate([
                'name' => $actor
            ])->id;
        }

        $director_ids = [];
        foreach ($directors as $director) {
            $director_ids[] = Director::firstOrCreate([
                'name' => $director
            ])->id;
        }

        $tag_ids = [];
        foreach ($tags as $tag) {
            $tag_ids[] = Tag::firstOrCreate([
                'name' => $tag
            ])->id;
        }

        $studio_ids = [];
        foreach ($studios as $studio) {
            $studio_ids[] = Studio::firstOrCreate([
                'name' => $studio
            ])->id;
        }

        $request['actors'] = $actor_ids;
        $request['directors'] = $director_ids;
        $request['tags'] = $tag_ids;
        $request['studios'] = $studio_ids;
    }

    protected function createEpisode(Request $request, $id)
    {
        $episodesData = request('episodes', []);

        foreach ($episodesData as $episodeData) {
            if (!empty($episodeData['server']) && !empty($episodeData['name']) && !empty($episodeData['type'])) {
                $episode = Episode::create(
                    [
                        'movie_id' => $id,
                        'server' => $episodeData['server'],
                        'name' => $episodeData['name'],
                        'type' => $episodeData['type'],
                        'link' => $episodeData['link'],
                    ]
                );
            }
        }
    }
}
