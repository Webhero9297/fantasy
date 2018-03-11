@extends('frontend.layouts.header')

@section('content')

    <link href="{{ asset('css/frontend/marketplace.css') }}" rel="stylesheet">
    <script>
        var obj = <?php echo json_encode($celebrities); ?>;
        console.log(obj);
    </script>
    <style>
        .a-label{
            font-size: 13px;
        }
    </style>

    <h3 class="text-center white-text">
        @if ( $user_info['user_role'] != 1 )
            {{ $user_info['username'] }}:
            <a href="https://etherscan.io/address/{{ $user_info['wallet_id'] }}" target="_blank">{{ $user_info['wallet_id'] }}</a>
        @endif
    </h3>
    @if ( $celebrities )
        <h4 class="text-center white-text">Contracts: {{ count($celebrities) }}</h4>
        <div class="row">
            @foreach( $celebrities as $idx=>$celebrity )
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <a href="/athlete/{{ $celebrity['_id'] }}" >
                        <div class="row celebrity-card">
                            <div class="col-md-12 padding0">
                                <img id="profile_picture" class="img-avatar" src="{{ $celebrity['avatar'] }}"/>
                                <label class="player-name">{{ $celebrity['player_name'] }}</label>
                                <div class="verification-status verified">
                                    <i class="fa fa-check-square-o"></i>
                                </div>
                                <label class="team-name">{{ $celebrity['team_name'] }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-xs-6 col-md-6">
                                        <label class="label-title">Price:</label>
                                        <a class="a-label">{{ $celebrity['price'] }}</a>
                                    </div>
                                    <div class="col-xs-6 col-md-6 text-right">
                                        <label class="label-title">Txs:</label>
                                        <a class="a-label">{{ $celebrity['price'] }}</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-9 col-md-9" style="display:flex;">
                                        <label class="label-title">Owner:</label>
                                        <a class="a-label span-wrap">{{ $celebrity['owner_name'] }}</a>
                                    </div>
                                    <div class="col-xs-3 col-md-3 text-right">
                                        <a class="" target="_blank" href="https://etherscan.io/address/{{ $celebrity['origin_wallet_id'] }}">
                                            <i class="fa fa-external-link"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6" style="display:flex;">
                                        <label class="label-title">Ranking:</label>
                                        <a class="a-label span-wrap">
                                            {{ $celebrity['player_name'] }}
                                        </a>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <label class="label-title">Changed:</label>
                                        <a class="a-label">{{ number_format($celebrity['price'], 2,'.',',') }}%</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center padding0">
                                <a href="/showbuycontract/{{ $celebrity['_id'] }}" class="btn btn-primary btn-buy" >BUY THIS ATHLETE</a>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
    <script src="{{ asset('./js/frontend/marketplace.js') }}" ></script>
@endsection
