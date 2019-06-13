@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#id</th>
            <th>Name</th>
            <th>Location</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($jobs as $job)
        <tr>
            <td>{{$job['id']}}</td>
            <td>{{$job['name']}}</td>
            <td>{{$job['location']}}</td>
            <td>{{$job['created_at']}}</td>
            <td>{{$job['updated_at']}}</td>
            <td><a href="{{url('getJob/'.$job->id)}}" class="btn btn-primary">Edit</a></td>
            <td><a href="  {{url('deleteJob/'.$job->id)}}"  class="btn btn-warning">Remove</a></td>                 
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection