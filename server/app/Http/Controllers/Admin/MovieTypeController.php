<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\MovieType;
use Illuminate\Http\Request;

class MovieTypeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }

    public function getMovieTypes()
    {
        $types = MovieType::all();

        return response()->json(['success' => true, 'types' => $types], 200);
    }
}
