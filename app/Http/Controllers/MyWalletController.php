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
        $balance = Glp::balance($address);
        $qrCode = Glp::qrCode($address);
        
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
        $cekAddress = Glp::checkAddress($toAdddres);
        if($cekAddress){
            $response = Glp::transaction($fromAdddres, $toAdddres, $amount);
            if($response){
                $request->session()->flash('success', 'Successfully, send coin.');
            }else{
                $request->session()->flash('failed', 'Failed, send coin. Please check your balance or address.');
            }
        }else{
            $request->session()->flash('failed', 'Failed, Invalid destination address.');
        }
        return redirect()->back();
    }

    public function receive(Request $request)
    {    
        $wallet = Auth::user()->wallet()->get();
        return view('backend.wallet.receive',compact('wallet'));
        
    }

    public function update_label(Request $request)
    {
        $this->validate($request, [
            'id' => ['required', 'string'],
            'label' => ['required', 'string'],
        ]);

        Wallet::find($request->id)->update([
            'label' => $request->label
        ]);

        $request->session()->flash('success', 'Successfully, updated label');
        return redirect()->back();
    }

    public function list(Request $request)
    {    
        $search = $request->search;
        $data = Wallet::when($search, function ($query) use ($search) {
                    $query->whereHas('user', function ($cari) use ($search){
                        $cari->where('users.name', 'LIKE', $search.'%');
                    });
                })->orderBy('label')
                ->simplePaginate(20);
        return view('backend.wallet.list',compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
        
    }
}
