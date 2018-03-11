@extends('frontend.layouts.header')
<style>
    @media (min-width: 768px){
        .container {
            padding-top: 50px;
        }
    }
    .form-control, .control-label{
        background: transparent!important;
        color: white!important;
        border-radius: 0!important;
    }
</style>
@section('content')
    <link href="{{ asset('css/frontend/marketplace.css') }}" rel="stylesheet">
    <div class="col-xs-12 col-sm-5">
        <div class="row celebrity-card">
            <div class="col-md-12 padding0">
                <img id="profile_picture" class="img-avatar" src="{{ $athlete['avatar'] }}"/>
                <label class="player-name">{{ $athlete['player_name'] }}</label>
                <div class="verification-status verified">
                    <i class="fa fa-check-square-o"></i>
                </div>
                <label class="team-name">{{ $athlete['team_name'] }}</label>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <label class="label-title">Price:</label>
                        <a class="a-label">{{ $athlete['price'] }}</a>
                    </div>
                    <div class="col-xs-6 col-md-6 text-right">
                        <label class="label-title">Txs:</label>
                        <a class="a-label">{{ $athlete['price'] }}</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-9 col-md-9" style="display:flex;">
                        <label class="label-title">Owner:</label>
                        <a class="a-label span-wrap">{{ $athlete['owner_name'] }}</a>
                    </div>
                    <div class="col-xs-3 col-md-3 text-right">
                        <a class="" target="_blank" href="https://etherscan.io/address/{{ $athlete['origin_wallet_id'] }}">
                            <i class="fa fa-external-link"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6" style="display:flex;">
                        <label class="label-title">Ranking:</label>
                        <a class="a-label span-wrap">
                            {{ $athlete['player_name'] }}
                        </a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <label class="label-title">Changed:</label>
                        <a class="a-label">{{ number_format($athlete['price'], 2,'.',',') }}%</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-7" style="color:white;">
                    <form role="form" class="form-inline crypto-form" method="post" action="/buycontract/{{ $athlete['_id'] }}">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group form-md-line-input margin0 white-color">
                                <strong>{{ $athlete['player_name'] }} contract</strong>
                                <p>The current buying price for this contract is <strong>{{ $athlete['price'] }} ETH</strong>.</p>
                                If someone decides to snatch the contract away from you, you will be paid {{ $athlete['estimate_price'] }} ETH
                                Transactions on the Blockchain take time to process.
                                By the time you buy this contract, it's price may already be higher than is shown on the card and your transaction will fail.
                                You may submit a higher amount increase the chances of a successful transaction.
                                If you bid higher than the contract's current price, the difference will be refunded automatically.
                            </div>
                            <div class="form-group">
                                <label for="price">Custom price:</label>
                                <input type="text" class="form-control" name="price" id="price" value="{{ $athlete['price'] }}" />
                            </div>
                            <div class="form-group">
                                <button id="btn_celebrity_store" class="btn btn-success">Buy</button>
                            </div>
                            <label>* If someone else outbid you during this time, your ETH will be refunded.</label>
                        </div>
                    </form>

                </div>

@endsection