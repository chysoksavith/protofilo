<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FooterModel;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function list()
    {
        $getRecord = FooterModel::get();
        return view('admin.footer.list', compact('getRecord'));
    }
    public function add()
    {
        return view('admin.footer.add');
    }
    public function insert(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            // Include 'link' only if it's needed
        ]);

        // Create and save the model
        $insert = new FooterModel;
        $insert->name = trim($request->input('name'));
        $insert->url = trim($request->input('url'));
        $insert->save();

        // Redirect with success message
        return redirect('admin/footer/list')->with('success', 'Insert successful');
    }
    public function edit($id)
    {
        $getSingle = FooterModel::findOrFail($id);
        return view('admin.footer.edit', compact('getSingle'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'url' => 'required',
            // Include 'link' only if it's needed
        ]);

        // Create and save the model
        $update = FooterModel::findOrFail($id);
        $update->name = trim($request->input('name'));
        $update->url = trim($request->input('url'));
        $update->status = trim($request->input('status'));

        $update->save();

        // Redirect with success message
        return redirect('admin/footer/list')->with('success', 'Insert successful');
    }
    public function destroy($id)
    {
        $delete = FooterModel::findOrFail($id);
        $delete->delete();

        return redirect()->back()->with('success', 'delete success');
    }
}
