<?php

namespace App\Http\Controllers\Api;

use Auth;
use Response;
use App\Wallet;
use App\Transaction;
use App\Facades\Glp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
    public function createWallet(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'label' => ['required', 'string']
        ]);

        if ($validator->passes()){
	        Glp::createWallet($request->label);
	        $data = array(
	            'success' => true, 
	            'message'=>'Successfully, create new address wallet GLP.'
	        );
	    }else{
	    	$data = array(
                'success' => false, 
                'message' => 'error parameter',
                'errors' => $validator->errors()
            );
	    }
        return Response::json($data);
    }

    public function myBalance(Request $request,$address)
    {    
        $balance = Glp::balance($address);
        $data = array(
            'success' => true, 
            'data' => ['balance' => $balance, 'address' => $address]
        );
        return Response::json($data);
    }

    public function myWallet(Request $request)
    {    
        $wallet = Auth::user()->wallet()->get();
        $data = array(
            'success' => true, 
            'data' => $wallet
        );
        return Response::json($data);
    }

    public function sendCoin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_address' => ['required', 'string' ,'min:64'],
            'destination_address' => ['required', 'string' ,'min:64'],
            'amount' => ['required', 'numeric'],
        ]);

        if ($validator->passes()){
	        $fromAdddres = $request->from_address;
	        $toAdddres = $request->destination_address;
	        $amount = $request->amount;
	        $wallet = Auth::user()->wallet;
            $response = Glp::transaction($fromAdddres, $toAdddres, $amount);
            if($response){
            	$data = array(
		            'success' => true, 
		            'message'=>'Successfully, send coin GLP.'
		        );
            }else{
            	$data = array(
		            'success' => false, 
		            'message'=>'Failed, send coin GLP. Please check your balance or address.'
		        );
            }
        }else{
	    	$data = array(
                'success' => false, 
                'message' => 'error parameter',
                'errors' => $validator->errors()
            );
	    }
        return Response::json($data);
    }

    public function transaction(Request $request)
    {    
        $transaction = Auth::user()->transaction()->orderBy('id','desc')->paginate(10);
        $data = array(
            'success' => true, 
            'data' => $transaction
        );
        return Response::json($data);
    }
}
