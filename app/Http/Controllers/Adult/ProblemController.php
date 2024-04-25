<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use Auth;
use DB;
use Validator;

class ProblemController extends BaseController
{
   
    public function index($id = null){
        $params = Crypt::decrypt($id);
        $problemID = $params['problem_id'];
        $projectID = $params['project_id']; 
       
        $cat = DB::table('problem_categories')->get();
        $problemID = Crypt::decrypt($id);
        $problem =  DB::table('problems')->where('id','=',$problemID)->first();
           
        if($problem){
                return view ('adult.problem.problem',compact('problem','cat','projectID'));
            }else{
                $problem = null;
                return view ('adult.problem.problem',compact('problem','cat','projectID'));
        }
        
    }

    
    public function store(Request $request){
       
        $validator = Validator::make ( $request->all(),[
            'updateProblemName' => 'required',
            'category_id' => 'required',
            'project_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            $project_id = Crypt::decrypt($request->input('project_id'));
            if($request -> updateProblemType == 0){
                $file = null;
                $type = null;
                if($request->hasFile('updateProblemFile')){
                    $file = time().'.'.$request -> updateProblemFile -> extension();
                    $request -> updateProblemFile -> move(public_path('assets-new/problem/'), $file);
                    $mime = mime_content_type(public_path('assets-new/problem/' . $file));
                    if(strstr($mime, "video/")){
                        $type = 1;
                    }else if(strstr($mime, "image/")){
                        $type = 0;
                    }
                    $insert = DB::table('problems')->updateOrInsert(['id'=> $request->id],
                    [
                        'user_id' => Auth::user()->id,
                        'project_id' => $project_id,
                        'category_id' => $request ->category_id,
                        'name' => $request -> updateProblemName,
                        'name' => $request -> updateProblemName,
                        'actual_problrm_name' => $request->actual_problrm_name,
                        'file' => $file,
                        'type' => $type,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                }else{
                    $insert = DB::table('problems')->updateOrInsert(['id'=> $request->id],
                    [
                        'user_id' => Auth::user()->id,
                        'project_id' => $project_id,
                        'category_id' => $request ->category_id,
                        'name' => $request -> updateProblemName,
                        'actual_problrm_name' => $request->actual_problrm_name,
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                }
               
            }elseif($request->updateProblemType == 2){
                $validator = Validator::make ( $request->all(),[
                    'updateProblemFileLink' => 'required|url',  
                    'category_id' => 'required',
                ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

            $insert = DB::table('problems')->updateOrInsert(['id'=> $request->id],
                [
                'user_id' => Auth::user()->id,
                'project_id' => $project_id,
                'category_id' => $request ->category_id,
                'name' => $request -> updateProblemName,
                "type" => $request->updateProblemType,
                'file' =>  $request -> updateProblemFileLink,
                'created_at' => date('Y-m-d h:i:s')
                ]);
        }
            $problem = DB::table('problems')
                                            -> where('project_id','=',$project_id)
                                            ->first();
                                    $parameter = ['problem_id'=> $problem->id , 'project_id'=>$project_id];                                
                                    $success['type'] =  $insert;
                                    $success['params'] = $params = Crypt::encrypt($parameter);
            return $this->sendResponse($success, 'Problem saved successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }


    public function updateValidation(Request $request){
        $params = Crypt::decrypt($request->input('data'));
        $problemID = $params['problem_id'];
        $projectID = $params['project_id'];       
        $update = DB::table('problems')->where("id",'=' ,$problemID)->where("project_id",'=' ,$projectID)-> update([
           'validation' => $request->input('value')
        ]);
        if($update){
            return true;
        }
    }

    public function delete(Request $request){
        try{
            //check if solution exist
            $solution  =  DB::table('solutions')->where('problem_id', $request->input('id'))->first();
            if(isset($solution->id)){
                return $this->sendError('Error.', ['error'=> "Problem can't' be deleted. Used for other purpose."]);
            }
            $problem  =  DB::table('problems')->where('id', $request->input('id'))->delete(); 
            if($problem){
                $success['problem'] =  $problem;
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success, 'Problem deleted successfully.');  
            }else{
                return $this->sendError('Error.', ['error'=> 'Problem not exist!']);
            }           
            
            }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
            }
    }
}
