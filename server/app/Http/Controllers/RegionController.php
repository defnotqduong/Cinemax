<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getAllRegion()
    {
        $regions = Region::all();

        return response()->json(['success' => true, 'regions' => $regions], 200);
    }
}
