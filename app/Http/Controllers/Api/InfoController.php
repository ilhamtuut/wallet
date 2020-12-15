<?php

namespace App\Http\Controllers\Api;

use Response;
use App\Setting;
use App\Facades\Glp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function index(Request $request)
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

        $info = array(
            'glp_usd' => $price_glp,
            'glp_btc' => $glp_btc,
            'block' => $block->blocks,
            'transactions' => $block->transactions,
            'difficulty' => $difficulty,
        );
        $data = array(
            'success' => true, 
            'message'=>'success',
            'data'=> $info
        );
        
        return Response::json($data);
    }
}
