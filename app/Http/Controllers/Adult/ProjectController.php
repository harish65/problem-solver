<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Validator;
use DB;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $project = DB::table('projects')
                    ->leftJoin('problems', 'projects.id', '=', 'problems.project_id')
                    ->leftJoin('solutions', 'problems.project_id', '=', 'solutions.project_id')
                    ->leftJoin('project_shared', 'projects.id', '=', 'project_shared.project_id')
                    ->select(
                            'projects.id',
                            'projects.name', // Example: Replace 'name' with actual project columns you need
                            'projects.user_id',
                            'projects.shared',
                            'projects.created_at',
                            'problems.id as problem_id',
                            'problems.name as problem',                            
                                    DB::raw('MIN(problems.id) as problem_id'),
                                    DB::raw('MIN(problems.name) as problem'),
                                    DB::raw('MIN(solutions.name) as solution_name'),
                                    DB::raw('MIN(solutions.id) as solution_id')
                                )
                                ->where(function ($query) {
                                    $query->orWhere('projects.user_id', Auth::user()->id)
                                        ->orWhere('project_shared.shared_with', '=', Auth::user()->id);
                                })
                            ->groupBy('projects.id') 
                            ->orderBy('projects.id', 'DESC')->get();
                    
                    if ($request->is('api/*')) {
                            $success['projects'] = $project;
                            $success['token'] = $request->header('Authorization');
                            return $this->sendResponse($success,'Reviewer Response');
                    }else{
                        return view('adult.project.index', ["project" => $project]);
                    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
                  
            $validator = Validator::make ( $request->all(),[
                'name' => 'required|max:255'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            try{
                
                $insert = DB::table('projects')->updateOrInsert(['id'=> $request->id],
                                            [
                                            'user_id' => Auth::user()->id,
                                            'name'=> $request->name,                       
                                            'created_at' => date('Y-m-d H:i:s'),
                                            ]);
                $success['type'] =  $insert;
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success, 'Project created successfully.');
            }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $data  = $request->all();
           
           
            $project  = DB::table('projects')->where('id', $request->input('id'))->delete();
             
            $problem = DB::table('problems')->where('project_id', $request->input('id'))->first();
            
            if(isset($problem->id)){
                $solution = DB::table('solutions')->where('problem_id', $problem->id)->first();  
                DB::table('problems')->where('project_id',$problem->id)->delete();
                    if(isset($solution->id)){
                        $solution_funct = DB::table('solution_functions')->where('solution_id', $solution->id)->first(); 
                            DB::table('solutions')->where('project_id',$solution->id)->delete();
                            if(isset($solution_funct->id)){
                                DB::table('solution_functions')->where('project_id',$solution_funct->id)->delete();
                            }
                    }
            }           
           
            if($project){                
                $success['success'] =  'true';
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success, 'Project deleted successfully.');  
            }else{
                $success['success'] =  false;
                return $this->sendError($success,  'Project can not deleted13.');
            }           
            
            }catch(\Illuminate\Database\QueryException $e){
                $success['success'] =  false;
                return $this->sendResponse($success, 'Project can not deleted.');  
            }
    }

    public function getUsersForProjectSharing($projectId){
        try{
            $project = DB::table('projects')->where('id', $projectId)->first();
                if($project && $project->shared == 1){
                    $alreadyShared = DB::table('project_shared')->select('shared_with')->where('project_id',$projectId)->get();
                    $users = DB::table('users')->where('id', '!=', Auth::user()->id)->where('role', 2)->whereNotIn('id', $alreadyShared)->get();
                    $success['users'] = $users;
                    return $this->sendResponse($success, 'success');
                }else{
                    $users = DB::table('users')->where('id', '!=', Auth::user()->id)->where('role', 2)->get();
                    $success['users'] = $users;
                    return $this->sendResponse($success, 'Success');
                }
        }catch(\Illuminate\Database\QueryException $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }


    public function shareProject(Request $request){
        echo "<pre>"; print_r($request->all()); exit;
       try{
        $rules = array(
            'user_id'=>'integer|required',
            "project_id" => "integer|required",
            //"project_sharing_mode" => "required"
            
        );
        
        $messsages = array(
                'email.required'=>'The User must be selected',
                'project_id.required'=>'Project must be selected',
                //'project_sharing_mode.required'=>'Project share mode is required'
        );
        $validator = Validator::make($request->all(), $rules, $messsages);
        if ($validator->fails()) {            
            return $this->sendError("Validation Error.", $validator->errors());
        }   
        
        // check user if exist
        $user = User::where('id' , $request->user_id)->first();
       
        if($user){
                $project = DB::table('project_shared')->where('project_id' , $request->project_id)->where('shared_with' ,  $user->id)->first();
                if($project){
                    return $this->sendError("Error.", ['messages'=> 'This project is already assigned to ' .$user->name .'!']);
                }
        }else{
            return $this->sendError("Error.", ['messages'=> 'No record found!']);
        }    
        // if($request->shared_project == 1){
            $update = DB::table('projects')->where('id' , $request->project_id)->update(['shared'=> '1']);
        // }
        
       
        // if($update){

            // $editable_project = (isset($request->editable_project) && $request->editable_project == 1) ? '1' : '0';
                $insertRecord =  DB::table('project_shared')->insert([
                                    'project_id' => $request->project_id, 
                                    'shared_with'=> $user->id,
                                    'editable_project' => ($request->project_sharing_mode == 1) ? '1' : '0',
                                    'editable_problem' => ($request->editable_problem == 1) ? '1' : '0',
                                    'editable_solution' => ($request->editable_solution == 1) ? '1' : '0',
                                    'editable_solution_func' => ($request->editable_solution_func == 1) ? '1' : '0',
                                    'editable_verification' => ($request->editable_verification == 1) ? '1' : '0',
                                    'editable_relationship' => ($request->editable_relationship == 1) ? '1' : '0',
                                    'editable_report' => ($request->editable_report == 1) ? '1' : '0',
                                    'editable_quiz' => ($request->editable_quiz == 1) ? '1' : '0',
                                    'editable_result' => ($request->editable_result == 1) ? '1' : '0',
                    
                ]);

            $success['type'] =  true;
            $success['token'] = $request->header('Authorization');
            return $this->sendResponse($success, 'Project shared successfully.');
        // }
        
       }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
            }
    }
   
}
