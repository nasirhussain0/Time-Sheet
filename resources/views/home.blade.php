@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul>
                         <!-- <p>use signedInUserData from AppServerProvider to check if someone is logged in or not and then call the function from User Model isAdmin if it is true it will disply admin button</p> -->
                            @if($signedInUserData->isAdmin())

                                <li><a href="{{route('getAllUsers')}}" class="btn btn-info"> Users</a></li>
                                <li><a href="{{route('newJob')}}" class="btn btn-info"> Create New Job</a></li>
                                <li><a href="{{route('getAllJobs')}}" class="btn btn-info">Jobs</a></li>
                                <li><a href="{{route('getAllExpenses')}}" class="btn btn-info">Manage Expenses</a></li>
                                <li><a href="{{route('getAllSessions')}}" class="btn btn-info">Manage Sessions</a></li>
                                <li><a href="{{route('getUsersTimesheets')}}" class="btn btn-info">Manage Time-Sheet</a></li>


                                @else
                                @endif
                        <li><a href="{{ route('updateUser') }}" class="btn btn-info">update profile</a></li>
                        <li><a href="{{ route('newSession') }}" class="btn btn-info">Create New Session</a></li>
                        <li><a href="{{ route('getSessions') }}" class="btn btn-info">My Sessions</a></li>
                        <li><a href="{{ route('newExpense') }}" class="btn btn-info">Create New Expense</a></li>
                        <li><a href="{{ route('getExpenses') }}" class="btn btn-info">My Expenses</a></li>                          
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
