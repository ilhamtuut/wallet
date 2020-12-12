<?php

namespace App\Http\Controllers\Api;

use Response;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->passes()){
            $user = User::where('email',$request->email)->first();
            if($user){
                $hasPassword = Hash::check($request->password, $user->password);
                if($hasPassword){
                    if ($user->email_verified_at) {
                        $user->api_token = Str::random(60);
                        $user->save();
                        $data = array(
                            'success' => true, 
                            'message'=>'success',
                            'data'=> $user
                        );
                    }else{
                        $data = array(
                            'success' => false, 
                            'message' => 'Your account has not been verified, Please click on the activation link that we sent to your email.'
                        );
                    }
                }else{
                    $data = array(
                        'success' => false, 
                        'message'=>'password is wrong'
                    );
                }
            }else{
                $data = array(
                    'success' => false, 
                    'message'=>'email not found'
                );
            }
        }else{
            $data = array(
                'success' => false, 
                'message' => 'error parameter',
                'errors' => $validator->errors()
            );
        }
        return Response::json($data);
    }
}
