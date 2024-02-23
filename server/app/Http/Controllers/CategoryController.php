<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
    }

    public function createCategory(Request $request)
    {
        try {
            $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'nullable']);

            $category = new Category();

            $category->title = $request->title;
            $category->description = $request->description;
            $category->status = $request->status;

            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category created Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
