<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategory()
    {
        $categories = Category::all();

        return response()->json(['success' => true, 'categories' => $categories], 200);
    }
}
