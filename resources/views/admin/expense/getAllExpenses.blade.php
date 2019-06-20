@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Cost</th>
            <th>Image</th>
            <th>Payment Type</th>
            <th>Expenses Approved</th>
            <th colspan="3">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($allExpenses as $usersExpenses)
        <tr>
            <td>{{$usersExpenses->amount}}</td>
            <td><img src="{{asset('evidencePics/'.$usersExpenses->evidencePic)}}" ></td>
            <td>{{$usersExpenses->paymentType}}</td>
            <td>{{$usersExpenses->approved}}</td>      
        
            <td><a href="{{url('approveExpense/'.$usersExpenses->expenses_id)}}" class="btn btn-primary">Approve</a></td>                      
            <td><a href="{{url('declineExpense/'.$usersExpenses->expenses_id)}}" class="btn btn-primary">decline</a></td>
          
                                  
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection

