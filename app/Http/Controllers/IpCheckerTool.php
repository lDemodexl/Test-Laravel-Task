<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
class IpCheckerTool extends Controller
{
    public function index(Request $request){

        $cookie_user_uid = Cookie::get('user_uid');

        return view('home', compact('cookie_user_uid'));
    }
}
