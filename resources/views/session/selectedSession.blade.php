@extends('layouts.app')

@section('content')
  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif
<h2>Create Job</h2>
  <form action="/updateSession/{{$findSession->session_id}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}

  <div class="form-group">
    <label for="startTime">Start Time</label>
    <input type="time" class="form-control" id="startTime"  name="startTime" value="{{$findSession->startTime}}" required >
  </div>

  <div class="form-group">
    <label for="endTime">End Time</label>
    <input type="time" class="form-control" id="endTime"  name="endTime" value="{{$findSession->endTime}}" required>
  </div>

  <div class="form-group">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date"  name="date" value="{{$findSession->date}}"  required>
  </div>

  <div class="form-group">
    <label for="status">Session approved</label>
    <input type="text" class="form-control" id="sessionStatus"  name="sessionStatus"  value="{{$findSession->session_approved}}" required readonly>
  </div>

  <div class="form-group">
    <label for="notes">Notes</label>
      <input type="text" class="form-control" id="notes"  name="notes"  value="{{$findSession->notes}}" required>
  </div>

  <select name="job" id="job" class="form-control">
      <option value="{{ $findSession->job_id }}">{{ $findSession->name }}</option>

  </select>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection