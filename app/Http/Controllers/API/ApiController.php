<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use Auth;
use DB;
use Validator;
use App\Models\User;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;

class ApiController extends BaseController
{
    //Add / Edit problem
    public function storeProblem(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "category_id" => "required",
            "project_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $checkProblemInPrject = DB::table("problems")->where("project_id", "=", $request->project_id)->first();
            if(isset($checkProblemInPrject->id)){
                return $this->sendError("Error.", ["error" => 'Project already have problem.Only one problem a project can have!']);
            }


            if ($request->problemType == 0) {
                $file = null;
                $type = null;
                if ($request->hasFile("file")) {
                    $file = time() . "." . $request->file->extension();
                    $request->file->move(
                        public_path("assets-new/problem/"),
                        $file
                    );
                    $mime = mime_content_type(
                        public_path("assets-new/problem/" . $file)
                    );
                    if (strstr($mime, "video/")) {
                        $type = 1;
                    } elseif (strstr($mime, "image/")) {
                        $type = 0;
                    }
                }

                $insert = DB::table("problems")->updateOrInsert(
                    ["id" => $request->id],
                    [
                        "user_id" => Auth::user()->id,
                        "project_id" => $request->project_id,
                        "category_id" => $request->category_id,
                        "name" => $request->name,
                        "file" => $file,
                        "type" => $type,
                        "created_at" => date("Y-m-d h:i:s"),
                    ]
                );
            } elseif ($request->problemType == 2) {
                $validator = Validator::make($request->all(), [
                    "link" => "required|url",
                    "category_id" => "required",
                ]);
                if ($validator->fails()) {
                    return $this->sendError(
                        "Validation Error.",
                        $validator->errors()
                    );
                }
               
                $insert = DB::table("problems")->updateOrInsert(
                    ["id" => $request->id],
                    [
                        "user_id" => Auth::user()->id,
                        "project_id" => $request->project_id,
                        "category_id" => $request->category_id,
                        "name" => $request->name,
                        "type" => $request->problemType,
                        "file" => $request->link,
                        "created_at" => date("Y-m-d h:i:s"),
                    ]
                );
            }
            $problem = DB::table("problems")
                ->where("project_id", "=", $request->project_id)
                ->first();

            $success["type"] = $insert;
            $success["problem"] = $problem;
            $success["token"] = $request->header("Authorization");
            return $this->sendResponse($success, "Problem saved successfully.");
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()]);
        }
    }
    //Update problem validation questions
    public function updateProblemValidation(Request $request){
        
        $update = DB::table('problems')->where("id",'=' ,$request->id)-> update([
           'validation' => $request->input('value')
        ]);
        if($update){
            $success["Problem"] = $update;
            return $this->sendResponse($success, "Validation updated successfully.");
        }
    }

    public function deleteProblem(Request $request)
    {
        try {
            //check if solution exist
            $solution = DB::table("solutions")
                ->where("problem_id", $request->input("id"))
                ->first();
            if (isset($solution->id)) {
                return $this->sendError("Error.", [
                    "error" =>
                        "Problem can't' be deleted. Used for other purpose.",
                ]);
            }
            
            // $problem = DB::table("problems")
            //     ->where("id", $request->input("id"))
            //     ->delete();
                $problem = Problem::find($request->id);
            if ($problem) {

                if($problem->type != 2){
                    $file_name = $problem->file;
                    $file = public_path("assets-new/problem/".$file_name);
                    unlink($file);
                }
                $problem->delete();
                $success["problem"] = $problem;
                $success["token"] = $request->header("Authorization");
                return $this->sendResponse(
                    $success,
                    "Problem deleted successfully."
                );
            } else {
                return $this->sendError("Error.", [
                    "error" => "Problem not exist!",
                ]);
            }
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()]);
        }
    }

    //Upload user profile pic API
    public function uploadProfilePic(Request $request)
    {
        try {
            $file = time() . "." . $request->avatar->extension();
            $request->avatar->move(public_path("assets-new/avatar/"),$file);            
            $user = User::where("id", "=", $request->id)->update([
                "avatar" => $file,
            ]);
            if ($user) {
                $success["token"] = $request->header("Authorization");
                $success["image"] = $file;
                $success["user"] = Auth::user();
                return $this->sendResponse(
                    $success,
                    "Image Saved successfully."
                );
            }
        } catch (Exception $e) {
            return response()->json(["Error." => $e->getMessage()]);
        }
    }



    

    //Problem API's
    public function getProblem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
            "project_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }       
        $cat = DB::table("problem_categories")->get();
        $problem = DB::table("problems")
            ->where("id", "=", $request->id)
            ->first();

        if ($problem) {
            $success["token"] = $request->header("Authorization");
            $success["problem"] = $problem;
            $success["cat"] = $cat;
            $success["project_id"] = $request->project_id;
            return $this->sendResponse($success, "true");
        } else {
            $success["token"] = $request->header("Authorization");
            $success["problem"] = null;
            return $this->sendResponse($success, "true");
        }
    }


    // /Solution API's//////////////

    public function getSolution(Request $request){
      
        $solution = DB::table('solutions')
                    ->join('problems' , 'solutions.problem_id' , 'problems.id')
                    ->join('solution_types' , 'solutions.solution_type_id' , 'solution_types.id')                    
                    ->select('solutions.*' , 'solution_types.output_slug','problems.name as problem_name', 'problems.project_id','problems.file as problem_file','problems.project_id','problems.type as problem_type','problems.created_at as problem_created_at')
                    ->where('solutions.problem_id','=' ,$request->input('problem_id'))
                    ->first();   

        if ($solution) {
            $solutionTypes = DB::table('solution_types')->get();
            $problems = Problem::orderBy("id", "asc")
                                                    ->where("user_id", Auth::user() -> id)
                                                    ->get();
           
            $success["solution"] = $solution;
            $success["solutionTypes"] = $solutionTypes;
            $success["problems"] = $problems;
            $success["token"] = $request->header("Authorization");
            return $this->sendResponse($success, "true");
        } else {
            $success["token"] = $request->header("Authorization");
            $success["solution"] = null;
            return $this->sendResponse($success, "true");
        }

    }


    public function storeSolution(Request $request){
        
         
        $validator = Validator::make ( $request->all(),[
            'solutionName' => 'required',
            'problem_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        // echo "<pre>";print_r($request->all());die;
        try{
            if(!isset($request->id)){
                $checkSolutionExist = $solution = DB::table('solutions')->where('problem_id','=', $request->problem_id)->first();

                if(isset($checkSolutionExist)){
                    return $this->sendError('Error.', ['error'=> 'Problem have already solution!']);
                }
            }
            if($request -> solutionType == 0){
                $type =  null;
                $file = null;
                if($request->hasFile('solutionFile')){
                    $file = Validator::make($request->all(), [
                                            'solutionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                                        ]);
                    if($validator->fails()){
                        return $this->sendError('Validation Error.', $validator->errors());       
                    }
                            $file = time().'.'.$request -> solutionFile -> extension();
                            $request -> solutionFile -> move(public_path('assets-new/solution/'), $file);                    
                            $mime = mime_content_type(public_path('assets-new/solution/' . $file));
                            if(strstr($mime, "video/")){
                                $type = 1;
                            }else if(strstr($mime, "image/")){
                                $type = 0;
                            }

                $insert = DB::table('solutions')->updateOrInsert(['id'=> $request->id],[
                            'user_id' => Auth::user()->id,
                            'type' => $type,
                            'file' => $file,
                            'project_id' => $request->project_id,
                            'problem_id' => $request->problem_id,
                            'name' => $request -> solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                }else{
                    $insert = DB::table('solutions')->updateOrInsert(['id'=> $request->id],
                        [
                            'user_id' => Auth::user()->id,
                            'project_id' => $request->project_id,                         
                            'problem_id' => $request->problem_id,
                            'name' => $request -> solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                }
                $solution = DB::table('solutions')
                                ->where('problem_id','=', $request->problem_id)->first();
                                $parameter = ['problem_id' => $solution->problem_id , 'project_id' => $solution->project_id,];   
                                $success['solution'] = $solution;                             
                                $success['type'] =  $insert;
                                $success['params'] = $params = Crypt::encrypt($parameter);
                                    return $this->sendResponse($success, 'Solution saved successfully.');
            }elseif($request -> solutionType == 2){
                 $insert = DB::table('solutions')->updateOrInsert(['id'=> $request->id],
                        [
                            'user_id' => Auth::user()->id,
                            'type' =>  2,
                            'file' => $request->link,
                            'problem_id' => $request->problem_id,
                            'name' => $request->solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
            }
            $solution = DB::table('solutions')
                                ->where('problem_id','=', $request->problem_id)->first();
                                $parameter = ['problem_id' => $request->problem_id];  
                                $success['solution'] = $solution;  
                                $success['type'] =  $insert;
                                $success['params'] = $params = Crypt::encrypt($parameter);
                                $success["token"] = $request->header("Authorization");
                return $this->sendResponse($success, 'Solution saved successfully.');

        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }
    public function deleteSolution(Request $request){
        $solution  = Solution::where("id", $request -> id)
            -> delete();
        if($solution){
            $success['solution'] =  $solution;
            return $this->sendResponse($success, 'Solution has been deleted successfully.');
        }else{
            return $this->sendError('Error.', ['error'=> 'Solution can be deleted.']);
        }
       
    }

    public function updateValidation(Request $request){
        $column = ($request->input('name') == 'optradio_firts')   ? 'validation_first' : 'validation_second';
        $update = DB::table('solutions')->where("id",'=' ,$request->input('data'))-> update([
            $column => $request->input('value')
        ]);
        if($update){
            return true;
        }
    }

}
