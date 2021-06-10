<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Projects;
use App\Models\Issues;

class ProjectsController extends Controller
{
    public function add_project()
    {
        return view('add-project');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|unique:projects|regex:/[a-zA-Z0-9\s]+/',
            'project_description' => 'nullable',
        ],[
            'project_name.regex' => 'The project name must contain only alpha numeric values',
        ]);
       
        $projects= new Projects();
        $projects->project_name=$request->input('project_name');
        $projects->project_description=$request->input('project_description');
        $projects->status='Open';
        $projects->save();
        return redirect('/home')->with('status','Project created successfully !!');
    }

    public function changeProjectStatus($id)
    {
        $issues=Issues::where('project_id',$id)->where('status','NEW')->first();
        if($issues !=null)
        {
            return redirect()->back()->with('error','There are open issues in this project, Close the issues to close the project !!');
        }
        $projects=Projects::find($id);
        $projects->status='Closed';
        $projects->save();
        return redirect()->back()->with('success','Project closed successfully !!');
    }
}
