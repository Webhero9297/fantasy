<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = \Auth::user();
        $athletes = Common::getAthleteInfoOfOwner($user->id);

        $transaction_data = Common::getTransactionData($user->id);
//        dd($transaction_data);
        return view('frontend.dashboard')->with(['athletes'=>$athletes, 'transaction_data'=>$transaction_data]);
    }
}
