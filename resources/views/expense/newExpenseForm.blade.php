@extends('layouts.app')

@section('content')
  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif
<h2>Create Job</h2>
  <form action="{{url('createNewExpense')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}

  <div class="form-group">
    <label for="amount">Cost</label>
    <input type="text" class="form-control" id="amount"  name="amount" required>
  </div>

  <div class="form-group">
    <label for="evidencePic">Upload</label>    
    <input type="file" class="form-control-file" id="evidencePic" name="evidencePic">
  </div>
  <div class="form-group">
    <label for="paymentType">Payment Type</label>
    <input type="text" class="form-control" id="paymentType"  name="paymentType" required>
  </div>

   <button type="submit" class="btn btn-primary">Submit</button>
</form>




@endsection