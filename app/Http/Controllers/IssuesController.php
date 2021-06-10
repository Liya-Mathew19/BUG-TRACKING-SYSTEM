<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Projects;
use App\Models\Issues;
use View;
use Illuminate\Validation\Rule;
use Session;

class IssuesController extends Controller
{
    public function issueView(Request $request,$id)
    {
        $project=Projects::find($id);
        $issues=Issues::where('project_id',$id)->get();
        if($request->input('search') != null)
        {
            $search = [['issue_description', 'like', '%' . $request->input('search') . '%']];
            if($request->input('tracker') !=null){
                $tracker = array('tracker',$request->input('tracker'));
                array_push($search, $tracker);
            }
            if($request->input('status')!=null){
                $status = ['status', $request->input('status')];
                array_push($search, $status);
            }
            //dd($search);
            $issues=Issues::where('project_id',$id)->where($search)->get();
        }
        if($request->input('tracker')!=null){
            $tracker = [
                ['tracker', $request->input('tracker')],
            ];
            if($request->input('status')!=null){
                $status = ['status', $request->input('status')];
                array_push($tracker, $status);
            }
            if($request->input('search')!=null){
                $search = ['issue_description', 'like', '%' . $request->input('search') . '%'];
                array_push($tracker, $search);
            }
            $issues=Issues::where('project_id',$id)->where($tracker)->get();
        }
       
        if($request->input('status')!=null){
            $status = [
                ['status',$request->input('status')],
            ];
            if($request->input('tracker')!=null){
                $tracker = ['tracker', $request->input('tracker')];
                array_push($status, $tracker);
            }
            if($request->input('search')!=null){
                $search = ['issue_description', 'like', '%' . $request->input('search') . '%'];
                array_push($status, $search);
            }
            $issues=Issues::where('project_id',$id)->where($status)->get();
        }
        return view('issues',compact('project','issues'));
    }

    public function editIssue($id)
    {
        $issues=Issues::find($id);
        return view('edit-issue',compact('issues'));
    }

    public function issueDetail($id)
    {
        $issues=Issues::find($id);
        return view('view-issue',compact('issues'));
    }

    public function updateIssue(Request $request,$id)
    {
        $request->validate([
            'tracker' => 'required',
            'issue_description' => 'required|unique_with:issues,tracker,'.$id,
        ]);

        $issues=Issues::find($id);
        $project_id=$issues->project_id;
        $project=Projects::find($id);
        $issues->tracker=$request->input('tracker');
        $issues->issue_description=$request->input('issue_description');
        $issues->save();
        return redirect()->route('issues', ['id' => $project_id])->with('status','Issue updated successfully !!');
    }

    public function add_issue($id)
    {
        $project=Projects::find($id);
        return view('add-issue',compact('project'));
    }

    public function store(Request $request,$id)
    {
        $request->validate([
            'tracker' => 'required',
            'issue_description' => 'required|unique_with:issues,tracker',
        ]);
        
        $issues= new Issues();
        $issues->project_id=$id;
        $issues->tracker=$request->input('tracker');
        $issues->issue_description=$request->input('issue_description');
        $issues->status='NEW';
        $issues->save();
        return view('view-issue',compact('issues'));
        //return redirect()->back()->with('status','Issue created successfully !!');
    }

    public function changeStatus($id)
    {
        $issues=Issues::find($id);
        $project_id=$issues->project_id;
        $issues->status='Closed';
        $issues->save();
        return redirect()->route('issues', ['id' => $project_id])->with('status','Status changed successfully !!');
    }
}
