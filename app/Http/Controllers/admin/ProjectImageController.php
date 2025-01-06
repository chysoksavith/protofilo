<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageModel;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectImageController extends Controller
{
    public function index(int $productId)
    {
        $project = ProjectModel::findOrFail($productId);
        $productImage = ImageModel::where('project_id', $productId)->get();
        return view('admin.image.index', compact('project', 'productImage'));
    }
    public function store(Request $request, int $productId)
    {
        // Validate the uploaded files
        $request->validate([
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,tiff,tif,webp,svg,heic,heif|max:20480',
        ]);

        // Find the product
        $product = ProjectModel::findOrFail($productId);
        $imageData = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                if ($file->isValid()) {
                    // Generate a unique filename
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    // Store the file
                    $path = $file->storeAs('public/images', $filename);
                    // Add to image data array
                    $imageData[] = [
                        'project_id' => $product->id,
                        'image' => $filename,
                    ];
                }
            }
        }

        if (!empty($imageData)) {
            ImageModel::insert($imageData);
            return redirect()->back()->with('success', 'Images uploaded successfully');
        } else {
            return redirect()->back()->with('error', 'No images selected or uploaded');
        }
    }



    public function delete(int $projectId)
    {
        $projectImage = ImageModel::findOrFail($projectId);

        $imagePath = storage_path('app/public/images/' . $projectImage->image);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $projectImage->delete();

        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
