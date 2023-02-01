<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Problem;
use Auth;

class ProblemController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    //problem
    public function adultProblem(Request $request){  
        
        $problems = Problem::orderBy("id", "desc")
            -> where("user_id", Auth::user() -> id)
            -> get();
            
            if ($request->is('api/*')) {
                $success['projects'] = $problems;
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success,'Reviewer Response');
            }else{
                return view("adult.problem.index", [
                    "problems" => $problems,
                ]);
            }
       
    }

    public function createProblem(Request $request){
        $problem = new Problem();
        $problem -> user_id = Auth::user() -> id;
        // $problem -> solve_type = $request -> solve_type;

        if($request -> name){
            $request->validate([
                'name' => 'required|max:255',
            ]);
            $problem -> name = $request -> name;
            $problem -> type = $request -> type;
        }

        if($request -> type == 0){
            if($request->hasFile('file')){
                $request -> validate([
                    'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> file -> extension();
                $request -> file -> move(public_path('assets/problem/'), $file);

                $mime = mime_content_type(public_path('assets/problem/' . $file));
                if(strstr($mime, "video/")){
                    $problem -> type = 1;
                }else if(strstr($mime, "image/")){
                    $problem -> type = 0;
                }
    
    
                $problem -> file = $file;
            }
        }elseif($request -> type == 2){
            $problem -> type = $request -> type;
            $problem -> file = $request -> link;
        }
        
        $problem -> save();

        return back() -> with("success", "Problem has been created successfully.");
    }

    public function updateProblem(Request $request){
        $defaultType = Problem::where("id", $request -> updateProblemId)
                -> value("type");

        $request->validate([
            'updateProblemName' => 'required|max:255',
        ]);

        Problem::where("id", $request -> updateProblemId)
            -> update([
                "user_id" => Auth::user() -> id,
                "name" => $request -> updateProblemName,
                "type" => $request -> updateProblemType,
                // "solve_type" => $request -> updateProblemSolveType,
            ]);

        if($request -> updateProblemType == 0){
            if($request->hasFile('updateProblemFile')){
                $request -> validate([
                    'updateProblemFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> updateProblemFile -> extension();
                $request -> updateProblemFile -> move(public_path('assets/problem/'), $file);

                $mime = mime_content_type(public_path('assets/problem/' . $file));
                if(strstr($mime, "video/")){
                    $type = 1;
                }else if(strstr($mime, "image/")){
                    $type = 0;
                }

                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "file" => $file,
                        "type" => $type
                    ]);
            }else{
                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 0,
                    ]);
            }

            if($defaultType == 1){
                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 1,
                    ]);
            }
        }elseif($request -> updateProblemType == 2){
            $request -> validate([
                'updateProblemFileLink' => 'required|url',
            ]);

            Problem::where("id", $request -> updateProblemId)
                -> update([
                    "type" => $request -> updateProblemType,
                    "file" => $request -> updateProblemFileLink,
                ]);
        }

        return back() -> with("success", "Problem has been updated successfully.");
    }

    public function delProblem(Request $request){
        Problem::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Problem has been deleted successfully.");
    }
}
