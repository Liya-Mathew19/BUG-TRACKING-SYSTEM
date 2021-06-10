@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <a href="{{route('home')}}"><button type="button" class="btn btn-info mb-2">Back</button></a>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
         @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-7"><h4>{{$project->project_name}}</h4></div>
                        <div class="col-5">
                            @if($project->status=='Open')
                            <a href="{{route('changeProjectStatus',$project->id)}}"><button type="button" class="btn btn-danger">Close Project</button></a>
                            @else
                            <button type="button" disabled class="btn btn-success">Project Closed</button>
                            @endif
                            <a href="{{route('add-issue',$project->id)}}"><button type="button" style="margin-left: 50px;" class="btn btn-primary"> + Create Issue</button></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">{{$project->project_description}}</div>
                    </div>
                </div>
                <div class="container-fluid mt-5 mb-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('issues',$project->id)}}" method="post">
                    @csrf
                    <div class="form-group row" style="margin-left: 470px">
                        <div class="col-xs-2 ml-2">
                            <select class="form-control" id="tracker" name="tracker" aria-label="Default select example">
                                <option value="">Tracker</option>
                                <option value="Bug">Bug</option>
                                <option value="Feature">Feature</option>
                            </select>
                        </div>
                        <div class="col-xs-2 ml-2">
                            <select class="form-control" name="status" aria-label="Default select example">
                                <option value="">Status</option>
                                <option value="NEW">Open</option>
                                <option value="Closed">Closed</option>
                            </select>
                        </div>
                        <div class="col-xs-2 ml-2">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search Issue">
                            <div class="col-xs-2 ml-2 mt-2" style="float:right">
                            <input type="submit" name="filter" value="FILTER" class="btn btn-success">
                            <button type="submit" class="btn btn-warning ml-2" onclick="this.form.reset();">Clear</button>
                        </div>
                        </div>
                    </div>
                    </form>
                    <h4>Issues</h4>
                    @if($issues->isEmpty())
                    <center><font color="red"><h5>No Issues Found</h5></font></center>
                    @endif
                    @foreach($issues as $issue_details)
                    @php
                    if($loop->index % 2 == 0)
                    {
                        $color="red";
                    }
                    else
                    {
                        $color="blue";
                    }
                    @endphp
                    <a href="{{route('editIssue',$issue_details->id)}}">
                    <div class="card issues_card" id="issues_card" style="margin-top: 16px; border-color:{{$color}}; cursor: pointer;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">#{{$issue_details->id}}</div>
                                <div class="col-2">{{$issue_details->tracker}}</div>
                                <div class="col-2">{{$issue_details->status}}</div>   
                                <div class="col-2">{{\Illuminate\Support\Str::limit($issue_details->issue_description, 20)}}</div>
                                <div class="col-2">{{$issue_details->created_at}} </div>
                                @if($issue_details->status=="NEW")
                                    <div class="col-2"><form action="{{route('changeStatus',$issue_details->id)}}"><button type="submit" class="btn btn-danger">Close</button></form></div>
                                @else
                                    <div class="col-2"><button type="button" disabled class="btn btn-success">Closed</button></div>
                                @endif
                            </div>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
