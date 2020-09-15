<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
	public function index(Request $request)
	{
		$data = Setting::paginate(20);
		return view('backend.setting.index', compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	public function update(Request $request,$id)
	{
        $this->validate($request, [
            'amount'=>'required|numeric'
        ]);

        $setting = Setting::find($id);
        if($setting->type == "IDR" || $setting->type == "USD" || $setting->type == "USDT"){
            $amount = $request->amount;
            $ket = "Change ".$setting->name." => value ".$setting->value." to ".$amount;
        }elseif($setting->type == "%"){
            $amount = $request->amount/100;
            $ket = "Change ".$setting->name." => value ".($setting->value*100)."% to ".$request->amount."%";
        }

        $setting->value = $amount;
        $setting->save();
        $request->session()->flash('success', 'Successfully, '.$ket); 
        
        return redirect()->back();
	}
}
