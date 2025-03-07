<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use Auth;

class LoginController extends BaseController
{
    //Trait
    // use AuthenticatesUsers;

    // Custom guard for admin
    protected function guard()
    {
        return \Auth::guard('admin');
    }

    /**
     * Rendered a login of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * Validate the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|exists:users,email',
            'password'      => 'required|min:6',
        ]);
      
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        if($user = User::where(['email' => $request->email])->first() ) {
            if($user->role == 1){  
            // $checkRole = RoleAssignedToUser::where('user_id' , $user->id)->first();
            // if (!empty($checkRole) && $checkRole->role_id == 1) {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                    $success['user'] =  $user;
                    return $this->sendResponse($success, 'User login successfully.');
                } else { 
                    return $this->sendError('Error.', ['error'=> 'Email and Password is Invalid.']);
                } 
            // } else {
            //     return $this->sendError('Error.', ['error'=> 'Invalid Login.']);
            // }
            }else{
                return $this->sendError('Error.', ['error'=> "Invalid user role!."]);
            }
        } else { 
            return $this->sendError('Error.', ['error'=> 'Email and Password is Invalid.']);
        }  
    }
    
    public function profile()
    {
        return view('admin.profile');
    }

    public function profile_edit()
    {
        return view('admin.profile_edit');
    }

    public function change_password()
    {
        return view('admin.change_password');
    }   
        
    public function getlogout()
    {
        // \Auth::guard('users')->logout();
        // Auth::user()->logout();
        Auth()->logout();
        toastr()->success('Logged out successfully!');
        return redirect()->route('admin.login')->with(['success' => 'user logged out successfully']);
    }


}
