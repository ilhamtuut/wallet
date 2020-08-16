<?php

namespace App\Http\Controllers;

use App\Facades\Glp;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        return view('backend.home.index');
    }

    public function blocks(Request $request)
    {
        return Glp::blocks();
    }

    public function transactions(Request $request)
    {
        return Glp::transactions();
    }
}
