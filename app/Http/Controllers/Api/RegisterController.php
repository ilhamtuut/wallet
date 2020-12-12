<?php

namespace App\Http\Controllers\Api;

use Response;
use App\User;
use App\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegisterController extends Controller
{
    use RegistersUsers;
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $memberRole = Role::where('name', 'member')->first();
        $user->attachRole($memberRole);

        return $user;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|unique:users,email|email|max:255',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->passes()){
            $user = $this->create($request->all());
        	$user->notify(new VerifyEmail);

            $data = array(
                'success' => true, 
                'message'=>'success',
                'data'=> $user
            );
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
