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

    private $host = 'http://mumbai.solusi.cloud:3001/';

    public function createWallet($label)
    {
        $password = $this->generatePass();
        // get addresID
        $response = Curl::to($this->host.'operator/wallets')
            ->withData([
                'password' => $password
            ])
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->post();
        $addressID = $response->id;

        // create address wallet
        $create = Curl::to($this->host.'operator/wallets/'.$addressID.'/addresses')
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
        $response = Curl::to($this->host.'operator/'.$address.'/balance')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        $balance = 0;
        if($response){
            $balance = $response->balance * 0.0000001;
        }
        return number_format($balance,7);
    }

    public function checkAddress($address)
    {
        $response = Curl::to($this->host.'operator/'.$address.'/balance')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        $return = false;
        if($response){
            $return = true;
        }
        return $return;
    }

    public function transaction($fromAddress, $toAddress, $amount)
    {   
        $wallet = Wallet::where('address',$fromAddress)->first();
        $addressID = $wallet->addressID;
        $password = $wallet->password;
        $fromAddress = $wallet->address;
        $amountSathosi = $amount * 10000000;
        $response = Curl::to($this->host.'operator/wallets/'.$addressID.'/transactions')
            ->withData([
                'fromAddress' => $fromAddress,
                'toAddress' => $toAddress,
                'amount' => $amountSathosi
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
        $response = Curl::to($this->host.'blockchain/blocks')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function detailBlock($hash)
    {
        $response = Curl::to($this->host.'blockchain/blocks/'.$hash)
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function latestblock()
    {
        $response = Curl::to($this->host.'blockchain/blocks/latest')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function transactions()
    {
        $response = Curl::to($this->host.'blockchain/transactions')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        return $response;
    }

    public function qrCode($address)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(250);
        $renderer->setHeight(250);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        return $qrCode;
    }
}