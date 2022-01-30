@extends('layout')
@section('title', 'Contract')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Contract</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        Address: {{$address}}
                    </div>
                    <div class="col-md-12">
                        Balance: {{gweiToEth($balance)}} ETH <small>({{$balance}} gwei)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h3>Transactions</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Captured at</th>
                            </tr>
                            @foreach($transactions as $i => $transaction)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$transaction->amount_str}}</td>
                                    <td>{{$transaction->type_str}}</td>
                                    <td>{{$transaction->description}}</td>
                                    <td>{{$transaction->formatted_date}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                <tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
