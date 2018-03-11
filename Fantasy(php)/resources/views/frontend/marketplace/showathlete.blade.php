@extends('frontend.layouts.header')

@section('content')
<link href="{{ asset('css/frontend/marketplace.css') }}" rel="stylesheet">
<h3 class="text-center label-title" style="font-size: 24px;margin-bottom:20px;"> Athlete </h3>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <div class="row celebrity-card">
            <div class="col-md-12 padding0">
                <img id="profile_picture" class="img-avatar" src="{{ $athlete['avatar'] }}"/>
                <label class="player-name">{{ $athlete['player_name'] }}</label>
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
            <div class="col-md-12 text-center padding0">
                <a href="/showbuycontract/{{ $athlete['_id'] }}" class="btn btn-primary btn-buy" >BUY THIS ATHLETE</a>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading"> Athlete Details </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-3 text-right">Current Owner:</div>
                    <div class="col-xs-6 col-sm-3">{{ $athlete['player_name'] }}</div>
                    <div class="col-xs-6 col-sm-3 text-right">Verification status:</div>
                    <div class="col-xs-6 col-sm-3">Not verified yet</div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-3 text-right">Ranking:</div>
                    <div class="col-xs-6 col-sm-3">{{ $athlete['ranking'] }}</div>
                    <div class="col-xs-6 col-sm-3 text-right">Changes:</div>
                    <div class="col-xs-6 col-sm-3">{{ $athlete['changes'] }}%</div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-3 text-right">Current Price:</div>
                    <div class="col-xs-6 col-sm-3">{{ $athlete['price'] }}</div>
                </div>
                <div class="row">
                    <h3 style="padding-left:20px;">Athlete informations</h3>
                    <div class="col-md-12">
                        <?php echo html_entity_decode($athlete['mass']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading"> Latest Transactions </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Owner</th>
                                <th>Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if ($owner_history)
                            @foreach( $owner_history as $idx=>$history )
                                <tr>
                                    <td>{{ $idx+1 }}</td>
                                    <td>
                                        <a href="/userathlete/{{ $history['owner_id'] }}">{{ $history['owner_name'] }}</a>
                                    </td>
                                    <td>{{ $history['price'] }}</td>
                                    <td>{{ $history['date'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
<style>
    img {
        width: 100%!important;
    }
</style>