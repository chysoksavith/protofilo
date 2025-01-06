<?php

namespace App\Http\Controllers\admin;

use Exception;
use Illuminate\Support\Str;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageModel;

class ProjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ProjectModel::get();
        return view('admin.protofilo.list', $data);
    }
    public function add()
    {
        return view('admin.protofilo.add');
    }

    public function insert(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'project_list' => 'required|string|max:255',
            'url_project' => 'required|string|max:255',

            'description' => 'nullable|string',
            'year' => 'required|numeric',
            'agency' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
        ]);

        // Save the main project
        $project = new ProjectModel;
        $project->name = trim($request->name);
        $project->project_list = trim($request->project_list);
        $project->url_project = trim($request->url_project);
        $project->description = trim($request->description);
        $project->year = trim($request->year);
        $project->agency = trim($request->agency);
        $project->role = trim($request->role);
        $project->save();


        return redirect('admin/project/list')->with('success', 'Project added successfully');
    }

    public function delete($id)
    {
        // Find the project by ID
        $project = ProjectModel::find($id);

        if ($project) {
            // Delete associated images
            $project->images()->delete();

            // Delete the project
            $project->delete();
            return redirect()->back()->with('success', 'success');
        } else {
            return redirect()->back()->with('success', 'not found');
        }
    }
}
