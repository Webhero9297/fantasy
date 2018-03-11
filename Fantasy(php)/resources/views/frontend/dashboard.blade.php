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
    .nav>li>a.tab-menu {
        font-weight: bold!important;
        padding: 5px 15px!important;
    }
    li.active>a {
        color: #22fb0a!important;
        background-color: rgba(255,255,255,0.3)!important;

    }
    .carousel-control {
        font-size: 50px!important;
    }
    .athlete-list-wrap {
        height: 400px;
        overflow-x: auto;
        overflow-y: hidden;
        margin-bottom: 20px;
    }
    .athlete-list {
        height: 100%;
        width: max-content;
    }
    .athlete {
        display: inline-block;
    }
    .athlete-active {
        border-color: gold !important;
    }
    .buy {
        color: red;
    }
    .sell {
        color: #38D865;
    }
    .thdr {

    }

</style>
@section('content')
    <link href="{{ asset('css/frontend/marketplace.css') }}" rel="stylesheet">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#athlete_list" class="tab-menu" data-toggle="tab"> Athlete List </a>
                        </li>
                        <li>
                            <a href="#transaction" class="tab-menu" data-toggle="tab"> Transaction </a>
                        </li>
                    </ul>
                    <div class="tab-content" style="padding:20px;">
                        <div class="tab-pane fade active in" id="athlete_list">
                            <div class="col-xs-12">
                                @if ( $athletes )
                                    <div class="row athlete-list-wrap">
                                        <div class="athlete-list">
                                            @foreach( $athletes as $idx=>$athlete )
                                                <a athlete_id="{{ $athlete['_id'] }}" price="{{ $athlete['price'] }}" purchase_price="{{ $athlete['purchase_price'] }}" onclick="doOnClickAthlete(this)" >
                                                    <div class="row celebrity-card athlete">
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
                                                                    {{ $athlete['ranking'] }}
                                                                </a>
                                                            </div>
                                                            <div class="col-xs-6 text-right">
                                                                <label class="label-title">Changed:</label>
                                                                <a class="a-label">{{ number_format($athlete['price'], 2,'.',',') }}%</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <h3>
                            <div class="col-xs-12">
                                <form action="changeathleteprice" method="post" class="form-horizontal form-bordered crypto-form">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <input type="hidden" name="athlete_id" >
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-md-3">Sell price</label>
                                            <div class="col-xs-12 col-md-4">
                                                <input type='range' id="slider_price" step="0.00001" min="0" max="1" value="0" style="margin-bottom: 25px;" oninput="showVal(this.value)" onchange="showVal(this.value)"/>
                                                <input id="input_price" type="text" value="0" name="price" class="form-control" readonly>
                                                <label>
                                                    <span class="label-title italic" >You can change the selling price between min</span>
                                                    <span class="label-title italic" id="min_price"></span>
                                                    <span class="label-title italic">to max</span>
                                                    <span class="label-title italic" id="max_price"></span>
                                                    <span class="label-title italic">only.</span>
                                                </label>
                                            </div>
                                            <div class="col-xs-12 col-md-5">
                                                <button type="submit" class="btn btn-primary" >Change Sell Price</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="transaction">
                            <table width="100%" class="crypto-form padding0">
                                <thead>
                                    <tr>
                                        <td align="center">#</td>
                                        <td align="center">Side</td>
                                        <td align="center">Athlete</td>
                                        <td align="center">From</td>
                                        <td align="center">To</td>
                                        <td align="center">Price</td>
                                        <td align="center">Get</td>
                                        <td align="center">Profit</td>
                                        <td align="center">Date</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $no = 0; ?>
                                @if ( $transaction_data )
                                    @foreach( $transaction_data as $transaction )
                                        <tr class="{{ $transaction['side'] }}">
                                            <td align="center">{{ ++$no }}</td>
                                            <td align="center">{{ $transaction['side'] }}</td>
                                            <td align="center">{{ $transaction['athlete_info']['player_name'] .' '. $transaction['athlete_info']['team_name']." ".$transaction['athlete_info']['type_name'] }}</td>
                                            <td align="center">{{ $transaction['seller_name'] }}</td>
                                            <td align="center">{{ $transaction['buyer_name'] }}</td>
                                            <td align="center">{{ $transaction['price'] }}</td>
                                            <td align="center">{{ ($transaction['get']==0)?"-":$transaction['get'] }}</td>
                                            <td align="center">{{ ($transaction['profit']==0)?"-":$transaction['profit'] }}</td>
                                            <td align="center">{{ $transaction['created_at'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="clearfix margin-bottom-20"> </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('./js/frontend/dashboard.js') }}"></script>
@endsection