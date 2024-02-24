<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllCountry', 'getCountry']]);
    }

    public function createCountry(Request $request)
    {
        try {
            $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);

            $country = new Country();

            $country->title = $request->title;
            $country->description = $request->description;

            $country->save();

            return response()->json([
                'success' => true,
                'message' => 'Country created Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getAllCountry()
    {
        try {
            $countries = Country::paginate();

            return response()->json([
                'success' => true,
                'message' => 'Countries Fetched Successfully!',
                'countries' => $countries
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getCountry($slug)
    {
        try {
            $country  = Country::findBySlug($slug);

            if (!$country) return response()->json([
                'success' => false,
                'message' => 'Country Not Found!'
            ], 404);

            return response()->json([
                'success' => true,
                'message' => 'Country Found!',
                'country' => $country
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function editCountry(Request $request, $slug)
    {
        try {
            $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);

            $country  = Country::findBySlug($slug);

            if (!$country) return response()->json([
                'success' => false,
                'message' => 'Country Not Found!'
            ], 404);

            $country->title = $request->title;
            $country->description = $request->description;
            $country->status = $request->status;

            $country->save();

            return response()->json([
                'success' => true,
                'message' => 'Country Edited Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['seccess' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteCountry($slug)
    {
        try {
            $country  = Country::findBySlug($slug);

            if (!$country) return response()->json([
                'success' => false,
                'message' => 'Country Not Found!'
            ], 404);

            $country->delete();

            return response()->json([
                'success' => true,
                'message' => 'Country deleted Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
