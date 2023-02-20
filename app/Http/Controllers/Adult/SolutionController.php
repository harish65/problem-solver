<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\Setting;
use Auth;

class SolutionController extends Controller
{

    public function index(){
        return view('adult.solution.index');
    }




    //solution
    public function adultSolution(){
        $problems = Problem::orderBy("id", "asc")
            -> where("user_id", Auth::user() -> id)
            -> get();

        $solutionTypes = SolutionType::orderBy("id", "asc")
            -> get();

        $solutions = Solution::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> get();

        $setting = Setting::get();

        return view("adult.solution.index", [
            "problems" => $problems,
            "solutions" => $solutions,
            "solutionTypes" => $solutionTypes,
            "setting" => $setting,
        ]);
    }

    public function createSolution(Request $request){
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $solution = new Solution();
        $solution -> user_id = Auth::user() -> id;
        $solution -> problem_id = $request -> problem_id;
        $solution -> solution_type_id = $request -> solution_type_id;
        $solution -> name = $request -> name;
        // $solution -> state = $request -> state;

        if($request -> type == 0){
            if($request->hasFile('file')){
                $request -> validate([
                    'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> file -> extension();
                $request -> file -> move(public_path('assets/solution/'), $file);

                $mime = mime_content_type(public_path('assets/solution/' . $file));
                if(strstr($mime, "video/")){
                    $solution -> type = 1;
                }else if(strstr($mime, "image/")){
                    $solution -> type = 0;
                }
    
    
                $solution -> file = $file;
            }
        }elseif($request -> type == 2){
            $solution -> type = $request -> type;
            $solution -> file = $request -> link;
        }

        $solution -> save();

        return back() -> with("success", "Solution has been created successfully.");
    }

    public function updateSolution(Request $request){
        $defaultType = Solution::where("id", $request -> updateSolutionId)
            -> value("type");

        $request->validate([
            'updateSolutionName' => 'required|max:255',
        ]);

        Solution::where("id", $request -> updateSolutionId)
            -> update([
                "name" => $request -> updateSolutionName,
                "problem_id" => $request -> updateSolutionProblemId,
                "solution_type_id" => $request -> updateSolutionTypeId,
                "type" => $request -> updateSolutionType,
                // "state" => $request -> updateSolutionState,
                "user_id" => Auth::user() -> id,
            ]);

        if($request -> updateSolutionType == 0){
            if($request->hasFile('updateSolutionFile')){
                $request -> validate([
                    'updateSolutionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> updateSolutionFile -> extension();
                $request -> updateSolutionFile -> move(public_path('assets/solution/'), $file);

                $mime = mime_content_type(public_path('assets/solution/' . $file));
                if(strstr($mime, "video/")){
                    $type = 1;
                }else if(strstr($mime, "image/")){
                    $type = 0;
                }

                Solution::where("id", $request -> updateSolutionId)
                    -> update([
                        "file" => $file,
                        "type" => $type
                    ]);
            }else{
                Solution::where("id", $request -> updateSolutionId)
                    -> update([
                        "type" => 0,
                    ]);
            }

            if($defaultType == 1){
                Solution::where("id", $request -> updateSolutionId)
                    -> update([
                        "type" => 1,
                    ]);
            }
        }elseif($request -> updateSolutionType == 2){
            $request -> validate([
                'updateSolutionFileLink' => 'required|url',
            ]);

            Solution::where("id", $request -> updateSolutionId)
                -> update([
                    "type" => $request -> updateSolutionType,
                    "file" => $request -> updateSolutionFileLink,
                ]);
        }
        
        return back() -> with("success", "Solution has been updated successfully.");
    }

    public function delSolution(Request $request){
        Solution::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Solution has been deleted successfully.");
    }
}
