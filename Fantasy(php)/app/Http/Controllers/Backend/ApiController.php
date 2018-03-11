<?php

namespace App\Http\Controllers\Backend;

use App\Models\Celebrity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Common;

class ApiController extends Controller
{
    //
    public function viewAthlete($team_id) {
        header('Access-Control-Allow-Origin:*');
        return response()->json(Common::getAthleteFromTeam($team_id));
    }
    public function getMarketplaceMenu() {
        header('Access-Control-Allow-Origin:*');
        return response()->json(Common::getMarketplaceTreeData());
    }
    public function setAthleteToTokenId($athlete_id) {
        header('Access-Control-Allow-Origin:*');
        $token_id = request()->get('token_id');
        $athleteModel = new Celebrity();
        $athlete_data = $athleteModel->find($athlete_id);
        $athlete_data->token_id = $token_id;
        $athlete_data->save();
        
        return response()->json('ok');
    }
}
