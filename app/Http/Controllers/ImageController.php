<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,webp|max:2048', // Validate the image
        ]);

        $path = $request->file('image')->store('uploads', 'public'); // Save the image in the "public/uploads" directory

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => asset('storage/' . $path), // Return the URL of the uploaded image
            ],
        ]);
    }
}
