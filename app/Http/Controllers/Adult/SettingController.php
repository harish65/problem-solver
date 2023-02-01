<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;

class SettingController extends Controller
{
    //setting
    public function adultSetting(){
        $setting = Setting::get();
        return view("adult.setting.index", [
            "setting" => $setting,
        ]);
    }

    public function settingAdminSingleSoultin(Request $request){
        $count = Setting::count();

        if($count == 0){
            $setting = new Setting();
            $setting -> user_id = Auth::user() -> id;
            $setting -> single_solution = $request -> state;
            $setting -> save();
        }else{
            Setting::where("id", 1)
                -> update([
                    "single_solution" => $request -> state,
                ]);
        }

        return "success";
    }
}
