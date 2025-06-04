<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropertyImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function upload(Request $request, $propertyId)
    {
        $property = Property::find($propertyId);
        
        if (!$property) {
            return response()->json(['message' => 'Property not found'], 404);
        }

        $request->validate([
            'image' => 'required|image|max:5120', // 5MB max
            'is_primary' => 'boolean'
        ]);

        $path = $request->file('image')->store('property-images', 'public');
        
        $image = PropertyImage::create([
            'property_id' => $propertyId,
            'path' => $path,
            'filename' => $request->file('image')->getClientOriginalName(),
            'is_primary' => $request->input('is_primary', false)
        ]);

        return response()->json($image, 201);
    }

    public function delete($propertyId, $imageId)
    {
        $image = PropertyImage::where('property_id', $propertyId)
            ->where('id', $imageId)
            ->first();

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}
