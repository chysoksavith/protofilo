<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SkillModel;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;

class SkillController extends Controller
{
    public function list()
    {
        $getRecord = SkillModel::orderBy('id', 'desc')->get();
        return view('admin.skill.list', compact('getRecord'));
    }
    public function add()
    {
        return view('admin.skill.add');
    }
    public function insert(Request $request)
    {
        $request->validate([
            'cate' => 'required',
            'name' => 'required'
        ]);
        $insert = new SkillModel;
        $insert->cate = $request->cate;
        $insert->name = $request->name;
        $insert->status = 1;
        $insert->save();
        return redirect('admin/skill/list')->with('success', 'skill insert success');
    }
    public function edit($id)
    {
        $getSingle = SkillModel::findOrFail($id);
        return view('admin.skill.edit', compact('getSingle'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'cate' => 'required',
            'name' => 'required'
        ]);

        // Find the record to update
        $skill = SkillModel::findOrFail($id);

        // Update the record
        $skill->cate = $request->cate;
        $skill->name = $request->name;
        $skill->status = $request->status;
        $skill->save();

        // Redirect with success message
        return redirect('admin/skill/list')->with('success', 'Skill updated successfully');
    }

    public function destroy($id)
    {
        $delete = SkillModel::findOrFail($id);
        $delete->delete();
        return redirect()->back()->with('success', 'skill delete success');
    }
}
