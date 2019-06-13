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
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($authUserSessions as $userSessions)
        <tr>
            <td>{{$userSessions->startTime}}</td>
            <td>{{$userSessions->endTime}}</td>
            <td>{{$userSessions->date}}</td>
            <td>{{$userSessions->name}}</td>
            <td>{{$userSessions->amount}}</td>
            <td>{{$userSessions->session_approved}}</td>
            <td>{{$userSessions->expenses_approved}}</td>      
            <td><a href="{{url('getSession/'.$userSessions->session_id)}}" class="btn btn-primary">Edit</a></td>                      
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection