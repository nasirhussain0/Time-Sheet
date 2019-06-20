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
            <th>Session approved</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($allSessions as $userSessions)
        <tr>
            <td>{{$userSessions->startTime}}</td>
            <td>{{$userSessions->endTime}}</td>
            <td>{{$userSessions->date}}</td>
            <td>{{$userSessions->name}}</td>
            <td>{{$userSessions->session_approved}}</td>
            <td></td>
            <td><a href="{{url('approveSession/'.$userSessions->sessions_id)}}" class="btn btn-primary">Approve</a></td>                      
            <td><a href="{{url('declineSession/'.$userSessions->sessions_id)}}" class="btn btn-primary">decline</a></td> 
                         
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection