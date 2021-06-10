@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('add-project')}}"><button type="button" class="btn btn-primary">+ Create Project</button></a>
                        </div>
                        <form action="{{route('home')}}" method="post">
                        @csrf
                        <div class="col">
                            <input type="text" name="search" class="form-control" placeholder="Search Project">
                        </div>
                        <div class="col-xs-2 ml-2 mt-2" style="float:right">
                            <input type="submit" name="filter" value="FILTER" class="btn btn-success">
                            <button type="submit" class="btn btn-warning ml-2" onclick="this.form.reset();">Clear</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="container-fluid mt-5 mb-5">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($projects->isEmpty())
                    <center><font color="red"><h5>No Projects Found</h5></font></center>
                    @endif
                    @foreach($projects as $project_details)
                  <a href="{{route('issues',$project_details->id)}}" style="text-decoration:none;color:black">
                    <div class="card" style="margin-top: 16px; cursor: pointer;">
                        <div class="card-body">
                        <div class="row">
                            <div class="col-5"><h4>{{$project_details->project_name}}</h4></div>
                            <div class="col-4">Number of issues : {{$project_details->issues->count()}} </div>
                            @if($project_details->status=='Open')
                            <div class="col-3">Status : <span class="badge badge-success">{{$project_details->status}}</span></div>
                            @else
                            <div class="col-3">Status : <span class="badge badge-danger">{{$project_details->status}}</span></div>
                            @endif
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">Description : {{$project_details->project_description}}</div>
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
