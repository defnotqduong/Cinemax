<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

            // Lưu ảnh vào thư mục storage/app/public/uploads
            $path = $image->store('uploads', 'public');

            // Trả lại đường dẫn của ảnh sau khi lưu vào storage
            return response()->json([
                'success' => true,
                'message' => 'Image Upload Successfully!',
                'image_url' => asset('storage/' . $path)
            ], 200);
        }

        return response()->json(['success' => false, 'message' => 'No image uploaded'], 400);
    }
}
