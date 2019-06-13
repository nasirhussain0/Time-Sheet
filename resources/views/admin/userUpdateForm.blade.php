@extends('layouts.app')

@section('content')
  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif
<h2>Update user details</h2>

<form action="/updateUserProfile/{{$user->id}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
  <div class="form-group">
    <label for="fullname">Name</label>
    <input type="text" class="form-control" id="fullname"  name="fullname" value="{{$user->fullname}}">
  </div>
  <div class="form-group">
    <label for="email">Eamil Address</label>
    <input type="text" class="form-control" id="email"  name="email" value="{{$user->email}}">
  </div>

  <div class="form-group">
    <label for="admin">User status</label>
    <input type="text" class="form-control" id="admin"  name="admin" value="{{$user->admin}}">
  </div>
 
   <div class="form-group">
    <label for="payRate">Pay Rate</label>
    <input type="text" class="form-control" id="payRate"  name="payRate" value="{{$user->payRate}}">
  </div>
    <div class="form-group">
    <label for="numOfHolidays">Num of Holidays</label>
    <input type="number" class="form-control" id="numOfHolidays"  name="numOfHolidays" value="{{$user->numOfHolidays}}">
  </div>


   <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection