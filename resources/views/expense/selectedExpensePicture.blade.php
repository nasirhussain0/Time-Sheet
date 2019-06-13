@extends('layouts.app')

@section('content')
  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif
<h2>Create Job</h2>
  <form action="/updateExpensePicture/{{$findExpense->expenses_id}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}
    
  <div class="form-group">
  <label for="profilePic">Current image</label>  
  <br> 
      <img src="{{asset('evidencePics/'.$findExpense->evidencePic)}}" name="evidencePic" id="evidencePic">
      <br>
    <label for="profilePic">Add New Image</label>    
    <input type="file" class="form-control-file" id="evidencePicN"  name="evidencePicN">
  </div>


   <button type="submit" class="btn btn-primary">Submit</button>
</form>




@endsection