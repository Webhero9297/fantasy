<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Base\SportsPlayer;
use App\Models\Base\SportsType;
use App\Models\Base\SportsTeam;
class MarketplaceController extends Controller
{
    //
    public function index() {


        $treeData = Common::getMarketplaceTreeData();

        $celebrities = Common::getCelebrityDetailInfo();
        return view('frontend.marketplace')->with(['celebrities'=>$celebrities, 'tree_data'=>$treeData]);
    }
    public function viewAthlete($team_id) {
        header('Access-Control-Allow-Origin:*');
        $ret = Common::getAthleteFromTeam($team_id);
        return view('frontend.marketplace')->with(['celebrities'=>$ret]);
    }
    public function getMarketplaceMenu() {
        header('Access-Control-Allow-Origin:*');
        return response()->json(Common::getMarketplaceTreeData());
    }
    public function showDetailsForAthlete($athlete_id) {
        $athlete = Common::getAthleteInfo($athlete_id);
        $owner_history = Common::getOwnerHistoryOfAthlete($athlete_id);
        return view('frontend.marketplace.showathlete')->with(['athlete'=>$athlete, 'owner_history'=>$owner_history]);
    }

    public function showAthleteInfoByUser($user_id) {
        $userInfo = Common::getUserInfoFromId($user_id);
        $athlete = Common::getAthleteInfoOfOwner($user_id);
        return view('frontend.marketplace.showathleteofowner')->with(['celebrities'=>$athlete, 'user_info'=>$userInfo]);
    }
}
