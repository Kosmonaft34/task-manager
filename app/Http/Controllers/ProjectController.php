<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
    public function index(){
        return view('project.index');
    }

    public function create(){
        $projects=Project::select('id', 'created_at', 'updated_at', 'name')->get();
        return view('project.create',['create_project'=>$projects]);
    }
}

