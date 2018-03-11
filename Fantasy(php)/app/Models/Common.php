<?php

namespace App\Models;


use App\Models\Base\SportsPlayer;
use App\Models\Base\SportsTeam;
use App\Models\Base\SportsType;
use App\User;

class Common
{
    //
    public static function getCelebrityDetailInfo( $player_id = null ) {
        $typeModel = new SportsType();
        $teamModel = new SportsTeam();
        $playerModel = new SportsPlayer();
        $celebrityModel = new Celebrity();
        if ( is_null($player_id) ) {
            $data = $celebrityModel->all();
            if ( $data ) {
                $ret = array();
                foreach( $data as $d ) {
                    $celebrity_data = $celebrityModel->where('player_id', $d['player_id'])->first()->toArray();
                    $player_data = $playerModel->where('_id', $d['player_id'])->first();
                    $team_data = $teamModel->where('_id', $player_data['team_id'])->first();
                    $type_data = $typeModel->where('_id', $team_data['sports_type_id'])->first();

                    $ret_data = $celebrity_data;
                    $ret_data['player_name'] = $player_data['player_name'];
                    $ret_data['team_id'] = $player_data['team_id'];
                    $ret_data['team_name'] = $team_data['team_name'];
                    $ret_data['type_id'] = $team_data['sports_type_id'];
                    $ret_data['type_name'] = $type_data['type_name'];
                    $ret_data['avatar'] = '/upload/celebrities/avatar/'.$celebrity_data['avatar_image_name'];
                    $ret_data['price'] = $celebrity_data['price'];
                    $ret_data['purchase_price'] = $celebrity_data['purchase_price'];
                    $ret_data['origin_wallet_id'] = $celebrity_data['origin_wallet_id'];
                    $ret_data['send_fee'] = $celebrity_data['send_fee'];
                    $ret_data['owner_id'] = $celebrity_data['owner_id'];

                    $userInfo = self::getUserInfoFromId($celebrity_data['owner_id']);
                    $ret_data['owner_name'] = $userInfo['username'];
                    isset($ret_data['site_fee']) ? $ret_data['site_fee'] = $celebrity_data['site_fee'] : 0;
                    isset($ret_data['mass']) ? $ret_data['mass'] = $celebrity_data['mass'] : '';
                    $ret[] = $ret_data;
                }
                return $ret;
            }
        }
        else{
            $celebrity_data = $celebrityModel->where('player_id', $player_id)->first();
            $player_data = $playerModel->where('_id', $player_id)->first();
            $team_data = $teamModel->where('_id', $player_data['team_id'])->first();
            $type_data = $typeModel->where('_id', $team_data['sports_type_id'])->first();

            $ret_data = $celebrity_data;
            $ret_data['player_name'] = $player_data['player_name'];
            $ret_data['team_id'] = $player_data['team_id'];
            $ret_data['team_name'] = $team_data['team_name'];
            $ret_data['type_id'] = $team_data['sports_type_id'];
            $ret_data['type_name'] = $type_data['type_name'];
            $ret_data['avatar'] = '../upload/celebrities/avatar/'.$celebrity_data['avatar_image_name'];
            $ret_data['price'] = $celebrity_data['price'];
            $ret_data['purchase_price'] = $celebrity_data['purchase_price'];
            $ret_data['origin_wallet_id'] = $celebrity_data['origin_wallet_id'];
            $ret_data['send_fee'] = $celebrity_data['send_fee'];
            $ret_data['owner_id'] = $celebrity_data['owner_id'];

            $userInfo = self::getUserInfoFromId($celebrity_data['owner_id']);
            $ret_data['owner_name'] = $userInfo['username'];
            isset($ret_data['site_fee']) ? $ret_data['site_fee'] = $celebrity_data['site_fee'] : 0;
            isset($ret_data['mass']) ? $ret_data['mass'] = $celebrity_data['mass'] : '';
            return $ret_data;
        }
    }

