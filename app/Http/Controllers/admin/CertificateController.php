<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CertificateModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function list()
    {
        $getRecord = CertificateModel::get();
        return view('admin.certi.list', compact('getRecord'));
    }

    public function add()
    {
        return view('admin.certi.add');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,tiff,tif,webp,svg,heic,heif|max:20480',
        ]);
        $insert = new CertificateModel;
        $insert->name = $request->name;
        $insert->status = 1;
        if ($request->hasFile('image')) {
            $mainImage = $request->file('image');
            $mainImageName = Str::random(10) . '.' . $mainImage->getClientOriginalExtension();

            // Store the image in the public disk
            $path = $mainImage->storeAs('images', $mainImageName, 'public');

            // Save the path in the database
            $insert->image = $path;
        }
        $insert->save();
        return redirect('admin/certificate/list')->with('success', 'Certificate added successfully');
    }

    public function edit($id)
    {
        $getSingle = CertificateModel::findOrFail($id);
        return view('admin.certi.edit', compact('getSingle'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,tiff,tif,webp,svg,heic,heif|max:2048',
        ]);

        // Find the certificate model instance
        $certificate = CertificateModel::findOrFail($id);
        $certificate->name = $request->name;
        $certificate->status = $request->status;

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old photo if it exists
            if ($certificate->image) {
                // Remove the old photo from storage
                Storage::disk('public')->delete($certificate->image);
            }

            // Upload the new photo
            $fileName = time() . '.' . $request->file('image')->extension();
            $filePath = $request->file('image')->storeAs('images', $fileName, 'public');

            // Save the relative path in the database
            $certificate->image = $filePath;
        }

        // Save the certificate model instance
        $certificate->save();

        return redirect('admin/certificate/list')->with('success', 'Certificate updated successfully');
    }
    public function destroy($id)
    {
        $certificate = CertificateModel::findOrFail($id);

        if ($certificate->image) {
            // Delete the old photo if it exists
            Storage::disk('public')->delete($certificate->image);
        }

        // Delete the certificate record
        $certificate->delete();

        return redirect()->back()->with('success', 'Information and image deleted successfully');
    }
}
