<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request){
        $data = $request->all();
        $project = new Project();
        $project ->name = $data['name'];
        $project->save();
        return redirect(route('project.index'));
    }
    public function edit($id){

        $edit=Project::find($id);
        if(Auth::user()->can('view',$edit)) {
            return view( 'project.edit');
        }
        else{
            return redirect(route('projects.index'));
        }

    }

    public function update(ProjectUpdateRequest $request,$id){

        //Собрали все данные с формы
        $data = $request->validated();
        $project = new Project;
        $project ->name = $data['name'];
        $project->save();
    }

    public function show(){

    }
    public function destroy(){

    }
}

