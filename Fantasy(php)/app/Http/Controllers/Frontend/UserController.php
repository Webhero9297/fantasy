<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Celebrity;
use App\Models\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use PHPUnit\Runner\Exception;

class UserController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }
    public function index() {
        $user = \Auth::user();
        return view('frontend.useraccount')->with('user', $user);
    }
    public function changeUsername() {
        $user = \Auth::user();
        User::where('_id', $user->id)->update(['username'=> request()->get('username')]);
        return redirect()->route('account');
    }

    public function getUserAssetbalance() {
        try{
            $user = \Auth::user();
            $wallet_address = $user->wallet_id;

            $contractCount = Common::getAthleteInfoOfOwner($user->id);
            return response()->json(['balance'=>255, 'wallet_id'=>$wallet_address, 'contractcount'=>count($contractCount)]);
        }
        catch(Exception $exp) {
            return response()->json('fail');
        }
    }

    public function changeAthletePrice() {
        $athlete_id = request()->get('athlete_id');
        $price = request()->get('price');
        $model = new Celebrity();
        $model->where('_id', $athlete_id)->update(['price'=>$price]);

        return redirect()->route('dashboard');
    }

    public function getAuthUserInfo() {
        $user = \Auth::user()->toArray();
        return response()->json($user);
    }
}
