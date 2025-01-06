<?php

namespace App\Http\Controllers\admin;

use App\Models\InfoModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InfoController extends Controller
{
    public function list()
    {
        $getRecord = InfoModel::orderBy('id', 'desc')->get();
        return view('admin.info.list', compact('getRecord'));
    }
    public function add()
    {
        return view('admin.info.add');
    }
    public function insert(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,tiff,tif,webp,svg,heic,heif|max:20480',
        ]);

        // Create a new instance of the model
        $insert = new InfoModel;
        $insert->name = trim($request->name);
        $insert->description = trim($request->description);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Handle file upload
            $mainImage = $request->file('image');
            $mainImageName = Str::random(10) . '.' . $mainImage->getClientOriginalExtension();

            // Store the file in the 'public/images' directory
            $path = $mainImage->storeAs('images', $mainImageName, 'public');

            // Save the relative path to the model
            $insert->image = $path;
        }

        // Save the model to the database
        $insert->save();

        // Redirect or return a response
        return redirect('admin/info/list')->with('success', 'Information added successfully');
    }

    public function edit($id)
    {
        $getSingle = InfoModel::findOrFail($id);
        return view('admin.info.edit', compact('getSingle'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,tiff,tif,webp,svg,heic,heif|max:2048',
        ]);

        // Find the existing record
        $info = InfoModel::findOrFail($id);

        // Update the model attributes
        $info->name = trim($request->name);
        $info->description = trim($request->description);

        // Handle the image upload

        if ($request->hasFile('image')) {
            // Delete the old photo if it exists
            if ($info->image) {
                // Get the full path of the old image
                $oldPhotoPath = $info->image;

                // Delete the old photo from storage
                if (Storage::disk('public')->exists($oldPhotoPath)) {
                    Storage::disk('public')->delete($oldPhotoPath);
                }
            }

            // Upload the new photo
            $mainImage = $request->file('image');
            $fileName = time() . '.' . $mainImage->getClientOriginalExtension();

            // Store the new file in the 'public/images' directory
            $path = $mainImage->storeAs('images', $fileName, 'public');

            // Save the relative path of the new image
            $info->image = $path;
        }

        // Save the model to the database
        $info->save();

        // Redirect or return a response
        return redirect('admin/info/list')->with('success', 'Information updated successfully');
    }
    public function destroy($id)
    {
        // Find the record to delete
        $info = InfoModel::findOrFail($id);

        // Delete the image file if it exists
        if ($info->image) {
            // Determine the path to the image
            $imagePath = $info->image;

            // Check if the file exists in the 'public' disk and delete it
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        // Delete the record from the database
        $info->delete();

        // Redirect or return a response
        return redirect('admin/info/list')->with('success', 'Information and image deleted successfully');
    }
}
