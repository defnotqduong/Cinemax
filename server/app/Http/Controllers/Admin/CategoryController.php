<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function createCategory(CategoryRequest $request)
    {
        $request->validate([]);

        $category = new Category();

        $category['name'] = $request['name'];
        $category['des'] = $request['des'];
        $category['user_id'] = $request['user_id'];
        $category['user_name'] = $request['user_name'];

        $category->save();

        return response()->json(['success' => true, 'message' => 'Category created successfully'], 200);
    }

    public function getAllCategory()
    {
        $categories = Category::paginate();

        return response()->json(['success' => true, 'categories' => $categories], 200);
    }

    public function editCategory(CategoryRequest $request, $id)
    {
        $request->validate([]);

        $category = Category::find($id);

        if (!$category) return response()->json(['success' => false, 'message' => 'Category not found'], 404);

        $category['name'] = $request['name'];
        $category['des'] = $request['des'];
        $category['user_id'] = $request['user_id'];
        $category['user_name'] = $request['user_name'];

        $category->save();

        return response()->json(['success' => true, 'message' => 'Category updated successfully'], 200);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);

        if (!$category) return response()->json(['success' => false, 'message' => 'Category not found'], 404);

        return response()->json(['success' => true, 'category' => $category], 200);
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) return response()->json(['success' => false, 'message' => 'Category not found'], 404);

        $category->delete();

        return response()->json(['success' => true,  'message' => 'Category deleted'], 200);
    }
}
