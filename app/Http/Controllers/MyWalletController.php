<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyWalletController extends Controller
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

    public function index(Request $Request)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $address = 'DLHWwjG33EvP9FDYRqSEqwRpTjPPFwrDBE';
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        
        return view('backend.wallet.index',compact('qrCode','address'));
    }

    public function transaction(Request $Request)
    {    
        return view('backend.wallet.transaction');
    }

    public function send(Request $Request)
    {    
        return view('backend.wallet.send');
    }

    public function receive(Request $Request)
    {    
        return view('backend.wallet.receive');
    }
}
