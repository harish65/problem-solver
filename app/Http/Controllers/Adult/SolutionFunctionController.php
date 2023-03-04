<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\SolutionFunction;
use App\Models\Setting;
use Auth;
use Validator;
use DB;

class SolutionFunctionController extends BaseController
{
    //solution function
    public function index($params = null){
        $params = Crypt::decrypt($params);         
        $problem_id = $params['problem_id'];
        if(isset($params['solution_id'])){
            $solution_id = $params['solution_id'];
        }else{
            $solution_id = DB::table('solutions')->select('id')->where('problem_id', $problem_id)->first();
            $solution_id = $solution_id->id;
        }
        // echo"<pre>";print_r();die;
                
            $problems = Problem::orderBy("id", "asc")
                        -> where("user_id", Auth::user() -> id)
                        ->where('id' , $problem_id)
                        -> get();
            $solutions = Solution::orderBy("id", "desc")
                        -> where("user_id", Auth::user() -> id)
                        -> where("problem_id", $params['problem_id'])
                        -> get();

            $solFunctions = DB::table('solution_functions')
                        ->join('problems' , 'solution_functions.problem_id' , 'problems.id')
                        ->join('solutions' , 'solution_functions.solution_id' , 'solutions.id')
                        ->select('solution_functions.*' , 'solutions.name as solution_name','solutions.file as solution_file','solutions.created_at as solution_created','solutions.type as solution_type',
                                                         'problems.name as problem_name','problems.file as problem_file','problems.project_id','problems.type as problem_type','problems.created_at as problem_created_at')
                        ->where('solution_functions.problem_id','=' ,$problem_id )
                        ->where('solution_functions.solution_id','=' ,$solution_id )
                        ->first();
            // echo"<pre>";print_r($solFunctions);die;
            return view("adult.solFunction.solutionfunction", [
                        "solFunctions" => $solFunctions,
                        "problems" => $problems,
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

    public function store(Request $request){

        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make ( $request->all(),[
            'updateSolFunctionName' => 'required|max:255',
            "updateSolFunctionSolutionId" => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
try{
        $solFunction = new SolutionFunction();
        $solFunction -> user_id = Auth::user() -> id;
        $solFunction -> name = $request -> updateSolFunctionName;
        $solFunction -> problem_id = $request -> updateSolFunctionProblemId;
        $solFunction -> solution_id = $request -> updateSolFunctionSolutionId;
        $solFunction -> solution_function_type_id = $request -> updateSolFunctionTypeId;

        if($request -> type == 0){
            if($request->hasFile('updateSolFunctionFile')){
                $validator = Validator::make ( $request->all(),[
                    'updateSolFunctionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                $file = time().'.'.$request -> updateSolFunctionFile -> extension();
                $request -> updateSolFunctionFile -> move(public_path('assets-new/solFunction/'), $file);

                $mime = mime_content_type(public_path('assets-new/solFunction/' . $file));
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
        if($solFunction->id){
            $parameter = ['solution_function' => $solFunction->id,'solution_id' => $request->updateSolFunctionSolutionId ,  'problem_id' => $request->updateSolFunctionProblemId];
            $success['type'] =  $solFunction;
            $success['params'] = $params = Crypt::encrypt($parameter);
            return $this->sendResponse($success, 'Solution Function has been created successfully.');            
        }else{
            return $this->sendError('Error.', ['error'=> 'Something went wrong.']);
        }
    }catch(Exception $e){
        return $this->sendError('Error.', ['error'=> $e->getMessage()]);
    }
        
    }

    public function update(Request $request){
       
        $defaultType = SolutionFunction::where("id", $request -> updateSolFunctionId)
            -> value("type");

            $validator = Validator::make ( $request->all(),[
                            'updateSolFunctionName' => 'required|max:255',
                            'updateSolFunctionSolutionId' => 'required|max:255',
                        ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

        try{    
            
                if($request -> updateSolFunctionType == 0){
                    if($request->hasFile('updateSolFunctionFile')){
                            $validator = Validator::make ( $request->all(),[
                                'updateSolFunctionFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                            ]);

                            if($validator->fails()){
                                return $this->sendError('Validation Error.', $validator->errors());       
                            }
                            $file = time().'.'.$request -> updateSolFunctionFile -> extension();
                            $request -> updateSolFunctionFile -> move(public_path('assets-new/solFunction/'), $file);

                            $mime = mime_content_type(public_path('assets-new/solFunction/' . $file));
                            if(strstr($mime, "video/")){
                                $type = 1;
                            }else if(strstr($mime, "image/")){
                                $type = 0;
                            }
                            $solution = SolutionFunction::where("id", $request -> updateSolFunctionId)
                                        -> update([
                                            "name" => $request -> updateSolFunctionName,
                                            "problem_id" => $request -> updateSolFunctionProblemId,
                                            "solution_id" => $request -> updateSolFunctionSolutionId,
                                            "type" => $request -> updateSolFunctionType,
                                            "solution_function_type_id" => $request -> updateSolFunctionTypeId,
                                            "user_id" => Auth::user() -> id,
                                            "file" => $file,
                                            "type" => $type
                                        ]);

                        }else{
                            $solution = SolutionFunction::where("id", $request -> updateSolFunctionId)
                                        -> update([
                                            "name" => $request -> updateSolFunctionName,
                                            "problem_id" => $request -> updateSolFunctionProblemId,
                                            "solution_id" => $request -> updateSolFunctionSolutionId,
                                            "type" => $request -> updateSolFunctionType,
                                            "solution_function_type_id" => $request -> updateSolFunctionTypeId,
                                            "user_id" => Auth::user() -> id,
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

            $parameter = ['solution_function' => $request -> updateSolFunctionId,'solution_id' => $request->updateSolFunctionSolutionId ,  'problem_id' => $request->updateSolFunctionProblemId];
            $success['type'] =  $solution;
            $success['params'] = $params = Crypt::encrypt($parameter);
            return $this->sendResponse($success, 'Solution Function has been created successfully.');  
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
        
    }

    public function delete(Request $request){
        $solutionFunction  = SolutionFunction::where("id", $request -> id)-> delete();
        if($solutionFunction){
            $success['type'] =  $solutionFunction;
            return $this->sendResponse($success, 'Solution Function has been deleted successfully.');  
        }else{
            return $this->sendError('Error.', ['error'=> 'Something wrong please try later!']);
        }
        
    }
}
