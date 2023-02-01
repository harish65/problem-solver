<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\Setting;
use App\Models\Problem;
use Auth;
use DB;

class SolutionController extends BaseController
{
    //solution
    public function index(){
        $solutions = DB::table('solutions')
            ->leftJoin('problems', 'solutions.problem_id', '=', 'problems.id')
            ->leftJoin('solution_types' , 'solutions.solution_type_id' , '=' , 'solution_types.id')
            ->leftJoin('users' , 'solutions.user_id' , '=' , 'users.id')
            ->select('solutions.id as solutions_id','solutions.file', 'solutions.name as solution','problems.name as problem', 'solution_types.name as solution_type', 'users.name as creator')
            ->get();
        $problems = Problem::all();
        $solutionTypes = SolutionType::all();
        return view("admin.solution.index" , compact('solutions','problems' ,'solutionTypes'));
    }

    public function getAdminSolution(Request $request){
        $search = $request -> search;

        if($search == ""){
            $solutions = Solution::orderBy("id", "desc")
                -> paginate(5);
        }else{
            $users = User::where("name", "like", "%" . $search . "%")
                -> orWhere("email", "like", "%" . $search . "%")
                -> select("id")
                -> get();

            $problems = Problem::where("name", "like", "%" . $search . "%")
                -> select("id")
                -> get();
                
            $solutions = Solution::orderBy("id", "desc")
                -> where(function($q) use($search, $users){
                    $q -> where("name", "like", "%" . $search . "%");
                    $q -> orWhereIn("user_id", $users);
                    $q -> orWhereIn("problem_id", $problems);
                })
                -> paginate(5);
        }

        return view("admin.solution.getAdminSolution", [
            "solutions" => $solutions,
        ]);
    }

    public function update(Request $request){
        $defaultType = Solution::where("id", $request -> updateSolutionId)
            -> value("type");
        $validator = Validator::make ( $request->all(),[
            'updateSolutionName' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            $solutions = Solution::where("id", $request -> updateSolutionId)
                            -> update([
                                "name" => $request -> updateSolutionName,
                                "problem_id" => $request -> updateSolutionProblemId,
                                "solution_type_id" => $request -> updateSolutionTypeId,
                                "type" => $request -> updateSolutionType,
                                "state" => $request -> updateSolutionState,
                            ]);

            if($request -> updateSolutionType == 0){
                if($request->hasFile('updateSolutionFile')){
                    
                    $validator = Validator::make ( $request->all(),[
                        'updateSolutionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                    ]);
                    if($validator->fails()){
                        return $this->sendError('Validation Error.', $validator->errors());       
                    }
                    $file = time().'.'.$request -> updateSolutionFile -> extension();
                    $request -> updateSolutionFile -> move(public_path('assets-new/solution/'), $file);

                    $mime = mime_content_type(public_path('assets-new/solution/' . $file));
                    if(strstr($mime, "video/")){
                        $type = 1;
                    }else if(strstr($mime, "image/")){
                        $type = 0;
                    }

                    $solutions = Solution::where("id", $request -> updateSolutionId)
                        -> update([
                            "file" => $file,
                            "type" => $type
                        ]);
                }else{
                    $solutions = Solution::where("id", $request -> updateSolutionId)
                        -> update([
                            "type" => 0,
                        ]);
                }

                if($defaultType == 1){
                    $solutions = Solution::where("id", $request -> updateSolutionId)
                        -> update([
                            "type" => 1,
                        ]);
                }


            }elseif($request -> updateSolutionType == 2){
                $request -> validate([
                    'updateSolutionFileLink' => 'required|url',
                ]);

               $solutions =  Solution::where("id", $request -> updateSolutionId)
                            -> update([
                                "type" => $request -> updateSolutionType,
                                "file" => $request -> updateSolutionFileLink,
                            ]);
            }

            $success['solutions'] =  $solutions;
            return $this->sendResponse($success, 'Solution has been updated successfully.');  
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }

    public function delAdminSolution(Request $request){
        Solution::where("id", $request -> id)
            -> delete();

        return back() -> with("success", "Solution has been deleted successfully.");
    }
}
