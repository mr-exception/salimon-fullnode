@extends('layout')
@section('title', 'Configs')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <div class="card mt-2">
            <div class="card-header">
                <h3>Configurations</h3>
            </div>
            <form action="{{route('configs.update')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row gy-4">
                        <div class="col-12">
                            <h4>Ethereum</h4>
                        </div>
                        <div class="col-12">
                            <label class="form-label">ETH wallet address</label>
                            <input class="form-control" name="ETH_ADDRESS" value="{{old("ETH_ADDRESS", env("ETH_ADDRESS"))}}" type="text" placeholder="0xXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Subscription fee (gwies count for one hour subscription)</label>
                            <input class="form-control" name="SUBSCRIPTION_FEE" type="number" value="{{old("SUBSCRIPTION_FEE", env("SUBSCRIPTION_FEE"))}}" placeholder="3600">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Max block fetch on each update</label>
                            <input class="form-control" name="FETCH_PER_UPDATE" type="number" value="{{old("FETCH_PER_UPDATE", env("FETCH_PER_UPDATE"))}}" placeholder="15">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Last fetched block number</label>
                            <input class="form-control" name="LAST_BLOCK_NUMBER" type="number" value="{{old("LAST_BLOCK_NUMBER", env("LAST_BLOCK_NUMBER"))}}" placeholder="4837">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="LAST_BLOCK_NUMBER" class="form-label">Paid subscription</label>
                            <select class="form-select" name="LAST_BLOCK_NUMBER">
                                <option {{old("LAST_BLOCK_NUMBER", env("LAST_BLOCK_NUMBER"))? "selected": "        "}} value="true"> Active  </option>
                                <option {{old("LAST_BLOCK_NUMBER", env("LAST_BLOCK_NUMBER"))? "        ": "selected"}} value="false">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <h4>Database and Storage</h4>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label">Database host</label>
                            <input class="form-control" name="DB_HOST" type="text" value="{{old("DB_HOST", env("DB_HOST"))}}" placeholder="3600">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label">Database port</label>
                            <input class="form-control" name="DB_PORT" type="number" value="{{old("DB_PORT", env("DB_PORT"))}}" placeholder="3600">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <label class="form-label">Database name</label>
                            <input class="form-control" name="DB_DATABASE" type="text" value="{{old("DB_DATABASE", env("DB_DATABASE"))}}" placeholder="15">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Database username</label>
                            <input class="form-control" name="DB_USERNAME" type="text" value="{{old("DB_USERNAME", env("DB_USERNAME"))}}" placeholder="15">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">Database password</label>
                            <input class="form-control" name="DB_PASSWORD" type="text" value="{{old("DB_PASSWORD", env("DB_PASSWORD"))}}" placeholder="15">
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