    public static function getAthleteFromTeam( $team_id ) {
        $typeModel = new SportsType();
        $teamModel = new SportsTeam();
        $playerModel = new SportsPlayer();
        $team_data = $teamModel->where('_id', $team_id)->first();
        $type_data = $typeModel->where('_id', $team_data['sports_type_id'])->first();
        $player_data = $playerModel->where('team_id', $team_id)->get();
        $ret_datas = [];
        if ( $player_data ) {
            $player_data = $player_data->toArray();
            $player_ids = [];
            foreach( $player_data as $player ) $player_ids[] = $player['_id'];
            $athletes = Celebrity::whereIn('player_id', $player_ids)->get();
            if ( $athletes ) {
                $athletes = $athletes->toArray();
                foreach( $athletes as $celebrity_data ) {
                    $player_data = $playerModel->where('_id', $celebrity_data['player_id'])->first();
                    $ret_data = $celebrity_data;
                    $ret_data['player_name'] = $player_data['player_name'];
                    $ret_data['team_id'] = $player_data['team_id'];
                    $ret_data['team_name'] = $team_data['team_name'];
                    $ret_data['type_id'] = $team_data['sports_type_id'];
                    $ret_data['type_name'] = $type_data['type_name'];
                    $ret_data['avatar'] = '../upload/celebrities/avatar/'.$celebrity_data['avatar_image_name'];
                    $ret_data['price'] = $celebrity_data['price'];
                    $ret_data['purchase_price'] = $celebrity_data['purchase_price'];
                    $ret_data['origin_wallet_id'] = $celebrity_data['origin_wallet_id'];
                    $ret_data['send_fee'] = $celebrity_data['send_fee'];
                    $ret_data['owner_id'] = $celebrity_data['owner_id'];
                    (isset($celebrity_data['token_id'])) ? $ret_data['token_id'] = $celebrity_data['token_id'] : $ret_data['token_id'] = 'NotAllowed';

                    $userInfo = self::getUserInfoFromId($celebrity_data['owner_id']);
                    $ret_data['owner_name'] = $userInfo['username'];
                    isset($ret_data['site_fee']) ? $ret_data['site_fee'] = $celebrity_data['site_fee'] : 0;
                    isset($ret_data['mass']) ? $ret_data['mass'] = $celebrity_data['mass'] : '';
                    $ret_datas[] = $ret_data;
                }
            }
        }
        return $ret_datas;
    }

    public static function getAthleteInfo( $athlete_id ) {
        $typeModel = new SportsType();
        $teamModel = new SportsTeam();
        $playerModel = new SportsPlayer();
        $athlete = Celebrity::where('_id', $athlete_id)->first()->toArray();

        $player_data = $playerModel->where('_id', $athlete['player_id'])->first()->toArray();
        $team_data = $teamModel->where('_id', $player_data['team_id'])->first()->toArray();
        $type_data = $typeModel->where('_id', $team_data['sports_type_id'])->first()->toArray();

        $ret_data = $athlete;
        $ret_data['player_name'] = $player_data['player_name'];
        $ret_data['team_id'] = $player_data['team_id'];
        $ret_data['team_name'] = $team_data['team_name'];
        $ret_data['type_id'] = $team_data['sports_type_id'];
        $ret_data['type_name'] = $type_data['type_name'];
        $ret_data['avatar'] = '../upload/celebrities/avatar/'.$athlete['avatar_image_name'];
        $ret_data['price'] = $athlete['price'];
        $ret_data['purchase_price'] = $athlete['purchase_price'];
        $ret_data['origin_wallet_id'] = $athlete['origin_wallet_id'];
        $ret_data['send_fee'] = $athlete['send_fee'];
        $ret_data['owner_id'] = $athlete['owner_id'];

        $userInfo = self::getUserInfoFromId($athlete['owner_id']);
        $ret_data['owner_name'] = $userInfo['username'];
        $ret_data['estimate_price'] = (1+$athlete['send_fee']/100+$athlete['site_fee']/100)*$athlete['price'];
        isset($ret_data['site_fee']) ? $ret_data['site_fee'] = $athlete['site_fee'] : 0;
        isset($ret_data['mass']) ? $ret_data['mass'] = $athlete['mass'] : '';

        return $ret_data;
    }
    public static function getMarketplaceTreeData() {
        $typedata = SportsType::all()->toArray();
        $teamModel = new SportsTeam();
        $playerModel = new SportsPlayer();
        $treeData = array();
        foreach( $typedata as $type ) {
            $tree_data = $type;
            $teamData = $teamModel->getTeamDataByType($type['_id']);
            $tree_data['team_data'] = $teamData;
            $treeData[] = $tree_data;
        }
        return $treeData;
    }
    public static function getUserInfoFromId( $user_id ) {
        $user_data = User::where('_id', $user_id)->first();
        if ( $user_data ) return $user_data->toArray();
        return [];
    }

    public static function getAthleteInfoOfOwner( $owner_id ) {
        $typeModel = new SportsType();
        $teamModel = new SportsTeam();
        $playerModel = new SportsPlayer();
        $celebrityModel = new Celebrity();
        $purchaseModel = new Purchase();

        $data = $celebrityModel->where('owner_id', $owner_id)->get();
        if ( $data ) {
            $data = $data->toArray();
            $ret = array();
            foreach( $data as $d ) {
                $celebrity_data = $celebrityModel->where('player_id', $d['player_id'])->first()->toArray();
                $player_data = $playerModel->where('_id', $d['player_id'])->first();
                $team_data = $teamModel->where('_id', $player_data['team_id'])->first();
                $type_data = $typeModel->where('_id', $team_data['sports_type_id'])->first();

                $purchase_data = $purchaseModel->where('owner_id', $owner_id)->where('athlete_id', $celebrity_data['_id'])->first();

                $ret_data = $celebrity_data;
                $ret_data['player_name'] = $player_data['player_name'];
                $ret_data['team_id'] = $player_data['team_id'];
                $ret_data['team_name'] = $team_data['team_name'];
                $ret_data['type_id'] = $team_data['sports_type_id'];
                $ret_data['type_name'] = $type_data['type_name'];
                $ret_data['avatar'] = '/upload/celebrities/avatar/'.$celebrity_data['avatar_image_name'];
                $ret_data['price'] = $celebrity_data['price'];
                $ret_data['purchase_price'] = $celebrity_data['purchase_price'];
                $ret_data['origin_wallet_id'] = $celebrity_data['origin_wallet_id'];
                $ret_data['send_fee'] = $celebrity_data['send_fee'];
                $ret_data['owner_id'] = $celebrity_data['owner_id'];

                $userInfo = self::getUserInfoFromId($celebrity_data['owner_id']);
                $ret_data['owner_name'] = $userInfo['username'];
                isset($ret_data['site_fee']) ? $ret_data['site_fee'] = $celebrity_data['site_fee'] : 0;
                isset($ret_data['mass']) ? $ret_data['mass'] = $celebrity_data['mass'] : '';
                $ret[] = $ret_data;
            }
            return $ret;
        }
    }

