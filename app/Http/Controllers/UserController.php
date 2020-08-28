<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function setting(Request $request)
    {    
        return view('backend.user.setting');
    }

    public function updateName(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        $request->session()->flash('success', 'Successfully, updated name');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->flash('success', 'Successfully, updated password');
        return redirect()->back();
    }
}
