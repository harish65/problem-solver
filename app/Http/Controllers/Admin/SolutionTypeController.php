<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolutionType;
use Auth;

class SolutionTypeController extends Controller
{
    //solution type
    public function adminSolutionType(){
        return view("admin.solutionType.index");
    }

    public function createAdminSolutionType(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $solutionType = new SolutionType();
        $solutionType -> user_id = Auth::user() -> id;
        $solutionType -> name = $request -> name;
        $solutionType -> save();

        return back() -> with("success", "Solution type has been created successfully.");
    }

    public function getAdminSolutionType(Request $request){
        $search = $request -> search;
        $page = $request -> page;

        if($search == ""){
            $solutions = SolutionType::orderBy("id", "desc")
                -> paginate(10);
        }else{
            $solutions = SolutionType::where("name", "like", '%' . $search . "%")
                -> orderBy("id", 'desc')
                -> paginate(10);
        }

        return view("admin.solutionType.getAdminSolutionType", [
            "solutions" => $solutions,
        ]);
    }

    public function updateAdminSolutionType(Request $request){
        $request->validate([
            'updateSolutionTypeName' => 'required|max:255',
        ]);

        SolutionType::where("id", $request -> updateSolutionTypeId)
            -> update([
                "user_id" => Auth::user() -> id,
                "name" => $request -> updateSolutionTypeName,
            ]);

        return back() -> with("success", "Solution type has been updated successfully.");       
    }

    public function delAminSolutionType(Request $request){
        SolutionType::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Solution type has been deleted successfully.");       
    }
}
