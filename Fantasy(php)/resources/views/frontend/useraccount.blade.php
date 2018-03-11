@extends('frontend.layouts.header')
<style>
    @media (min-width: 768px){
        .container {
            padding-top: 100px;
        }
    }
    .form-control, .control-label{
        background: transparent!important;
        color: white!important;
        border-radius: 0!important;
    }
    .form-horizontal {
        border: 2px solid white;
        border-radius: 7px;
        padding:10px;
        background: rgba(0,0,0,0.3);
    }
    .label-wallet-id {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
@section('content')
    <div class="container">
        <form class="form-horizontal" action="{{ route('change.username') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-10">
                    <label class="form-control" >{{ $user['email'] }}</label>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">User Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user['username'] }}" placeholder="Enter password">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success">Change User Name</button>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pwd">Wallet Address:</label>
                <div class="col-xs-12 col-sm-8">
                    <label class="form-control label-wallet-id" >{{ $user['wallet_id'] }}</label>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <label class="form-control text-right" id="label_balance"></label>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('./js/frontend/myaccount.js') }}" ></script>
@endsection