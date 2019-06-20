@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <td><a href="{{url('generatepdf')}}" class="btn btn-primary">Download PDF</a></td>
        </tr>
        </thead>
    </table>   
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Fullname</th>
            <th>Pay rate</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Date</th>
            <th>Num of Holidays</th>
        </tr>
        </thead>
        <tbody>
        @foreach($getTimeSheets as $userTimeSheet)
        <tr>
            <td>{{$userTimeSheet->fullname}}</td>
            <td>{{$userTimeSheet->payRate}}</td>
            <td>{{$userTimeSheet->startTime}}</td>
            <td>{{$userTimeSheet->endTime}}</td>
            <td>{{$userTimeSheet->date}}</td>
            <td>{{$userTimeSheet->numOfHolidays}}</td>                         
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection