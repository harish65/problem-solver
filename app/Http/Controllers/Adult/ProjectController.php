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
                $sharedUsers = DB::table('project_shared')
                ->distinct()
                ->pluck('shared_with')  // Get only unique user IDs
                ->toArray();

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
                    $verificationTypes = DB::table('verification_types')->get();    
                    
                    if ($request->is('api/*')) {
                            $success['projects'] = $project;
                            
                            $success['token'] = $request->header('Authorization');
                            return $this->sendResponse($success,'Reviewer Response');
                    }else{

                       
                        return view('adult.project.index', ["project" => $project , 'verificationTypes' => $verificationTypes]);
                    }
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
            if($project){
                $projectshared  = DB::table('project_shared')->where('project_id', $request->input('id'))->delete();
            }
             
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
                return $this->sendError($success,  'Project can not deleted.');
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
        
        // if($projectUsers->count() == 0 ){
        //     return redirect()->route('adult.dashboard')->with('error', 'No user found for project sharing!');
        // }
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

            // $checkVerificatonDependancy = $this->VerificationDependancy($request , $project_id);
            
        // if($update){

            // $editable_project = (isset($request->editable_project) && $request->editable_project == 1) ? '1' : '0';
                $insertRecord =  DB::table('project_shared')->insert([
                                    'project_id'        => $project_id, 
                                    'shared_with'       => $user->id,
                                    'editable_project'  => ($request->project_sharing_mode == 1) ? '1' : '0',
                                    'editable_problem'  => ($request->editable_problem == 1) ? '1' : '0',
                                    'editable_solution' => ($request->editable_solution == 1) ? '1' : '0',
                                    'editable_solution_func'    => ($request->editable_solution_func == 1) ? '1' : '0',
                                    'editable_verification'     => ($request->editable_verification == 1) ? '1' : '0',
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


    public function viewPermissions($user_id , $project_id){
        $user_id = Crypt::decrypt($user_id);
        $project_id = Crypt::decrypt($project_id);
        $data =  \App\Models\ProjectShared::with('shareduser','projectDetails')->where('project_id' , $project_id)->where('shared_with' ,  $user_id)->first();
           
        return view('adult.project.viewpermissions', ['user_id' => $user_id , 'project_id' => $project_id , 'data' => $data]);
    }

    public function StopshareProject(Request $request){
                try{

                     $update =  DB::table('project_shared')->where(['id' => $request->id , 'shared_with'=>$request->shared_with])->update([$request->field => $request->value]);
                     if($update){
                        $success['success'] =  true;
                        return $this->sendResponse($success, 'Action perofrmed successfully.');
                     }else{
                        $success['success'] =  false;
                        return $this->sendError($success, 'Action can not performed.');
                     }
                     
                }catch(\Exception $e){
                    return $this->sendError('Error.', ['error'=> $e->getMessage()]);
                }
    }
   
}
