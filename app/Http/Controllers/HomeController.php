<?php

namespace App\Http\Controllers;

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
        $price_glp = 1.2; // usd
        $url = 'https://blockchain.info/tobtc?currency=USD&value='.$price_glp;
        $response = Curl::to($url)
            ->asJson()
            ->get();
        $glp_btc = $response;
        return view('backend.home.index',compact('glp_btc'));
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
