<?php

namespace App;

use Response;
use App\Wallet;
use App\Transaction;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Glp {

    private $host = 'http://mumbai.solusi.cloud:3001/';
    // list API ['blocks','transactions','mywallet','transact','mine']

    public function blocks()
    {
        $response = Curl::to($this->host.'blocks')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function transactions()
    {
        $response = Curl::to($this->host.'transactions')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function myWallet()
    {
        $response = Curl::to($this->host.'mywallet')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response->publicKey;
    }

    public function createWallet()
    {
        # code...
    }

    public function balance($address)
    {
        # code...
    }

    public function transaction($recipient, $amount)
    {
        // $recipient = '041cb71f74b3e6b094ae00a31ff8b7aad2bc8d5dc68e9760989fb3ce4db23a1498cb18b7f7d1d1b2a287faa54e0fdaf2a132dfe676b4ad6d0fc00017caf9435476'; 
        
        $response = Curl::to($this->host.'transact')
            ->withData([
                'recipient' => $recipient,
                'amount' => $amount
            ])
            ->withHeader('Content-Type: application/json')
            ->allowRedirect()
            ->asJson()
            ->post();
        return $response;
    }
}