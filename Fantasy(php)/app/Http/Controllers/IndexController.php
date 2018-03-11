<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class IndexController extends Controller
{
    //
    public function index() {

        $admin_user = env('SYS_ADMIN');
        if ( is_null($admin_user) ) {
            return view('auth.registermanager');
        }
        else {
            return redirect()->route('home');
        }
        //return view('welcome');
    }
}
