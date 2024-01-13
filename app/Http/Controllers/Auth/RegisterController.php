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

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showRegistrationForm() {
        return view('auth.register');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    

    public function register(Request $request)
    {   
        
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email|unique:users',
            'phone_number'  => 'required|min:10',
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
            $file = null;
            if($request->hasFile('avatar')){
                $validator = Validator::make ( $request->all(),[
                    'avatar' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                    if($validator->fails()){
                        return $this->sendError('Validation Error.', $validator->errors());       
                    }
                    $file = time().'.'.$request -> avatar -> extension();
                    $request -> avatar -> move(public_path('assets-new/avatar/'), $file);
                    $mime = mime_content_type(public_path('assets-new/avatar/' . $file));
                }
                
                $user = User::create([
                    'name' => $request->first_name. ' ' . $request->last_name,
                    'first_name' => $request->first_name,                    
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone_number'  => $request->phone_number, 
                    'avatar' => $file,
                    'role' => ($request->role) ?  $request->role : '2',                   
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
}
