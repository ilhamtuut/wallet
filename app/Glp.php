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
    private $_host = 'http://mumbai.solusi.cloud:8000/';
    // list API ['blocks (GET)','transactions (GET)','mywallet (GET)','transact (POST)','mine (POST)','balance (GET)', 'mine-transactions (GET)','peers (GET)']

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

    public function createWallet($label)
    {
        $params = $this->generatePort();
        $response = Curl::to($this->_host)
            ->withData($params)
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->post();
        $return = false;
        $res = json_encode($response);
        if(Str::contains($res, 'http_port_endpoint')){
            $wallet = Wallet::create([
                'user_id' => Auth::id(),
                'label' => $label,
                'address' => 'NULL',
                'port' => $params['userid'],
                'p2p' => $params['p2p'],
                'endpoind_port' => $response->http_port_endpoint,
                'endpoind_p2p' => $response->p2p_server,
                'description' => 'Greenline Project'
            ]);
            // $this->myWallet($wallet->endpoind_port);
            // $wallet->address = $this->myWallet($response->http_port_endpoint);
            // $wallet->save();
            $return = true;
        }
        return $return;
    }

    public function myWallet()
    {
        $wallet = Auth::user()->wallet;
        $url = $wallet->endpoind_port;
        $response = Curl::to($url.'/mywallet')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        Wallet::where('user_id',Auth::id())->update(['address' => $response->publicKey]);
        return true;
    }

    public function balance()
    {
        // $url = Auth::user()->wallet->endpoind_port;
        $url = Wallet::where('user_id',Auth::id())->first()->endpoind_port;
        $response = Curl::to($url.'/balance')
            ->withHeader('Content-Type: application/json')
            ->asJson()
            ->get();
        $balance = 0;
        if($response){
            $balance = $response->balance;
        }
        return $balance;
    }

    public function transaction($recipient, $amount)
    {   
        $url = Wallet::where('user_id',Auth::id())->first()->endpoind_port;
        $response = Curl::to($url.'/transact')
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

    private function generatePort()
    {
        # range port => not port (8000/2233) (3010 - 65535)
        $port = 3010;
        $p2p = 5010;
        $wallet = Wallet::orderBy('id','desc')->first();
        if($wallet){
            $port = $wallet->port + 1;
            $p2p = $wallet->p2p + 1;

            if($port == 8000 || $port == 2233){
                $port = $port + 1;
            }
        }

        $data = array(
            'email' => Auth::user()->email,
            'userid' => $port, 
            'p2p' => $p2p
        );
        return $data;
    }
}