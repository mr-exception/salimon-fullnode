@extends('layout')
@section('title', 'Packets')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Packets</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Src</th>
                                <th>Dst</th>
                                <th>Msg ID</th>
                                <th>Packet count</th>
                                <th>Position</th>
                                <th>Created at</th>
                                <th></th>
                            </tr>
                            @foreach($packets as $i => $packet)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td><a href="{{route("balance", $packet->src)}}">{{$packet->src}}</a></td>
                                    <td><a href="{{route("balance", $packet->dst)}}">{{$packet->dst}}</a></td>
                                    <td>{{$packet->msg_id}}</td>
                                    <td>{{$packet->msg_count}}</td>
                                    <td>{{$packet->position}}</td>
                                    <td>{{$packet->created_at}}</td>
                                    <td><a href="{{route("packets.details", $packet)}}">more</a></td>
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
