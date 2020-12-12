<?php

namespace App\Http\Controllers\Api;

use Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ResetPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );
        if($response == Password::RESET_LINK_SENT){
            $data = array(
                'success' => true, 
                'message'=>'We have e-mailed your password reset link!'
            );
        }else{
            $data = array(
                'success' => false, 
                'message' => 'We can\'t find a user with that email.'
            );
        }
        return Response::json($data);
    }
}
