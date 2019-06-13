@extends('layouts.app')

@section('content')
  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif
<h2>Update job details</h2>

<form action="/updateJob/{{$job->id}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
  <div class="form-group">
    <label for="name">Job name</label>
    <input type="text" class="form-control" id="name"  name="name" value="{{$job->name}}" required>
  </div>
  <div class="form-group">
    <label for="location">Location</label>
    <input type="text" class="form-control" id="location"  name="location"value="{{$job->location}}" required>
  </div>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection