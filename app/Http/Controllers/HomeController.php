<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Facades\Glp;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $setting = Setting::where('name','Price GLP')->first();
        $price_glp = 9; // usd
        if($setting){
            $price_glp = $setting->value; // usd
        }
        $url = 'https://blockchain.info/tobtc?currency=USD&value='.$price_glp;
        $response = Curl::to($url)
            ->asJson()
            ->get();
        $glp_btc = number_format($response,8);
        $block = Glp::count();
        $difficulty = Glp::difficulty();
        $supply = Glp::supply();
        return view('backend.home.index',compact('glp_btc','block','difficulty','supply'));
    }

    public function blocks(Request $request)
    {
        return Glp::blocks();
    }

    public function transactions(Request $request)
    {
        return Glp::transactions();
    }
}
