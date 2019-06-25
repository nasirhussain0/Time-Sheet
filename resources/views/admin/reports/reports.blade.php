@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <td><a href="" class="btn btn-primary">Download PDF</a></td>
            <td><a href="" class="btn btn-primary">Download CSV</a></td>
        </tr>
        </thead>
    </table>   
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <caption>Total Number of sessions for today</caption>
        <thead>
        <tr>
            <th>Num of sessions for today</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$getTodayNumOfSessions}}</td>                        
        </tr>

        </tbody>
    </table>   
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <caption>Total Number of each user sessions for today</caption>
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Number of sessions for today</th>
        </tr>
        </thead>
        <tbody>
        @foreach($eachUsersSessionForToday as $eachUserSessionForToday)
        <tr>
            <td>{{$eachUserSessionForToday->fullname}}</td>
            <td>{{$eachUserSessionForToday->countNum}}</td>            
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>



<div class="table-responsive">
    <table class="table table-striped">
        <caption>Users Not In today sessions</caption>
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach($allUsersNotInTodaySession as $allUserNotInTodaySession)
        <tr>
            <td>{{$allUserNotInTodaySession->fullname}}</td>
            <td>{{$allUserNotInTodaySession->email}}</td>                        
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <caption>Users last 7 days sessions</caption>
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Number of sessions for last 7 days</th>
        </tr>
        </thead>
        <tbody>
        @foreach($eachUsersSessionForWeek as $eachUserSessionForWeek)
        <tr>
            <td>{{$eachUserSessionForWeek->fullname}}</td>
            <td>{{$eachUserSessionForWeek->countNum}}</td>            
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <caption>Users last for last month sessions</caption>

        <thead>
        <tr>
            <th>Fullname</th>
            <th>Number of sessions for last month</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currentMonthSessionsOfUsers as $currentMonthSessionsOfUser)
        <tr>
            <td>{{$currentMonthSessionsOfUser->fullname}}</td>
            <td>{{$currentMonthSessionsOfUser->countNum}}</td>            
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <caption>Users Full year</caption>
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Number of sessions for last month</th>
        </tr>
        </thead>
        <tbody>
        @foreach($currentYearSessionsOfUsers as $currentYearSessionsOfUser)
        <tr>
            <td>{{$currentYearSessionsOfUser->fullname}}</td>
            <td>{{$currentYearSessionsOfUser->totalSessionNum}}</td>            
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>


<div class="table-responsive">
    <table class="table table-striped">
        <caption>All sessions for users</caption>
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Total number of each user sessions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($eachUserSessions as $eachUserSession)
        <tr>
            <td>{{$eachUserSession->fullname}}</td>
            <td>{{$eachUserSession->email}}</td>            
            <td>{{$eachUserSession->sessions_count}}</td>            
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection