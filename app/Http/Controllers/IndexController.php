<?php

namespace App\Http\Controllers;

use App\Models\CertificateModel;
use App\Models\FooterModel;
use App\Models\InfoModel;
use App\Models\ProjectModel;
use App\Models\SkillModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        return view('index', );
    }
    public function project()
    {
        $getProject = ProjectModel::with('images')->get();
        return view('project', compact('getProject'));
    }
    public function project_detail($id)
    {
        $getProjectDetail = ProjectModel::with('images')->findOrFail($id);
        return view('detail', compact('getProjectDetail'));
    }
    public function info()
    {
        // Fetch the first record (if needed)
        $getRecord = InfoModel::first();

        // Fetch records where 'cate' is 'program'
        $getSoftware = SkillModel::where('cate', 'program')->where('status', 1)->get();
        $getHard = SkillModel::where('cate', 'hard')->where('status', 1)->get();
        $getSoft = SkillModel::where('cate', 'soft')->where('status', 1)->get();
        $getCertificate = CertificateModel::where('status', 1)->get();
        // Pass the data to the view
        return view('info', compact('getRecord', 'getCertificate', 'getSoftware', 'getHard', 'getSoft'));
    }
    public function contact()
    {
        return view('hire');
    }
}
