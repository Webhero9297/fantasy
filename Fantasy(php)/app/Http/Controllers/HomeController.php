<?php

namespace App\Http\Controllers;

use App\Models\Common;
use Illuminate\Http\Request;
use User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $site_data = Common::getSiteData();
//        dd($site_data);
        return view('frontend.home')->with(['site_data'=>$site_data]);
    }
}
