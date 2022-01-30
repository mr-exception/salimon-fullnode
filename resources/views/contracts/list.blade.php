@extends('layout')
@section('title', 'Contracts')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Contracts</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Contractor</th>
                                <th>Fee</th>
                                <th>Count</th>
                                <th>Commission</th>
                                <th>Total price</th>
                                <th>Captured at</th>
                            </tr>
                            @foreach($contracts as $i => $contract)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><a href="{{route("balance", $contract->address)}}">{{$contract->address}}</a></td>
                                    <td>{{$contract->fee}} gwei</td>
                                    <td>{{$contract->count}}</td>
                                    <td>{{$contract->commission}} gwei</td>
                                    <td>{{$contract->total_price}} gwei</td>
                                    <td>{{$contract->created_at}}</td>
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
