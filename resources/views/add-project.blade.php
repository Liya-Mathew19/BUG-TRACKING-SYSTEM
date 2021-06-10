@extends('layouts.app')
@section('content')
<!-- Create New Project Modal -->
<form action="{{route('addProject')}}" id="formSubmit" method="POST">
        @csrf
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Create Project</b></h5>
                </div>
                <div class="card-body">
                <div class="form-group row">
                <label for="project-name" class="col-sm-3 col-form-label">Project Name:</label>
                <div class="col-sm-9">
                    <input type="text" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}" autocomplete="project_name" autofocus id="project_name">
                    @error('project_name')
                        <font color="red">* {{ $message }}</font>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="project_description" class="col-form-label">Description:</label>
                <textarea class="form-control @error('project_description') is-invalid @enderror" value="{{ old('project_description') }}" autocomplete="project_description" autofocus id="project_name" name="project_description" id="project_description">{{ old('project_description') }}</textarea>
            </div>
      </div>
                <div class="card-footer">
                    <a href="{{route('home')}}"><button type="button" class="btn btn-secondary">Cancel</button></a>
                    <button type="submit" class="btn btn-primary">CREATE PROJECT</button>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection