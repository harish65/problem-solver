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
use Redirect;
use Session;
class SolutionFunctionController extends BaseController
{
    //solution function
    public function index($params = null){
        $params = Crypt::decrypt($params);         
        $problem_id = $params['problem_id'];
            $solution_id = DB::table('solutions')
                    ->join('problems' , 'solutions.problem_id' , '=' , 'problems.id')
                    ->select('solutions.*' , 'problems.name as problem_name')
                    ->where('solutions.problem_id', $problem_id)->first();
            if(!isset($solution_id->id)){
    
                return Redirect::back()->withErrors(['msg' => 'Solution Function must have solution identified.' , 'error' => 'Solution not identified']);
            }        
            $solutionID = $solution_id->id;
            $solutionName =  $solution_id->name;
            $solutionProblemName =  $solution_id->problem_name;
            $project_id =  $solution_id->project_id;        
          

            $solFunctions = DB::table('solution_functions')
                        ->join('problems' , 'solution_functions.problem_id' , 'problems.id')
                        ->join('solutions' , 'solution_functions.solution_id' , 'solutions.id')
                        ->join('solution_function_types' , 'solution_functions.solution_function_type_id' , 'solution_function_types.id')
                        ->select('solution_functions.*' , 'solution_function_types.first_arr', 'solution_function_types.second_arr','solutions.name as solution_name','solutions.file as solution_file','solutions.created_at as solution_created','solutions.type as solution_type',
                                                         'problems.name as problem_name','problems.file as problem_file','problems.project_id','problems.type as problem_type','problems.created_at as problem_created_at')
                        ->where('solution_functions.problem_id','=' ,$problem_id )
                        ->where('solution_functions.solution_id','=' ,$solutionID )
                        ->first();
           
                return view("adult.solFunction.solutionfunction", [
                            "solFunctions" => $solFunctions,
                            "solutionName" => $solutionName,
                            "solutionProblemName" => $solutionProblemName,
                            'project_id' => $project_id,
                            'problem_id' => $problem_id,
                            'solution_id' => $solutionID,
                        ]);
               
        
    }


   
    public function store(Request $request){

        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make ( $request->all(),[
            'updateSolFunctionName' => 'required|max:255',
            // "updateSolFunctionSolutionId" => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
                $problem_id = Crypt::decrypt($request->input('problem_id'));    
                $project_id = Crypt::decrypt($request->input('project_id')); 
                $solution_id = Crypt::decrypt($request->input('solution_id'));      
                    
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
                            
                          
                            $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->updateSolFunctionId],[                    
                                'type' => $type,
                                'file' => $file,                    
                                'project_id' => $project_id,
                                'problem_id' => $problem_id,
                                'solution_id' => $solution_id,
                                'user_id' => Auth::user()->id,
                                'name' => $request ->updateSolFunctionName,
                                'solution_function_type_id' => $request -> updateSolFunctionTypeId,
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                            
                        }else{
                            $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->updateSolFunctionId],[
                                'user_id' => Auth::user()->id,                                  
                                'project_id' => $project_id,
                                'solution_id' => $solution_id,
                                'problem_id' => $problem_id,
                                'name' => $request ->updateSolFunctionName,                                
                                'solution_function_type_id' => $request -> updateSolFunctionTypeId,
                                'created_at' => date('Y-m-d h:i:s')
                            ]);
                        }


                    }elseif($request -> type == 2){
                                $insert = DB::table('solution_functions')->updateOrInsert(['id'=> $request->updateSolFunctionId],[
                                    'user_id' => Auth::user()->id,
                                    'file' => $request->updateSolFunctionFileLink,
                                    'project_id' => $project_id,
                                    'solution_id' => $solution_id,
                                    'problem_id' => $problem_id,
                                    'name' => $request ->updateSolFunctionName,
                                    // 'state' => 1,
                                    'solution_function_type_id' => $request -> updateSolFunctionTypeId,
                                    'created_at' => date('Y-m-d h:i:s')
                                ]);
                    }
                
                    if($insert){
                        $solutionfunctionID = DB::table('solution_functions')->select('id')->where('solution_id' , '=' , $solution_id)->first();
                        $parameter = ['solution_id' => $solution_id ,  'problem_id' => $problem_id , 'solution_func_id' => $solutionfunctionID->id  , 'project_id'=>$project_id ];
                        $success['type'] =  $solutionfunctionID;
                        $success['params'] = $params = Crypt::encrypt($parameter);
                        return $this->sendResponse($success, 'Solution Function has been created successfully.');            
                    }else{
                        return $this->sendError('Error.', ['error'=> 'Something went wrong.']);
                    }
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

    public function updateValidation(Request $request){
        // echo "<pre>";print_r($request->all());die;
        $column = ($request->input('name') == 'optradio_firts')   ? 'validation_first' : 'validation_second';        
        $update = DB::table('solution_functions')->where("id",'=' ,$request->input('data'))-> update([
            $column => $request->input('value')
        ]);
        if($update){
            return true;
        }
    }
}
