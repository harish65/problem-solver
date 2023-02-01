<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\SolutionFunction;
use App\Models\SolutionType;
use App\Models\Setting;
use App\Models\Problem;
use Auth;

class SolutionFunctionController extends Controller
{
    //solution function
    public function adminSolFunction(){
        $problems = Problem::orderBy("id", "asc")
            -> get();

        $solutionTypes = SolutionType::orderBy("id", "asc")
            -> get();

        $setting = Setting::get();

        return view("admin.solFunction.index", [
            "problems" => $problems,
            "solutionTypes" => $solutionTypes,
            "setting" => $setting,    
        ]);
    }

    public function getAdminSolFunction(Request $request){
        $search = $request -> search;

        if($search == ""){
            $solFunctions = SolutionFunction::orderBy("id", "desc")
                -> paginate(5);
        }else{
            $users = User::where("name", "like", "%" . $search . "%")
                -> orWhere("email", "like", "%" . $search . "%")
                -> select("id")
                -> get();

            $problems = Problem::where("name", "like", "%" . $search . "%")
                -> select("id")
                -> get();

            $solutions = Solutions::where("name", "like", "%" . $search . "%")
                -> select("id")
                -> get();
                
            $solFunctions = Solution::orderBy("id", "desc")
                -> where(function($q) use($search, $users){
                    $q -> where("name", "like", "%" . $search . "%");
                    $q -> orWhereIn("user_id", $users);
                    $q -> orWhereIn("problem_id", $problems);
                    $q -> orWhereIn("solution_id", $solutions);
                })
                -> paginate(5);
        }

        return view("admin.solFunction.getAdminSolFunction", [
            "solFunctions" => $solFunctions,
        ]);
    }

    public function updateAdminSolFunction(Request $request){
        $defaultType = SolutionFunction::where("id", $request -> updateSolFunctionId)
            -> value("type");

        $request->validate([
            'updateSolFunctionName' => 'required|max:255',
            'updateSolFunctionSolutionId' => 'required|max:255',
        ]);

        SolutionFunction::where("id", $request -> updateSolFunctionId)
            -> update([
                "name" => $request -> updateSolFunctionName,
                "problem_id" => $request -> updateSolFunctionProblemId,
                "solution_id" => $request -> updateSolFunctionSolutionId,
                "type" => $request -> updateSolFunctionType,
            ]);

        if($request -> updateSolFunctionType == 0){
            if($request->hasFile('updateSolFunctionFile')){
                $request -> validate([
                    'updateSolFunctionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> updateSolFunctionFile -> extension();
                $request -> updateSolFunctionFile -> move(public_path('assets/solFunction/'), $file);

                $mime = mime_content_type(public_path('assets/solFunction/' . $file));
                if(strstr($mime, "video/")){
                    $type = 1;
                }else if(strstr($mime, "image/")){
                    $type = 0;
                }

                SolutionFunction::where("id", $request -> updateSolFunctionId)
                    -> update([
                        "file" => $file,
                        "type" => $type
                    ]);
            }else{
                SolutionFunction::where("id", $request -> updateSolFunctionId)
                    -> update([
                        "type" => 0,
                    ]);
            }

            if($defaultType == 1){
                SolutionFunction::where("id", $request -> updateSolFunctionId)
                    -> update([
                        "type" => 1,
                    ]);
            }
        }elseif($request -> updateSolFunctionType == 2){
            $request -> validate([
                'updateSolFunctionFileLink' => 'required|url',
            ]);

            SolutionFunction::where("id", $request -> updateSolFunctionId)
                -> update([
                    "type" => $request -> updateSolFunctionType,
                    "file" => $request -> updateSolFunctionFileLink,
                ]);
        }
        
        return back() -> with("success", "Solution Function has been updated successfully.");
    }
}
