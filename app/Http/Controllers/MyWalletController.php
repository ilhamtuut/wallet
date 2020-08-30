<?php

namespace App\Http\Controllers;

use Auth;
use App\Wallet;
use App\Transaction;
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
        $wallet = Auth::user()->wallet()->first();
        if(is_null($wallet)){
            Glp::createWallet('My Wallet');
            $address = Wallet::where('user_id',Auth::id())->first()->address;
        }else{
            $address = $wallet->address;
        }
        $balance = number_format(Glp::balance($address));
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        
        return view('backend.wallet.index',compact('qrCode','address','balance'));
    }

    public function createWallet(Request $request)
    {
        $this->validate($request, [
            'label' => ['required', 'string']
        ]);
        Glp::createWallet($request->label);
        $request->session()->flash('success', 'Successfully, create new address wallet GLP.');
        return redirect()->back();
    }

    public function transaction(Request $request)
    {    
        $data = Auth::user()->transaction()->orderBy('id','desc')->paginate(10);
        return view('backend.wallet.transaction',compact('data'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function send(Request $request)
    {    
        $wallet = Auth::user()->wallet()->get();
        return view('backend.wallet.send', compact('wallet'));
    }

    public function sendCoin(Request $request)
    {
        $this->validate($request, [
            'adddres' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ]);

        $fromAdddres = $request->adddres;
        $toAdddres = $request->destination;
        $amount = $request->amount;
        $wallet = Auth::user()->wallet;
        $response = Glp::transaction($fromAdddres, $toAdddres, $amount);
        if($response){
            $request->session()->flash('success', 'Successfully, send money.');
        }else{
            $request->session()->flash('failed', 'Failed, send money. Please check your balance or address.');
        }
        return redirect()->back();
    }

    public function receive(Request $request)
    {    
        $wallet = Auth::user()->wallet()->get();
        return view('backend.wallet.receive',compact('wallet'));
        
    }

    public function updateLabel(Request $request, $id)
    {
        $this->validate($request, [
            'label' => ['required', 'string'],
        ]);

        Wallet::find($id)->update([
            'label' => $request->label
        ]);

        $request->session()->flash('success', 'Successfully, updated label');
        return redirect()->back();
    }
}
