<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\Issues;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Session::put('search',null);
        // $filter_data=Session::get('search');
        if($request->has('search'))
        {
            $projects= Projects::where('project_name', 'like', '%' . $request->input('search') . '%')
                                ->orWhere('project_description', 'like', '%' . $request->input('search') . '%')
                                ->with('issues')->get();
        }
        else
        {
            $projects= Projects::with('issues')->get();
        }
        return view('home',compact('projects'));
    }
}
