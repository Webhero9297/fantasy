<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Celebrity;
use App\Models\Common;
use App\Models\Purchase;
use App\Models\Sold;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyContractController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($athlete_id) {
        $athlete_data = Common::getAthleteInfo($athlete_id);
        return view('frontend.buycontract')->with(['athlete'=>$athlete_data]);
    }

    public function buyContract($athlete_id) {
        $user = \Auth::user();
        $price = request()->get('price');

        $athleteModel = new Celebrity();

        $athlete_record = $athleteModel->where('_id', $athlete_id)->first();
        $athleteData = $athlete_record->toArray();

        $seller_id = $athleteData['owner_id'];
        if ( $user->id == $seller_id )
            return redirect()->route('dashboard');

        $transactionModel = new TransactionHistory();
        $buyer_id = $user->id;
        $price *= 1;
        $site_fee = $athleteData['site_fee']*$price/100;
        $actual_fee = $athleteData['send_fee']*$price/100;

        $athlete_record->owner_id = $buyer_id;
        $athlete_record->price = $price*2;
        $athlete_record->purchase_price = $price*1;
        $athlete_record->save();

//        $purchaseModel = new Purchase();
//        $purchaseModel->athlete_id = $athlete_id;
//        $purchaseModel->owner_id = $buyer_id;
//        $purchaseModel->price = $price;
//        $purchaseModel->save();
//
//        $seller_data = $purchaseModel->where('owner_id', $seller_id)->where('athlete_id', $athlete_id)->first()->toArray();
//        $purchaseModel->where('owner_id', $seller_id)->where('athlete_id', $athlete_id)->delete();
//
//        $soldModel = new Sold();
//        $soldModel->athlete_id = $seller_data['athlete_id'];
//        $soldModel->owner_id = $seller_data['owner_id'];
//        $soldModel->purchase_price = $seller_data['price'];
//        $soldModel->sold_price = $price;
//        $soldModel->save();

        $transactionModel->athlete_id = $athlete_id;
        $transactionModel->seller = $seller_id;
        $transactionModel->buyer = $buyer_id;
        $transactionModel->price = $price;
        $transactionModel->purchase_price = $athleteData['purchase_price'];
        $transactionModel->site_fee = $site_fee;
        $transactionModel->actual_fee = $actual_fee;
        $transactionModel->save();

        return redirect()->route('dashboard');
//dd($user, $price, $athlete_id);
    }
}
