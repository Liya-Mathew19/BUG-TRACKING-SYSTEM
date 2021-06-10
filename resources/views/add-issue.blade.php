@extends('layouts.app')
@section('content')
<!-- Create New Project Modal -->
<form action="{{route('addIssues',$project->id)}}" method="POST">
        @csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Create Issue</b></h5>
                </div>
                <div class="card-body">
                <div class="form-group row">
            <label for="project-name" class="col-sm-2 col-form-label">Tracker:</label>
            <select class="form-control col-sm-9" name="tracker" aria-label="Default select example">
                <option value="">Select a tracker</option>
                <option value="Bug">Bug</option>
                <option value="Feature">Feature</option>
            </select>
            @error('tracker')
                <font color="red" class="col-sm-9">* {{ $message }}</font>
            @enderror
        </div>
        <div class="form-group">
            <label for="issue_description" class="col-form-label">Description:</label>
            <textarea class="form-control @error('issue_description') is-invalid @enderror" value="{{ old('issue_description') }}" autocomplete="issue_description" autofocus id="issue_description" name="issue_description" id="issue_description"></textarea>
            @error('issue_description')
                        <font color="red">* {{ $message }}</font>
                    @enderror
        </div>
      </div>
                <div class="card-footer">
                    <a href="{{route('home')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                    <button type="submit" class="btn btn-primary">CREATE ISSUE</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection