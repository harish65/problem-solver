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
use App\Models\SolutionFunction;

class ApiController extends BaseController
{
    //Add / Edit problem
    public function storeProblem(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "category_id" => "required",
            "project_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $projectHasProblem = DB::table("problems")
                ->where("project_id", "=", $request->project_id)
                ->first();
            if (isset($projectHasProblem->id) && $request->id == null) {
                return $this->sendError("Error.", [
                    "error" => "Project already have problem!",
                ]);
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
                        'actual_problrm_name'=> $request->actual_problrm_name,
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
                        'actual_problrm_name'=> $request->actual_problrm_name,
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
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage() , 'message' => 'Project id is not exist']);
        }
    }
    //Update problem validation questions
    public function updateProblemValidation(Request $request){
      
        $update = DB::table('problems')->where("id" ,$request->id)->update([
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
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage() , 'message' => 'Project id is not exist']);
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
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage() , 'message' => 'Project id is not exist']);
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
        
        try{
            $projectHasSolution = DB::table("solutions")
                ->where(["project_id"=> $request->project_id , "problem_id" => $request->problem_id])
                ->first();
            if (isset($projectHasProblem->id) && $request->id == null) {
                return $this->sendError("Error.", [
                    "error" => "Project already have solution!",
                ]);
            }
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

        }catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage() , 'message' => 'Project id is not exist']);
        }
    }
    public function deleteSolution(Request $request){
        $solution  = Solution::where("id", $request -> id)
            -> delete();
        if($solution){
            $success['solution'] =  $solution;
            return $this->sendResponse($success, 'Solution has been deleted successfully.');
        }else{
            return $this->sendError('Error.', ['error'=> 'Solution can not  deleted.']);
        }
       
    }

    public function updateValidations(Request $request){
        if($request->table_name == 'problems'){
            $update = DB::table('problems')->where("id",'=' ,$request->id)-> update([
                'validation' => $request->validation_first
             ]);
        }else{
            $update = DB::table($request->table_name)->where("id",'=' ,$request->id)-> update([
                'validation_first' => $request->validation_first, 'validation_second' => $request->validation_second
             ]);
        }
        
        if($update){
            return $this->sendResponse('success', 'Validations has been saved successfully.');
        }else{
            return $this->sendError('Error.', ['error'=> 'Validations can not saved.']);
        }
    }



    public function getProblemCategoery(){

        $category  = DB::table('problem_categories')->get();
        $success['category'] =  $category;
        return $this->sendResponse($success, true);
    }

    public function getSolutionType(){

        $solutionType  = DB::table('solution_types')->get();
        $success['solutionType'] =  $solutionType;
        return $this->sendResponse($success, true);
    }

    
///Solution function 

public function getSolutionFunction(Request $request){

        if($request->solution_id){
            $solution = DB::table('solutions')->where('id','=', $request->solution_id)->first();
            $problem = DB::table('problems')->where('id','=', $request->problem_id)->first();
            if(isset($solution->id) && isset($problem->id)){ 
                $solFunctions = DB::table('solution_functions')
                        ->join('problems' , 'solution_functions.problem_id' , 'problems.id')
                        ->join('solutions' , 'solution_functions.solution_id' , 'solutions.id')
                        ->join('solution_function_types' , 'solution_functions.solution_function_type_id' , 'solution_function_types.id')
                        ->select('solution_functions.*' , 'solution_function_types.first_arr', 'solution_function_types.second_arr','solutions.name as solution_name','solutions.file as solution_file','solutions.created_at as solution_created','solutions.type as solution_type',
                                                        'problems.name as problem_name','problems.file as problem_file','problems.project_id','problems.type as problem_type','problems.created_at as problem_created_at')
                        ->where('solution_functions.problem_id','=' ,$request->problem_id )
                        ->where('solution_functions.solution_id','=' ,$request->solution_id )
                        ->first();
                        $success['solFunctions'] =  $solFunctions;
                        $success['problem_id'] = $request->problem_id;
                        $success['solution_id'] = $request->solution_id;
                        $success["token"] = $request->header("Authorization");
                        return $this->sendResponse($success, 'true');                  
                }else{
                    return $this->sendError('Error.', ['error'=> 'Problem must have solution.']);
                }
            }else{
                    return $this->sendError('Error.', ['error'=> 'Solution must be created before solution function.']); 
    }
}

// store solution function
public function storeSolutionFunction(Request $request){
    try{
        // $projectHasSolutionfunct = DB::table("solution_functions")
        //         ->where(["project_id"=> $request->project_id , "problem_id" => $request->problem_id])
        //         ->first();
        //     if (isset($projectHasSolutionfunct->id) && $request->id == null) {
        //         return $this->sendError("Error.", [
        //             "error" => "Project already have solution function!",
        //         ]);
        //     }
            $problem_id = $request->input('problem_id');    
            $project_id = $request->input('project_id'); 
            $solution_id = $request->input('solution_id'); 
                if($request -> solFunctionType == 0){
                    if($request->hasFile('file')){
                        $validator = Validator::make ( $request->all(),[
                            'file' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                        ]);
                        if($validator->fails()){
                            return $this->sendError('Validation Error.', $validator->errors());       
                        }
                        $file = time().'.'.$request -> file -> extension();
                        $request -> file -> move(public_path('assets-new/solFunction/'), $file);

                        $mime = mime_content_type(public_path('assets-new/solFunction/' . $file));
                        if(strstr($mime, "video/")){
                            $type = 1;
                        }else if(strstr($mime, "image/")){
                            $type = 0;
                        }
                        
                      
                        $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->id],[                    
                            'type' => $type,
                            'file' => $file,                    
                            'project_id' => $project_id,
                            'problem_id' => $problem_id,
                            'solution_id' => $solution_id,
                            'user_id' => Auth::user()->id,
                            'name' => $request ->solFunctionName,
                            'solution_function_type_id' => $request -> solFunctionTypeId,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                        
                    }else{
                        $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->id],[
                            
                            'user_id' => Auth::user()->id,                                  
                            'project_id' => $project_id,
                            'solution_id' => $solution_id,
                            'problem_id' => $problem_id,
                            'name' => $request ->solFunctionName,                                
                            'solution_function_type_id' => $request -> solFunctionTypeId,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                    }


                }elseif($request -> solFunctionType == 2){
                            $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->id],[
                                'type' => 2,
                                'user_id' => Auth::user()->id,
                                'file' => $request->link,
                                'project_id' => $project_id,
                                'solution_id' => $solution_id,
                                'problem_id' => $problem_id,
                                'name' => $request ->solFunctionName,
                                'solution_function_type_id' => $request -> solFunctionTypeId,
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                }
            
                if($insert){
                    $solutionfunctionID = DB::table('solution_functions')->select('*')->where('solution_id' , '=' , $solution_id)->first();
                    $parameter = ['solution_id' => $solution_id ,  'problem_id' => $problem_id , 'solution_func_id' => $solutionfunctionID->id  , 'project_id'=>$project_id ];
                    $success['type'] =  $solutionfunctionID;
                    $success['params'] = $params = Crypt::encrypt($parameter);
                    return $this->sendResponse($success, 'Solution Function has been created successfully.');            
                }else{
                    return $this->sendError('Error.', ['error'=> 'Something went wrong.']);
                }
            }catch (\Illuminate\Database\QueryException $e) {
                return $this->sendError("Error.", ["error" => $e->getMessage() , 'message' => 'Project id is not exist']);
            }
    
}


    public function deleteSolutionFunction(Request $request){
        $solutionFunction  = SolutionFunction::where("id", $request -> id)-> delete();
        if($solutionFunction){
            $success['type'] =  $solutionFunction;
            return $this->sendResponse($success, 'Solution Function has been deleted successfully.');  
        }else{
            return $this->sendError('Error.', ['error'=> 'Something wrong please try later!']);
        }
        

    }

    public function updateValidationSolutionFunction(Request $request){       
        $column = ($request->input('name') == 'optradio_firts')   ? 'validation_first' : 'validation_second';     
        $update = DB::table('solution_functions')->where("id",'=' ,$request->input('id'))-> update([
            $column => $request->input('value')
        ]);
        if($update){
            return true;
        }
    }



    public function appDashboard(Request $request){
        $sharedUsers = DB::table('project_shared')
                    ->distinct()
                    ->pluck('shared_with')  // Get only unique user IDs
                    ->toArray();

            // Include the authenticated user in the users array
           
                
                $users = array_merge($sharedUsers, [Auth::user()->id]);
           
            

            $project = DB::table('projects')
                ->leftJoin('project_shared', 'projects.id', '=', 'project_shared.project_id') 
                ->leftJoin('problems', function ($join) use ($users) {  // Use 'use' to pass $users
                    $join->on('projects.id', '=', 'problems.project_id')
                        ->where(function ($query) use ($users) {  // Use 'use' again inside
                            $query->where('problems.user_id', Auth::user()->id)
                                ->orWhereIn('problems.user_id', $users);
                        });
                })
                ->leftJoin('solutions', function ($join) use ($users) { // Use 'use' to pass $users
                    $join->on('projects.id', '=', 'solutions.project_id')
                        ->where(function ($query) use ($users) { // Use 'use' again inside
                            $query->where('solutions.user_id', Auth::user()->id)
                                ->orWhereIn('solutions.user_id', $users);
                        });
                })
                ->select(
                    'projects.id',
                    'projects.name',
                    'projects.user_id',
                    'projects.shared',
                    'projects.created_at',
                    'projects.updated_at',
                    DB::raw('COALESCE(FIRST_VALUE(problems.id) OVER (PARTITION BY projects.id ORDER BY problems.id DESC), NULL) as problem_id'),
                    DB::raw('COALESCE(FIRST_VALUE(problems.name) OVER (PARTITION BY projects.id ORDER BY problems.id DESC), NULL) as problem'),
                    DB::raw('COALESCE(FIRST_VALUE(solutions.name) OVER (PARTITION BY projects.id ORDER BY solutions.id DESC), NULL) as solution_name'),
                    DB::raw('COALESCE(FIRST_VALUE(solutions.id) OVER (PARTITION BY projects.id ORDER BY solutions.id DESC), NULL) as solution_id')
                )
                ->where(function ($query) {
                    $query->where('projects.user_id', Auth::user()->id)
                        ->orWhere('project_shared.shared_with', Auth::user()->id);
                })
                ->groupBy('projects.id', 'projects.name', 'projects.user_id', 'projects.shared', 'projects.created_at', 'projects.updated_at')
                ->orderBy('projects.id', 'desc')
                ->get();
                
                $success['projects'] = $project;
                $success['user'] = Auth::user();
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success,'Reviewer Response');
                    
    }


    
    

}
