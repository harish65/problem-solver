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
        
        $userId  = Auth::user()->id;
        $projects = DB::table('projects')
                            ->leftJoin('project_shared', 'projects.id', '=', 'project_shared.project_id')
                            ->leftJoin('problems', function ($join) use ($userId) {
                                $join->on('projects.id', '=', 'problems.project_id')
                                    ->where(function ($query) use ($userId) {
                                        $query->where('problems.user_id', '=', $userId)
                                            ->orWhereNull('problems.user_id');
                                    });
                            })
                            ->leftJoin('solutions', function ($join) use ($userId) {
                                $join->on('projects.id', '=', 'solutions.project_id')
                                    ->where(function ($query) use ($userId) {
                                        $query->where('solutions.user_id', '=', $userId)
                                            ->orWhereNull('solutions.user_id');
                                    });
                            })
                            ->select(
                                'projects.id',
                                DB::raw('MIN(projects.name) as name'),
                                'projects.user_id',
                                'projects.shared',
                                'projects.created_at',
                                'problems.id as problem_id',
                                'problems.name as problem_name',
                                'solutions.id as solution_id',
                                'solutions.name as solution_name',
                              
                            )
                            ->where(function ($query) use ($userId) {
                                $query->orWhere('projects.user_id', '=', $userId)
                                    ->orWhere('project_shared.shared_with', '=', $userId);
                            })
                            ->groupBy('projects.id', 'projects.user_id', 'projects.shared', 'projects.created_at', 'problems.id', 'solutions.id','solutions.name')
                            ->orderBy('projects.id', 'DESC')
                            ->get();
                    
                    // echo '<pre>';print_r($projects);die;
                    $verificationTypes = DB::table('verification_types')->get();    
                    
                    if ($request->is('api/*')) {
                            $success['projects'] = $projects;
                            $success['verificationTypes'] = $verificationTypes;
                            $success['token'] = $request->header('Authorization');
                            return $this->sendResponse($success,'Reviewer Response');
                    }else{

                        return view('adult.project.index', ["project" => $projects , 'verificationTypes' => $verificationTypes]);
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
                    $alreadyShared = DB::table('project_shared')
                        ->where('project_id', $projectId)
                        ->pluck('shared_with') // Extracts only the 'shared_with' column as an array
                        ->toArray();

                    $users = DB::table('users')
                        ->where('id', '!=', Auth::user()->id)
                        ->where('role', 2)
                        ->whereNotIn('id', $alreadyShared) // Use the array of IDs
                        ->get();
                   return $users;
                }else{
                    $users = DB::table('users')->where('id', '!=', Auth::user()->id)->where('role', 2)->get();
                    return $users;
                }
        }catch(\Illuminate\Database\QueryException $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }
     public function shareProjectGet($project_id  , Request $request){
        
        $projectId = Crypt::decrypt($project_id);       
      
        $verificationTypes = DB::table('verification_types')->get();    
        $projectUsers = $this->getUsersForProjectSharing($projectId);
        
        if($projectUsers->count() == 0 ){
            return redirect()->route('adult.dashboard')->with('error', 'No user found for project sharing!');
        }
        $allreadySharedUsers = DB::table('project_shared')
                    ->join('users', 'project_shared.shared_with', '=', 'users.id')
                    ->where('project_shared.project_id', $projectId)
                    ->select('users.name', 'users.email' , 'project_shared.*')
                    ->get();
      
        if ($request->is('api/*')) {
                $success['project_id'] = $project_id;
                $success['verificationTypes'] = $verificationTypes;
                $success['projectUsers'] = $projectUsers;
                $success['token'] = $request->header('Authorization');
                $success['allreadyShared'] = $allreadyShared;
                return $this->sendResponse($success,'Reviewer Response');
        }else{
            return view('adult.project.shareproject', ["project_id" => $project_id , 'verificationTypes' => $verificationTypes , 'projectUsers'=>$projectUsers , 'allreadySharedUsers'=>$allreadySharedUsers]);
        }
     }

     

    public function shareProject(Request $request){
       
       try{
        $rules = array(
            'user_id'=>'integer|required',
            "project_id" => "required",
            //"project_sharing_mode" => "required"
            
        );
        
        $messsages = array(
                'user_id.required'=>'The User must be selected',
                'project_id.required'=>'Project must be selected',
                //'project_sharing_mode.required'=>'Project share mode is required'
        );
               
            $validator = Validator::make($request->all(), $rules, $messsages);
            if ($validator->fails()) {            
                return $this->sendError("Validation Error.", $validator->errors());
            }   
            
            $project_id = Crypt::decrypt($request->project_id);
            // check user if exist
            $user = User::where('id' , $request->user_id)->first();
        
            if($user){
                    $project = DB::table('project_shared')->where('project_id' , $project_id)->where('shared_with' ,  $user->id)->first();
                    if($project){
                        return $this->sendError("Error.", ['messages'=> 'This project is already assigned to ' .$user->name .'!']);
                    }
            }else{
                return $this->sendError("Error.", ['messages'=> 'No record found!']);
            }    
            // if($request->shared_project == 1){
                $update = DB::table('projects')->where('id' , $project_id)->update(['shared'=> '1']);
            // }
        
            
        // if($update){

            // $editable_project = (isset($request->editable_project) && $request->editable_project == 1) ? '1' : '0';
                $insertRecord =  DB::table('project_shared')->insert([
                                    'project_id' => $project_id, 
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
                                    'vocabulary' => ($request->vocabulary == 1) ? '1' : '0',
                                    'information' => ($request->information == 1) ? '1' : '0',
                                    'before_and_after' => ($request->before_and_after == 1) ? '1' : '0',
                                    'separation_step' => ($request->separation_step == 1) ? '1' : '0',
                                    'time_verification' => ($request->time_verification == 1) ? '1' : '0',
                                    'past_and_present_time' => ($request->past_and_present_time == 1) ? '1' : '0',
                                    'entity_available' => ($request->entity_available == 1) ? '1' : '0',
                                    'solution_time_location1' => ($request->solution_time_location1 == 1) ? '1' : '0',
                                    'solution_time_location2' => ($request->solution_time_location2 == 1) ? '1' : '0',
                                    'people_in_project' => ($request->people_in_project == 1) ? '1' : '0',
                                    'people_and_communication' => ($request->people_and_communication == 1) ? '1' : '0',
                                    'communication_flow' => ($request->communication_flow == 1) ? '1' : '0',
                                    'partition_approach' => ($request->partition_approach == 1) ? '1' : '0',
                                    'principle_identification' => ($request->principle_identification == 1) ? '1' : '0',
                                    'problem_development_from_error_explanation' => ($request->problem_development_from_error_explanation == 1) ? '1' : '0',
                                    'error_correction_approach' => ($request->error_correction_approach == 1) ? '1' : '0',
                                    'function_adjustment' => ($request->function_adjustment == 1) ? '1' : '0',
                                    'function_substitution_and_people' => ($request->function_substitution_and_people == 1) ? '1' : '0',
                                    'functions_belong_to_people_explanation' => ($request->functions_belong_to_people_explanation == 1) ? '1' : '0',
                                    'averaging_approach' => ($request->averaging_approach == 1) ? '1' : '0',
                                    'passive_voice_approach_explanation' => ($request->passive_voice_approach_explanation == 1) ? '1' : '0',
                                    'replace_problem_by_problem' => ($request->replace_problem_by_problem == 1) ? '1' : '0',
                                    'resource_management_consideration' => ($request->resource_management_consideration == 1) ? '1' : '0',
                                    'entity_usage' => ($request->entity_usage == 1) ? '1' : '0',
                                    'function_of_people_explanation' => ($request->function_of_people_explanation == 1) ? '1' : '0',
                                    'visibility_and_entity_behind_explanation' => ($request->visibility_and_entity_behind_explanation == 1) ? '1' : '0',
                                    'mother_nature_existence_explanation' => ($request->mother_nature_existence_explanation == 1) ? '1' : '0',
                                    'me_vs__you_approach' => ($request->me_vs__you_approach_ == 1) ? '1' : '0',
                                    'taking_advantage_on_other' => ($request->taking_advantage_on_other_ == 1) ? '1' : '0',
                                    'people_outside_the_project' => ($request->people_outside_the_project_ == 1) ? '1' : '0',
                                    'problem_and_solution_at_location_explanation' => ($request->problem_and_solution_at_location_explanation == 1) ? '1' : '0',
                                    'function_at_location_explanation' => ($request->function_at_location_explanation == 1) ? '1' : '0',
                    
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
