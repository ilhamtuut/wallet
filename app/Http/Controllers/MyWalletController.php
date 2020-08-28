<?php

namespace App\Http\Controllers;

use Auth;
use App\Wallet;
use App\Facades\Glp;
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

    public function index(Request $request)
    {
        $wallet = Auth::user()->wallet;
        if(is_null($wallet)){
            Glp::createWallet('My Wallet');
            $address = Wallet::where('user_id',Auth::id())->first()->address;
        }else{
            $address = $wallet->address;
        }
        $balance = number_format(Glp::balance());
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        
        return view('backend.wallet.index',compact('qrCode','address','balance'));
    }

    public function transaction(Request $request)
    {    
        return view('backend.wallet.transaction');
    }

    public function send(Request $request)
    {    
        return view('backend.wallet.send');
    }

    public function sendCoin(Request $request)
    {
        $this->validate($request, [
            'destination' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ]);
        $recipient = $request->destination;
        $amount = $request->amount;
        Glp::transaction($recipient, $amount);
        $request->session()->flash('success', 'Successfully, send money.');
        return redirect()->back();
    }

    public function receive(Request $request)
    {    
        $wallet = Auth::user()->wallet;
        if($wallet){
            $balance = number_format(Glp::balance());
            $renderer = new \BaconQrCode\Renderer\Image\Png();
            $renderer->setWidth(200);
            $renderer->setHeight(200);
            $encoding = 'utf-8';
            $bacon = new \BaconQrCode\Writer($renderer);
            $address = $wallet->address;
            $data = $bacon->writeString($address, $encoding);
            $qrCode = 'data:image/png;base64,'.base64_encode($data);
            return view('backend.wallet.receive',compact('qrCode','wallet','balance'));
        }else{
            return redirect()->route('wallet.index');
        }
    }

    public function updateLabel(Request $request)
    {
        $this->validate($request, [
            'label' => ['required', 'string'],
        ]);
        $wallet = Auth::user()->wallet;
        $wallet->label = $request->label;
        $wallet->save();
        $request->session()->flash('success', 'Successfully, updated label');
        return redirect()->back();
    }
}
