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

        @foreach($authUserExpenses as $userExpenses)
        <tr>
            <td>{{$userExpenses->amount}}</td>
            <td><img src="{{asset('evidencePics/'.$userExpenses->evidencePic)}}" ></td>
            <td>{{$userExpenses->paymentType}}</td>
            <td>{{$userExpenses->approved}}</td>      
            @if($userExpenses->expenses_approved == 'No')
                <td><a href="{{url('getExpense/'.$userExpenses->expenses_id)}}" class="btn btn-primary">Edit</a></td>                      
                <td><a href="{{url('getExpensePicture/'.$userExpenses->expenses_id)}}" class="btn btn-primary">Edit Picture</a></td>
                <td><a href="{{url('deleteExpense/'.$userExpenses->expenses_id)}}" class="btn btn-primary">Romove</a></td>
            @else
            @endif
                                  
        </tr>
        @endforeach
        </tbody>
    </table>   
</div>

@endsection

