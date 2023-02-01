<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerificationType;
use App\Models\VerificationTypeText;
use Auth;

class VerificationTypeTextController extends Controller
{
    //verification type text
    public function adminVerificationTypeText(){
        $verificationTypes = VerificationType::orderBy("id", "asc")
            -> get();

        return view('admin.verificationTypeText.index', [
            "verificationTypes" => $verificationTypes,
        ]);
    }

    public function createAdminVerificationTypeText(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $text = new VerificationTypeText();
        $text -> user_id = Auth::user() -> id;
        $text -> name = $request -> name;
        $text -> verification_type_id = $request -> verification_type_id;
        $text -> save();

        return back() -> with("success", "Verification type text has been created successfully.");
    }

    public function getAdminVerificationTypeText(Request $request){
        $search = $request -> search;
        $page = $request -> page;

        if($search == ""){
            $types = VerificationTypeText::orderBy("id", "desc")
                -> paginate(10);
        }else{
            $types = VerificationTypeText::where("name", "like", '%' . $search . "%")
                // -> orWhere("key", "like", '%' . $search . "%")
                -> orderBy("id", 'desc')
                -> paginate(10);
        }

        return view("admin.verificationTypeText.getAdminVerificationTypeText", [
            "types" => $types,
        ]);
    }

    public function updateAdminVerificationTypeText(Request $request){
        $request->validate([
            'updateVerificationTypeTextVerificationTypeId' => 'required|max:255',
            'updateVerificationTypeTextName' => 'required|max:255',
        ]);

        VerificationTypeText::where("id", $request -> updateVerificationTypeTextId)
            -> update([
                "user_id" => Auth::user() -> id,
                "verification_type_id" => $request -> updateVerificationTypeTextVerificationTypeId,
                "name" => $request -> updateVerificationTypeTextName,
            ]);

        return back() -> with("success", "Verification type text has been updated successfully.");      
    }

    public function delAminVerificationTypeText(Request $request){
        VerificationTypeText::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Verification type text has been deleted successfully.");     
    }
}
