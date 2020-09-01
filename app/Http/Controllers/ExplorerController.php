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
        return view('backend.explorer.block', compact('data'));
    }

    public function hash(Request $request, $hash)
    {
        return view('backend.explorer.hash');
    }

    public function address(Request $request, $address)
    {
        $balance = Glp::balance($address);
        $qrCode = Glp::qrCode($address);
        return view('backend.explorer.address', compact('qrCode','address','balance'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if($search){
            $address = Glp::checkAddress($search);
            if($address){
                return redirect()->route('explorer.address', $search);
            }

            $hash = Glp::detailBlock($search);
            if($hash){
                return redirect()->route('explorer.block', $search);
            }
        }

        return view('backend.explorer.search');

    }
}
