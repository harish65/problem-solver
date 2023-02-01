<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\SolutionFunction;
use App\Models\Setting;
use Auth;

class SolutionFunctionController extends Controller
{
    //solution function
    public function adultSolFunction(){
        $solFunctions = SolutionFunction::orderBy("id", "desc")
            -> where('user_id', Auth::user() -> id)
            -> get();

        $problems = Problem::orderBy("id", "asc")
            -> where("user_id", Auth::user() -> id)
            -> get();

        // $solutionTypes = SolutionType::orderBy("id", "asc")
        //     -> get();

        $solutions = Solution::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> where("problem_id", $problems[0] -> id)
            -> get();

        $setting = Setting::get();

        return view("adult.solFunction.index", [
            "solFunctions" => $solFunctions,
            "problems" => $problems,
            // "solutionTypes" => $solutionTypes,
            "solutions" => $solutions,
            // "setting" => $setting,
        ]);
    }

    public function getSolutionPerProblem(Request $request){
        $solutions = Solution::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> where("problem_id", $request -> id)
            -> get();

        return view("adult.solFunction.getSolutionPerProblem", [
            "solutions" => $solutions,
        ]);
    }

    public function getSolutionPerProblemForUpdate(Request $request){
        $solutions = Solution::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> where("problem_id", $request -> problem_id)
            -> get();

        return view("adult.solFunction.getSolutionPerProblemForUpdate", [
            "solutions" => $solutions,
            "solution_id" => $request -> solution_id,
        ]);
    }

    public function createSolFunction(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            "solution_id" => 'required',
        ]);

        $solFunction = new SolutionFunction();
        $solFunction -> user_id = Auth::user() -> id;
        $solFunction -> name = $request -> name;
        $solFunction -> problem_id = $request -> problem_id;
        $solFunction -> solution_id = $request -> solution_id;
        $solFunction -> solution_function_type_id = $request -> solution_function_type_id;

        if($request -> type == 0){
            if($request->hasFile('file')){
                $request -> validate([
                    'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> file -> extension();
                $request -> file -> move(public_path('assets/solFunction/'), $file);

                $mime = mime_content_type(public_path('assets/solFunction/' . $file));
                if(strstr($mime, "video/")){
                    $solFunction -> type = 1;
                }else if(strstr($mime, "image/")){
                    $solFunction -> type = 0;
                }
    
    
                $solFunction -> file = $file;
            }
        }elseif($request -> type == 2){
            $solFunction -> type = $request -> type;
            $solFunction -> file = $request -> link;
        }

        $solFunction -> save();

        return back() -> with("success", "Solution Function has been created successfully.");
    }

    public function updateSolFunction(Request $request){
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
                "solution_function_type_id" => $request -> updateSolFunctionTypeId,
                "user_id" => Auth::user() -> id,
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

    public function delSolFunction(Request $request){
        SolutionFunction::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Solution Function has been deleted successfully.");
    }
}
