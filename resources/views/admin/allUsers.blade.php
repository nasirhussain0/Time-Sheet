@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Image</th>
            <th>Name</th>
            <th>email</th>
            <th>registerDate</th>
            <th>payRate</th>
            <th>User status </th>
            <th>numOfHolidays </th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{$user['id']}}</td>
            <td><img src="{{asset('profilePics/'.$user->profilePic)}}" alt="" width="130" height="130" style="max-height:220px" ></td>
            <td>{{$user['fullname']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['registerDate']}}</td>
            <td>{{$user['payRate']}}</td>
            <td>{{$user['active']}}</td>
            <td>{{$user['numOfHolidays']}}</td>
            <td><a href="{{url('getUser/'.$user->id)}}" class="btn btn-primary">Edit</a></td>   
            <td><a href="  {{url('accountFreeze/'.$user->id)}}"  class="btn btn-danger">Block Account</a></td>   
            <td><a href="  {{url('unfreeze/'.$user->id)}}"  class="btn btn-primary">Unblock Account</a></td>               
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection