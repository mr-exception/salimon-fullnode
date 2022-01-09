@extends('layout')
@section('title', 'Login')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                Login
            </div>
            <form action="{{route('login.submit')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row gy-4">
                        @if($errors->has('message'))
                            <div class="col-12">
                                <div class="alert alert-danger">{{$errors->first('message')}}</div>
                            </div>
                        @endif
                        <div class="col-12">
                            <label class="form-label">Username</label>
                            <input class="form-control" name="username" value="{{old("username")}}" type="text" placeholder="admin">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" value="{{old("password")}}" type="password" placeholder="admin">
                        </div>
                        <div class="col-12 mt-2 text-end">
                            <button type="submit" class="btn-primary btn">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
