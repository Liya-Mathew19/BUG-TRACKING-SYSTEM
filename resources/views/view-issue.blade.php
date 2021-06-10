@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <a href="{{route('issues', ['id' => $issues->project_id])}}"><button type="button" class="btn btn-info mb-2">Back</button></a>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10"><h4>Issue {{$issues->id}}</h4></div>
                        <div class="col-2">
                            @if($issues->status=='NEW')
                            <a href="{{route('changeStatus',$issues->id)}}"><button type="button" class="btn btn-danger">Close Issue</button></a>
                            @else
                            <button type="button" disabled class="btn btn-success">Issue Closed</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="container-fluid mt-5 mb-5">
                    <h4>Issue Details</h4>
                    <div class="card issues_card" id="issues_card" style="margin-top: 16px; cursor: pointer;">
                        <div class="card-body">
                            <div class="row mt-3 mb-3">
                                <div class="col-4"><b>Tracker :</b> </div>
                                <div class="col-6">{{$issues->tracker}}</div>
                            </div>
                            <div class="row">
                                <div class="col-6"><b>Description :</b></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">{{$issues->issue_description}}</div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
