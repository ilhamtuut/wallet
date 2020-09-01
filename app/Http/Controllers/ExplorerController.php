<?php

namespace App\Http\Controllers;

use App\Facades\Glp;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function block(Request $request, $hash)
    {
        $data = Glp::detailBlock($hash);
        if($data){
            return view('backend.explorer.block', compact('data'));
        }else{
            return redirect('/');
        }
    }

    public function hash(Request $request, $hash)
    {
        $data = Glp::detailTransactions($hash);
        if($data){
            $in = 0;
            $out = 0;
            foreach ($data->data->inputs as $key => $value) {
                $in += $value->amount;
            }
            foreach ($data->data->outputs as $key => $value) {
                $out += $value->amount;
            }
            $size = mb_strlen(json_encode($data, JSON_NUMERIC_CHECK), '8bit');
            return view('backend.explorer.hash', compact('data','size','in','out'));
        }else{
            return redirect('/');
        }
    }

    public function address(Request $request, $address)
    {
        $balance = Glp::balance($address);
        $qrCode = Glp::qrCode($address);
        return view('backend.explorer.address', compact('qrCode','address','balance'));
    }

    public function search(Request $request)
    {
        $search = $request->q;
        if($search){
            $address = Glp::checkAddress($search);
            if($address){
                return redirect()->route('explorer.address', $search);
            }

            $hash = Glp::detailBlock($search);
            if($hash){
                return redirect()->route('explorer.block', $search);
            }

            $trans = Glp::detailTransactions($search);
            if($trans){
                return redirect()->route('explorer.hash', $search);
            }
        }

        return view('backend.explorer.search');

    }
}