    public static function getTransactionData( $buyer_id=null ) {
        $athleteModel = new TransactionHistory();
        $athlete_data = array();
        if ( is_null($buyer_id) ){
            $athlete_data = $athleteModel->orderBy('created_at', 'desc')->get();
        }
        else{
            $athlete_data = $athleteModel->where('buyer', $buyer_id)->orWhere('seller', $buyer_id)->orderBy('created_at', 'desc')->get();
        }
        if ( $athlete_data ) $athlete_data = $athlete_data->toArray();
        else return [];
        $ret_data = array();
        foreach( $athlete_data as $athlete ) {
            $tmp = $athlete;

            $sellerInfo = self::getUserInfoFromId( $athlete['seller'] );
            $buyerInfo = self::getUserInfoFromId( $athlete['buyer'] );
            $tmp['seller_name'] = $sellerInfo['username'];
            $tmp['buyer_name'] = $buyerInfo['username'];
            $tmp['athlete_info'] = self::getAthleteInfo($athlete['athlete_id']);
            if ( $athlete['buyer']==$buyer_id ) {
                $tmp['side'] = 'buy';
                $tmp['profit'] = 0;
                $tmp['fee'] = 0;
                $tmp['get'] = 0;
            }
            else {
                $tmp['side'] = 'sell';
                $tmp['fee'] = $athlete['site_fee'] + $athlete['actual_fee'];
                $tmp['get'] = $athlete['price'] - $athlete['site_fee'] - $athlete['actual_fee'];
                $tmp['profit'] = ($athlete['price']-$athlete['site_fee']-$athlete['actual_fee'])-$athlete['purchase_price'];
            }

            $ret_data[] = $tmp;
        }
        return $ret_data;
    }

    public static function getOwnerHistoryOfAthlete( $athlete_id ) {
        $historyModel = new TransactionHistory();
        $ret = array();
        $athlete_data = $historyModel->where('athlete_id', $athlete_id)->orderBy('created_at', 'desc')->get();
        if ( $athlete_data ) {
            $athlete_data = $athlete_data->toArray();
            foreach( $athlete_data as $athlete ) {
                $ownerInfo = self::getUserInfoFromId($athlete['buyer']);
                if ( $ownerInfo['user_role']==1 ) continue;
                $ret[] = array('owner_name'=>$ownerInfo['username'], 'owner_id'=>$ownerInfo['_id'],
                               'price'=>$athlete['price'], 'date'=>$athlete['created_at']);
            }
            return $ret;
        }
        return [];
    }
    public static function getSiteData() {
        $totalTransactionData = self::getAllTransactions();

        return ['transaction_value'=>$totalTransactionData['total_transaction_value'],
                'active_contracts'=>self::getActiveContracts(),
                'contract_holders'=>self::getContractHolders()];
    }
    public static function getAllTransactions() {
        $historyModel = new TransactionHistory();
        $ret = array();
        $total_value = 0;
        $trade_data = $historyModel->all();
        if ( $trade_data ) {
            $trade_data = $trade_data->toArray();
            foreach( $trade_data as $trade ) {
                $ownerInfo = self::getUserInfoFromId($trade['seller']);
                if ( $ownerInfo['user_role']==1 ) continue;
                $ret[] = $trade;
                $total_value += $trade['price'];
            }
            return ['total_transaction_value'=>$total_value, 'total_transactions'=>$ret];
        }
        return ['total_transaction_value'=>0, 'total_transactions'=>[]];
    }
    public static function getActiveContracts() {
        $athleteModel = new Celebrity();
        return $athleteModel->where('is_published', 0)->get()->count();
    }
    public static function getContractHolders() {
        $athleteModel = new Celebrity();
        $data = $athleteModel->groupBy('owner_id')->get();
        $contract_holders = 0;
        if ( $data ) {
            $athlete_data = $data->toArray();
            foreach( $athlete_data as $athlete ) {
                $ownerInfo = self::getUserInfoFromId($athlete['owner_id']);
                if ( $ownerInfo['user_role']==1 ) continue;
                $contract_holders++;
            }
        }
        return $contract_holders;
    }
}
