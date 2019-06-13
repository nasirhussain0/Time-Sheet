@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>startTime</th>
            <th>endTime</th>
            <th>date</th>
            <th>Job name</th>
            <th>Cost</th>
            <th>Session status</th>
            <th>expenses_status</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
        <tr>
            <td>{{$user->startTime}}</td>
            <td>{{$user->endTime}}</td>
            <td>{{$user->date}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->amount}}</td>
            <td>{{$user->session_status}}</td>
            <td>{{$user->expenses_status}}</td>      
            <td><a href="{{url('getSession/'.$user->session_id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="  {{url('deleteJob/'.$user->session_id)}}"  class="btn btn-warning">Remove</a></td>                 
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection