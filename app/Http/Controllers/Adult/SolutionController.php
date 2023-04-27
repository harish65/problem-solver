<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\Setting;
use Auth;
use DB;
use Validator;

class SolutionController extends BaseController
{

    public function index($params = null){
      
        $params = Crypt::decrypt($params); 
        
        if(isset($params['problem_id'])){
            $problem_id = $params['problem_id'];
        }else{
            $problem_id = $params;
        }
       
        $project = DB::table('problems')->where('id' , '=' , $problem_id)->first();
        $project_id = $project->project_id;
        $problem_name = $project->name;
            
        $solutionTypes = DB::table('solution_types')->get();
        $problems = Problem::orderBy("id", "asc")
            -> where("user_id", Auth::user() -> id)
            -> get();
        $problem = DB::table('solutions')
                    ->join('problems' , 'solutions.problem_id' , 'problems.id')
                    ->join('solution_types' , 'solutions.solution_type_id' , 'solution_types.id')                    
                    ->select('solutions.*' , 'solution_types.output_slug','problems.name as problem_name', 'problems.project_id','problems.file as problem_file','problems.project_id','problems.type as problem_type','problems.created_at as problem_created_at')
                    ->where('solutions.problem_id','=' ,$problem_id )
                    ->first();
        
        return view('adult.solution.index' , compact('problem' ,'problems' , 'problem_id' , 'project_id' , 'problem_name','solutionTypes'));
    }

    public function store(Request $request){
        
         
        $validator = Validator::make ( $request->all(),[
            'solutionName' => 'required',
            'problem_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
           
            $problem_id = Crypt::decrypt($request->input('problem_id'));
            $project_id = Crypt::decrypt($request->input('project_id'));
        //    echo "<pre>";print_r($request->all());die;
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
                            'project_id' => $project_id,
                            'problem_id' => $problem_id,
                            'name' => $request -> solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                }else{
                    $insert = DB::table('solutions')->updateOrInsert(['id'=> $request->id],
                        [
                            'user_id' => Auth::user()->id,
                            'project_id' => $project_id,                            
                            'problem_id' => $problem_id,
                            'name' => $request -> solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                }
                $solution = DB::table('solutions')
                                ->where('problem_id','=', $problem_id)->first();
                                $parameter = ['problem_id' => $solution->problem_id , 'project_id' => $solution->project_id,];                                
                                $success['type'] =  $insert;
                                $success['params'] = $params = Crypt::encrypt($parameter);
                                    return $this->sendResponse($success, 'Solution saved successfully.');
            }elseif($request -> solutionType == 2){
                 $insert = DB::table('solutions')->updateOrInsert(['id'=> $request->id],
                        [
                            'user_id' => Auth::user()->id,
                            'type' =>  2,
                            'file' => $request->solutionLinkType,
                            'problem_id' => $problem_id,
                            'name' => $request->solutionName,
                            'state' => 1,
                            'solution_type_id' => $request -> solution_type_id,
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
            }
            $solution = DB::table('solutions')
                                ->where('problem_id','=', $problem_id)->first();
                                $parameter = ['problem_id' => $problem_id];  
                                
                               
                                $success['type'] =  $insert;
                                $success['params'] = $params = Crypt::encrypt($parameter);
                return $this->sendResponse($success, 'Solution saved successfully.');

        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }



    

    public function delete(Request $request){
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


    public function updateSolution(Request $request)
    {
        dd($request);
        $validator = Validator::make ($request->all() , [
            'id' => 'required' //Id is solution id
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            if($request['file'] == 0){
                if($request['imageFile'] != ''){
                    $file = time().'.'.$request['imageFile'] -> extension();
                    $request['imageFile'] -> move(public_path('assets-new/verification/'), $file);
                    $mime = mime_content_type(public_path('assets-new/verification/' . $file));
                    if(strstr($mime, "video/")){
                        $type = 1;
                    }else if(strstr($mime, "image/")){
                        $type = 0;
                    }
                    $solution = Solution::find($request->id);
                    $solution->name = $request->solutionName;
                    $solution->solution_type_id = $request->solution_type_id;
                    $solution->type = $type;
                    $solution->file = $file;
                    $solution->save();
                if($solution->id){
                    $success['solution_update'] =  $solution;
                    return $this->sendResponse($success, 'Solution updated  successfully.');
                }else{
                    return $this->sendResponse($error, 'Something Wrong.');
                }
            }
        }
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }

    public function deleteSolution(Request $request)
    {
        $validator = Validator::make ($request->all(),[
            'id' =>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{    
            $solId = $request->id;
            $delete = Verification::where('id' , '=' , $solId)->delete();
            if($delete)
            {   
                $success['delete_solution'] =  $delete;
                return $this->sendResponse($success, 'Solution deleted successfully.');
            }else{
                return $this->sendResponse($error, 'Something Wrong.');
            }
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }
}
