<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $path = $image->store('uploads', 'public');

            return response()->json([
                'success' => true,
                'message' => 'Image Upload Successfully!',
                'image_url' => asset('storage/' . $path)
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
    }


    public function delete(Request $request)
    {
        $imageUrl = $request->input('image_url');
        if ($imageUrl) {
            $filePath = str_replace(url('/storage'), 'public', $imageUrl);
            if (Storage::disk('local')->exists($filePath)) {
                Storage::disk('local')->delete($filePath);
                return response()->json(['success' => true, 'message' => 'Image deleted successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Image not found'], 404);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Image URL is required'], 400);
        }
    }
}
