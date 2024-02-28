<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['getAllCategory', 'getInitialCategory', 'getCategory']]);
    }

    public function createCategory(Request $request)
    {
        $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);
        try {
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

    public function getInitialCategory()
    {
        try {
            $categories = Category::all();

            return response()->json([
                'success' => true,
                'message' => 'Categories Fetched Successfully!',
                'categories' => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getAllCategory()
    {
        try {
            $categories = Category::where('status', 1)->get();

            return response()->json([
                'success' => true,
                'message' => 'Categories Fetched Successfully!',
                'categories' => $categories
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function getCategory($slug)
    {
        try {
            $category  = Category::findBySlug($slug);

            if (!$category) return response()->json([
                'success' => false,
                'message' => 'Category Not Found!'
            ], 404);

            return response()->json([
                'success' => true,
                'message' => 'Category Found!',
                'category' => $category
            ], 200);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function editCategory(Request $request, $slug)
    {
        $request->validate(['title' => 'required|string', 'description' => 'nullable', 'status' => 'required|boolean']);
        try {

            $category  = Category::findBySlug($slug);

            if (!$category) return response()->json([
                'success' => false,
                'message' => 'Category Not Found!'
            ], 404);

            $category->title = $request->title;
            $category->description = $request->description;
            $category->status = $request->status;

            $category->save();

            return response()->json([
                'success' => true,
                'message' => 'Category Edited Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['seccess' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category  = Category::find($id);

            if (!$category) return response()->json([
                'success' => false,
                'message' => 'Category Not Found!'
            ], 404);

            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Category deleted Successfully!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
