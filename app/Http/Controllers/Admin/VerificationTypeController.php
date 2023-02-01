<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerificationType;
use Auth;

class VerificationTypeController extends Controller
{
    //verification type
    public function adminVerificationType(){
        return view("admin.verificationType.index");
    }

    public function getAdminVerificationType(Request $request){
        $search = $request -> search;
        $page = $request -> page;

        if($search == ""){
            $types = VerificationType::orderBy("id", "desc")
                -> paginate(10);
        }else{
            $types = VerificationType::where("name", "like", '%' . $search . "%")
                -> orWhere("key", "like", '%' . $search . "%")
                -> orWhere("val", "like", '%' . $search . "%")
                -> orWhere("vals", "like", '%' . $search . "%")
                -> orderBy("id", 'desc')
                -> paginate(10);
        }

        return view("admin.verificationType.getAdminVerificationType", [
            "types" => $types,
        ]);
    }

    public function createAdminVerificationType(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'key' => 'required|max:255',
            'val' => 'required|max:255',
        ]);

        $type = new VerificationType();
        $type -> user_id = Auth::user() -> id;
        $type -> name = $request -> name;
        $type -> key = $request -> key;
        $type -> val = $request -> val;
        $type -> vals = $request -> vals;
        $type -> save();

        return back() -> with("success", "Verification type has been created successfully.");
    }

    public function updateAdminVerificationType(Request $request){
        $request->validate([
            'updateVerificationTypeName' => 'required|max:255',
            'updateVerificationTypeKey' => 'required|max:255',
            'updateVerificationTypeVal' => 'required|max:255',
        ]);

        VerificationType::where("id", $request -> updateVerificationTypeId)
            -> update([
                "user_id" => Auth::user() -> id,
                "name" => $request -> updateVerificationTypeName,
                "key" => $request -> updateVerificationTypeKey,
                "val" => $request -> updateVerificationTypeVal,
                "vals" => $request -> updateVerificationTypeVals,
            ]);

        return back() -> with("success", "Verification type has been updated successfully.");      
    }

    public function delAminVerificationType(Request $request){
        VerificationType::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Verification type has been deleted successfully.");     
    }
}
