<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;

class AuthController extends BaseController
{
    public function showRegistrationForm() {
        return view('auth.register');
    }
    public function register(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:users',
            'phone'  => 'required|min:10',
            'password' => [
                'required',
                'min:6',
                'confirmed'
            ]
           ]);   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
                $user = User::create([
                    'name' => $request->first_name. ' ' . $request->last_name,
                    'first_name' => $request->first_name,                    
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number'  => $request->phone_number, 
                    'role' => $request->role,                   
                    'password' => Hash::make($request->password),
                ]);
        if($user->id){
            $success['user'] =  $user;
            return $this->sendResponse($success, 'User register successfully.');
        }else{
            return $this->sendError('Unauthorised', 'Something went worng!'); 
        }
        }catch(Exception $e){
            return $this->sendError('Validation Error.', $e->getMessage());    
        }
        
    } 


    public function showLoginForm() {
        return view('auth.login');
     }
 
    
}
