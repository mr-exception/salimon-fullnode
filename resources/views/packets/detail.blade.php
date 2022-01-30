@extends('layout')
@section('title', 'Packet')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Packet {{$packet->id}}</h3>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    <div class="col-md-12">
                        src: <a href="{{route("balance", $packet->src)}}">{{$packet->src}}</a>
                    </div>
                    <div class="col-md-12">
                        dst: <a href="{{route("balance", $packet->dst)}}">{{$packet->dst}}</a>
                    </div>
                    <div class="col-md-12">
                        packets count: {{$packet->msg_count}}
                    </div>
                    <div class="col-md-12">
                        packets position: {{$packet->position}}
                    </div>
                    <div class="col-md-12">
                        sent at: {{$packet->created_at}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
