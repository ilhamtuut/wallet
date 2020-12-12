<?php

namespace App\Http\Controllers\Api;

use Mail;
use Response;
use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function profile(Request $request)
    {
        $user = Auth::user();
        $data = array(
            'success' => true, 
            'data'=>$user
        );
        return Response::json($data);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8|same:new_password',
        ]);
        
        if ($validator->passes()){
            $user = Auth::user();
            $password = $request->current_password;
            $hasPassword = Hash::check($password,$user->password);
            if ($hasPassword){
                $user->fill([
                    'password' => Hash::make($request->new_password) 
                ]);
                $user->save();
                $data = array(
                    'success' => false, 
                    'message'=>'Successfully, updated password'
                );
            }else {
                $data = array(
                    'success' => false, 
                    'message'=>'Password is wrong'
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
