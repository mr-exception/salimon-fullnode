@extends('layout')
@section('title', 'Change password')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                Change Password
            </div>
            <form action="{{route('auth.change_password.submit')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row gy-4">
                        @if(isset($success))
                        <div class="col-12">
                            <div class="alert alert-success">password updated!</div>
                        </div>
                        @endif
                        @foreach($errors->all() as $error)
                            <div class="col-12">
                                <div class="alert alert-danger">{{$error}}</div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input class="form-control" name="password" value="{{old("password")}}" type="password" placeholder="admin">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Password Confirmation</label>
                            <input class="form-control" name="password_confirmation" value="{{old("password_confirmation")}}" type="password" placeholder="admin">
                        </div>
                        <div class="col-12 mt-2 text-end">
                            <button type="submit" class="btn-primary btn">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
