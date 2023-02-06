<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Validator;

class UserController extends BaseController
{
    //user
    public function adminUser(){
        $users = User::all();
        return view("admin.user.index", compact('users'));
    }
    public function create(){       
        return view("admin.user.create");
    }

    public function getAdminUser(Request $request){
        $users = User::all();
        return view("admin.user.getAdminUser", [
                    "users" => $users,
                ]);  
    }
    public function view($id){
        $user = User::where("id", $id)
            -> first();

        return view('admin.user.viewAdminUser', [
            "user" => $user,
        ]);
    }

    public function edit($id){
        $user = User::where("id", $id)-> first();
        $user->personal_info = json_decode($user->personal_info);
        $user->social_media_links	 = json_decode($user->social_media_links);
        return view("admin.user.editAdminUser", ["user" => $user]);
    }

        public function store(Request $request){        
            $validator = Validator::make ( $request->all(),[
                    'name' => 'required|max:255',
                    'first_name' => 'required| max:255',
                    'last_name' => 'required| max:255',
                    'email' => 'required|email|unique:users,email',
                    
                ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            try{
                $avatar = null;
                if($request->hasFile('avatar')){
                    $request -> validate([
                        'avatar' => 'required|mimes:png,jpg,jpeg|:2048',
                    ]);    
                    $avatar = time().'.'.$request -> avatar -> extension();    
                    $request -> avatar -> move(public_path('assets/vendors/images/avatar/'), $avatar);
                    
                }            
                $user = User::Insert([
                            'name' => $request -> name,
                            'first_name' => $request -> first_name,
                            'last_name' => $request -> name,
                            'avatar' => $avatar,
                            'email' => $request -> email,
                            'password' =>  Hash::make('123456')
                        ]);
                if($user){ 
                        $success['user'] =  $user;
                        return $this->sendResponse($success, 'User created successfully.');
                } else { 
                    return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
                } 
        }catch(Exceptio $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
        }
    }

    public function update(Request $request , $id){        
        $validator = Validator::make ( $request->all(),[
            'name' => 'required|max:255',
            'first_name' => 'required| max:255',
            'last_name' => 'required| max:255',
            'email' => 'required|email|unique:users,email,' .$id.',id',
            
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            
            if($request->hasFile('avatar')){
                $request -> validate([
                    'avatar' => 'required|mimes:png,jpg,jpeg|:2048',
                ]);    
                $avatar = time().'.'.$request -> avatar -> extension();    
                $request -> avatar -> move(public_path('assets/vendors/images/avatar/'), $avatar);
                User::where("id",$request -> id)
                    -> update([
                        "avatar" => $avatar,
                    ]);
            }
           
            $user = User::where("id",$request -> id)->update([
                                        "name" => $request -> name,
                                        'first_name' => $request -> first_name,
                                        'last_name' => $request -> name,
                                        'email' => $request -> email,
                                    ]);
            if($user){ 
                    $success['user'] =  $user;
                    return $this->sendResponse($success, 'User updated successfully.');
            } else { 
                return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
            } 
        }catch(Exceptio $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
        }
    }


    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user =  User::find($id);
            if($user){
                $user->delete();
                $success['user'] =  $user;
                return $this->sendResponse($success, 'User deleted.');
            }else{
                return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
            }
            
         }catch(Exceptio $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
        }
       

        return redirect()->route('admin.permissions.index');
    }
     /**
     * Update User personal info
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateUserPersonalInfo(Request $request , $id){
        $validator = Validator::make ( $request->all(),[
            'name' => 'required|max:255',
            'title' => 'required| max:255',
            'email' => 'required| max:255',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'phone_number' => 'required',
            'address' => 'required' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try{
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone_number;
            $user->personal_info = json_encode($request->all());
            $user->save();
            $success['user'] =  $user;
            return $this->sendResponse($success, 'User updated successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
        }

    }

     /**
     * Update User personal info
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function updateUserSocialInfo(Request $request , $id){
        $validator = Validator::make ( $request->all(),[
            'fb_url' => 'required|url',
            'twitter_url' => 'required|url',
            'linked_url' => 'required|url',
            'instagram_url' => 'required|url',
            'dribble_url' => 'required|url',
            'dropbox_url' => 'required|url',
            'google_plus_url' => 'required|url',
            'pinterest_url' => 'required|url',
            'skype_url' => 'required|url',
            'vine_url' => 'required|url' 
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try{
            $user = User::find($id);
            $user->social_media_links = json_encode($request->all());
            $user->save();
            $success['user'] =  $user;
            return $this->sendResponse($success, 'Links updated successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
        }

    }
}
