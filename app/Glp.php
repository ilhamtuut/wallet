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
        $response = Curl::to($this->host.'transact')
            ->withData([
                'recipient' => $recipient,
                'amount' => $amount
            ])
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->post();
        return $response;
    }
}