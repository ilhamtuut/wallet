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

    public function index(Request $request)
    {
        $search = $request->search;
        $data = User::whereHas('roles', function ($query) {
                    $query->where('roles.name', 'member');
                })
                ->when($search, function ($cari) use ($search) {
                    $cari->where('name', 'LIKE', $search.'%')
                    ->orWhere('email', 'LIKE', $search.'%');
                })->orderBy('name')
                ->simplePaginate(20);
        return view('backend.user.list', compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function block(Request $request, $id)
    {
        $user = User::find($id);
        $is_block = $user->is_block;
        if($is_block){
            $block = false;
            $msg = 'Block disabled account '.$user->name;
        }else{
            $block = true;
            $msg = 'Block activated account '.$user->name;
        }
        $user->is_block = $block;
        $user->save();
        $request->session()->flash('success', 'Successfully, '.$msg);
        return redirect()->back();
    }

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
