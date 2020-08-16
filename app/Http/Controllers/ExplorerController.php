<?php

namespace App\Http\Controllers;

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

    public function hash(Request $request, $hash)
    {
        return view('backend.explorer.hash');
    }

    public function block(Request $request, $hash)
    {
        return view('backend.explorer.block');
    }

    public function address(Request $request, $address)
    {
    	$renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(200);
        $renderer->setHeight(200);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $address = 'A2udJWsW1vJBvoAdD96Y8BnmxqCoLq78Y3';
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        return view('backend.explorer.address', compact('qrCode','address'));
    }
}
