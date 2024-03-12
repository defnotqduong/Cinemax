<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => []]);
    // }

    public function createRegion(RegionRequest $request)
    {
        $request->validate([]);

        $region = new Region();

        $region['name'] = $request['name'];
        $region['des'] = $request['des'];
        $region['user_id'] = $request['user_id'];
        $region['user_name'] = $request['user_name'];

        $region->save();

        return response()->json(['success' => true, 'message' => 'Region created successfully'], 200);
    }

    public function getAllRegion(Request $request)
    {
        $regions = Region::all();

        return response()->json(['success' => true, 'regions' => $regions], 200);
    }

    public function editRegion(RegionRequest $request, $id)
    {
        $request->validate([]);

        $region = Region::find($id);

        if (!$region) return response()->json(['success' => false, 'message' => 'Region not found'], 404);

        $region['name'] = $request['name'];
        $region['des'] = $request['des'];
        $region['user_id'] = $request['user_id'];
        $region['user_name'] = $request['user_name'];

        $region->save();

        return response()->json(['success' => true, 'message' => 'Region updated successfully'], 200);
    }

    public function getRegion($id)
    {
        $region = Region::find($id);

        if (!$region) return response()->json(['success' => false, 'message' => 'Region not found'], 404);

        return response()->json(['success' => true, 'region' => $region], 200);
    }

    public function deleteRegion($id)
    {
        $region = Region::find($id);

        if (!$region) return response()->json(['success' => false, 'message' => 'Region not found'], 404);

        $region->delete();

        return response()->json(['success' => true,  'message' => 'Region deleted'], 200);
    }
}
