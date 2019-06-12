@extends('layouts.app')

@section('content')


  @if(session('updatedDatabase'))
  <div class="alert alert-danger"> {{session('updatedDatabase')}} </div>
  @endif

<h2>Update name and picture</h2>

<form action="updateProfile/{{$user->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
  <div class="form-group">
    <label for="fullname">Email address</label>
    <input type="fullname" class="form-control" id="fullname"  name="fullname" value="{{$user->fullname}}">
  </div>
 <div class="form-group">
 	<label for="profilePic">Current image</label>  
 	<br> 
    	<img src="{{asset('profilePics/'.$user->profilePic)}}" >
    	<br>
    <label for="profilePic">Image</label>    
    <input type="file" class="form-control-file" id="profilePicN"  name="profilePicN">
  </div>
   <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h3>Update Eamil password</h3>
<form action="updatePassword/{{$user->id}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        <div class="col-md-6">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div> 
  <button type="submit" class="btn btn-primary">submit</button>
</form>


<h3>Remove user</h3>
<form action="removeUser/{{$user->id}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <button type="submit" class="btn btn-danger">Remove</button>
</form>
@endsection