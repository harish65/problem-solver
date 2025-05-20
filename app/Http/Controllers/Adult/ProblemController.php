<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProblemController extends BaseController
{
    
   
    public function index($id = null){
        
        $params = Crypt::decrypt($id); 
        $selectedSingleProblem = false; 
       
        if(is_array($params)){
            $projectID = $params['project_id']; 
            $problem_id  = $params['problem_id'];
            
        }else{
            $selectedSingleProblem = true;
            $projectID   =  DB::table('problems')->where('id' , $params)->pluck('project_id')->first();
            $problem_id  = $params;
        }
        $cat = DB::table('problem_categories')->get();
        $project = DB::table('projects')
                        ->leftjoin('project_shared', 'projects.id', '=', 'project_shared.project_id')
                        ->select('projects.*')
                        ->orderBy("projects.id", "desc")
                        ->where('projects.id' ,$projectID)
                        ->where(function($query){
                                $query->orWhere('projects.user_id' , Auth::user()->id);
                                $query->orWhere('project_shared.shared_with', '=', Auth::user()->id);
                        })
                    ->orderBy('projects.id', 'desc')
                    ->first();
                        
       
            $problem = DB::table('problems')->where(['project_id' => $projectID , 'user_id'=> Auth::user()->id])->first();
            if(is_null($problem) && $problem_id !== null){
                $problem = DB::table('problems')->where('id' , $problem_id)->first();   
            }

            $pageId = 1001;
            $pageType = 'problem';
    //    echo '<pre>';print_r($problem);exit;
    //    
        return view ('adult.problem.problem',compact('problem','cat','projectID' , 'project' ,'problem_id' , 'selectedSingleProblem', 'pageType', 'pageId'));
        
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
