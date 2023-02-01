<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    //profile
    public function profile(){
        return view("main.profile.index");
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user() -> id.',id',
        ]);

        User::where("id", Auth::user() -> id)
            -> update([
                "name" => $request -> name,
                'email' => $request -> email,
            ]);

        if($request->hasFile('avatar')){
            $request -> validate([
                'avatar' => 'required|mimes:png,jpg,jpeg|:2048',
            ]);

            $avatar = time().'.'.$request -> avatar -> extension();

            $request -> avatar -> move(public_path('assets/vendors/images/avatar/'), $avatar);

            User::where("id", Auth::user() -> id)
                -> update([
                    "avatar" => $avatar,
                ]);
        }

        return back() -> with("success", "Profile updated successfully.");
    }
}
