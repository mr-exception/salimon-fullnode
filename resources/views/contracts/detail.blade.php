@extends('layout')
@section('title', 'Contract')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Contract {{$contract->id}}</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        Contractor: <a href="{{route("balance", $contract->address)}}">{{$contract->address}}</a>
                    </div>
                    <div class="col-md-12">
                        Fee: {{$contract->fee}} gwei
                    </div>
                    <div class="col-md-12">
                        Count: {{$contract->count}}
                    </div>
                    <div class="col-md-12">
                        Comission: {{$contract->commission}} gwei
                    </div>
                    <div class="col-md-12">
                        Total price: {{$contract->total_price}} gwei
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-header">
                <h3>Reports</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Address</th>
                                <th>Captured at</th>
                            </tr>
                            @foreach($reports as $i => $report)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><a href="{{route("balance", $report->address)}}">{{$report->address}}</a></td>
                                    <td>{{$report->created_at}}</td>
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
