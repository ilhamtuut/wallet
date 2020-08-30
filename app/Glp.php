<?php

namespace App;

use Str;
use Response;
use App\Wallet;
use App\Transaction;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Glp {

    private $host = 'http://mumbai.solusi.cloud:3001/operator/';

    public function createWallet($label)
    {
        $password = $this->generatePass();
        // get addresID
        $response = Curl::to($this->host.'wallets')
            ->withData([
                'password' => $password
            ])
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->post();
        $addressID = $response->id;

        // create address wallet
        $create = Curl::to($this->host.'wallets/'.$addressID.'/addresses')
            ->withHeader('password: '.$password)
            ->asJson()
            ->post();

        $wallet = Wallet::create([
            'user_id' => Auth::id(),
            'label' => $label,
            'addressID' => $addressID,
            'address' => $create->address,
            'password' => $password,
            'description' => 'Greenline Project'
        ]);
        return $wallet;
    }

    public function balance($address)
    {
        $response = Curl::to($this->host.$address.'/balance')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        $balance = 0;
        if($response){
            $balance = $response->balance;
        }
        return $balance;
    }

    public function transaction($fromAddress, $toAddress, $amount)
    {   
        $wallet = Wallet::where('address',$fromAddress)->first();
        $addressID = $wallet->addressID;
        $password = $wallet->password;
        $fromAddress = $wallet->address;
        $response = Curl::to($this->host.'wallets/'.$addressID.'/transactions')
            ->withData([
                'fromAddress' => $fromAddress,
                'toAddress' => $toAddress,
                'amount' => $amount
            ])
            ->withHeader('password: '.$password)
            ->asJson()
            ->post();
        $return = false;
        if($response){
            $data = Transaction::create([
                'user_id' => Auth::id(),
                'hash' => $response->id,
                'amount' => $amount,
                'data' => json_encode($response)
            ]);
            $return = true;
        }
        return $return;
    }

    public function generatePass()
    {
        $password = '';
        for ($i=0; $i < 5; $i++) { 
            $word = Str::random(4);
            $password .= $word . ' ';
        }
        return substr($password, 0, -1);
    }

    public function blocks()
    {
        $response = [];
        return $response;
    }

    public function transactions()
    {
        $response = [];
        return $response;
    }

    public function qrCode($address)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        return $qrCode;
    }
}