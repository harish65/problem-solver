<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Project;
use App\Models\{
    Verification,
    VerificationType,
    TimeVerification,
    PastAndPresentTime
};

class ReportController extends Controller
{
     public function index(){
          //  
          $projects = Project::from('projects as pr')
                         ->select('pr.name', 'pr.id')
                         ->join('entity_usage as eu', 'eu.project_id', '=', 'pr.id')
                         ->where('pr.user_id', Auth::user()->id)
                         ->get();
                                   
          return view('adult.reports.project_report' , compact('projects'));
     }

     public function ProjectUsers($id){
          $id  =  Crypt::decrypt($id);
          $users = Project::getUsers($id);
          return response()->json($users->map(fn ($u) => ['id' => $u->id, 'name' => $u->name])->values());
     }


     public function GetReport(Request $request){
          $data = ReportController::projectData($request);
          // echo '<pre>';print_r($data);die;
          $project_id = $request->project_id ? Crypt::decrypt($request->project_id) : null;
          return response()->json([
                    'success' => true,
                    'html' => view('adult.reports.component.report' , compact('data','project_id'))->render()
                ]);
          
     }
        


     public static function projectData($request){
          $data                    = [];
          $projectId               = $request->project_id ? Crypt::decrypt($request->project_id) : null; 
          $userID                  = $request->user_id;
          $project                 = Project::findOrFail($projectId);
          $data['project']         = $project->name;

          $data['problem']         = $project->problemsForUser($userID)->select('name' , 'validation' , 'id' , 'created_at')->first()->toArray();
               
          $data['solution']        = $project->solutionForUser($userID)->select('name' , 'validation_first','validation_second' , 'created_at')->first()->toArray();
          $data['solution_function']         = $project->solutionFunctionForUser($userID)->select('name' , 'validation_first','validation_second' ,'created_at')->first()->toArray();
          $userID                            = $request->user_id;
          $data['user']                      = $project->projectUser($userID);
          $data ['verification']   =           ReportController::getVerificationPayload($projectId  , $data['problem']['id'] , $userID);
          $data['userID']          = $userID;
     //  echo '<pre>';print_r($data['user']);die;
          
          return $data;
           
             

     }


     public static function getVerificationPayload($problem_id, $project_id , $userID): array{
          
                    $handlers = [
                         1 => fn () =>  
                                              ['voucab'=>\App\Models\VerificationEntity::where("verTypeId","=",1)->where(['project_id'=> $project_id , 'problem_id'=>$problem_id])->get()->toArray()],
                              // Verification::where(["problem_id" => $problem_id , "user_id" => $userID])
                              //       ->where("verification_type_id", "=", 1)
                              //       ->where("problem_id", "=", $problem_id)->get()->toArray(),

                         2 => fn () =>  
                                             ['info'=>\App\Models\VerificationEntity::where("verTypeId","=",2)->where(['project_id'=> $project_id , 'problem_id'=>$problem_id])->get()->toArray()],
                                        // Verification::where(["problem_id" => $problem_id , "user_id" => $userID])
                                        //                ->where("verification_type_id", "=", 2)
                                        //                     ->where("problem_id", "=", $problem_id)->first()->toArray(),

                         3 => fn () => \App\Models\BeforeAndAfter::where('problem_id', $problem_id)
                                                  ->where('project_id', $project_id)
                                                  ->where('user_id', $userID)
                                                  ->first()->toArray(),

                         4 => fn () => 
                                ['sepration_step'=>\App\Models\Customer::select('name')->where('user_id', $userID)
                                                                 ->where('project_id', $project_id)
                                                                 ->get()->toArray()],

                         5 => fn () => ['TimeVerification'=>TimeVerification::where('user_id', $userID)
                                                       ->where('project_id', $project_id)
                                                       ->get()->toArray()],

                         6 => fn () =>  ['PastAndPresentTime'=>PastAndPresentTime::where('problem_id', $problem_id)
                                                                      ->where('project_id', $project_id)
                                                                      ->where('user_id', $userID)
                                                                      ->get()->toArray()],
                         

                         7 => fn () => [
                              'givenSet' => (array) DB::table("principle_identification_main")
                                             ->where("user_id", $userID)
                                             ->where("project_id", $project_id)
                                             ->first(),
                              'entitiesAvailable' =>  DB::table("entity_available")
                                                       ->where("type", 0)
                                                       ->where("user_id", $userID)
                                                       ->where("project_id", $project_id)
                                                       ->get(),
                              'entities' => (array) DB::table("entities")->get(),
                              
                              'content' => (array) DB::table("principle_identification_drived_principle")
                                             ->where("project_id", $project_id)
                                             ->where("user_id", $userID)
                                             ->first(),
                              'mainIdentification' => (array) DB::table("principle_identification_main")
                                                       ->where('user_id', $userID)
                                                       ->where('project_id', $project_id)
                                                       ->first(),
                              'allVarifications' => DB::table("principle_identification")->get()
                         ],

                         8 => fn () => [
                              'transitionPhrase' => DB::table('verification_type_texts')->where('verification_type_id' , 8)->first(),
                              'solutionTimeLocationOne' => DB::table('solution_time_locations')->where("type", 1)->where("project_id", $project_id)->where('user_id' , $userID)->first(),
                              'custommers' => \App\Models\Customer::where('project_id' , $project_id)->get()
                         ],
                         9 => fn () => [
                              'transitionPhrase' => DB::table('verification_type_texts')->where('verification_type_id' , 9)->first(),
                              'solutionTimeLocationTwo' => DB::table('solution_time_locations')->where("type", 2)->where("project_id", $project_id)->where('user_id' , $userID)->first()
                         ],
                         10 => fn () => [
                              'custommers' => \App\Models\Customer::where("project_id", $project_id)->where('user_id' , $userID)->get()->toArray(),
                         ],
                         
                         11 => fn () => [
                              'communications' => \App\Models\PeopleCommunicationFlow::select('people_communication_flow.*' , 'customers.name AS customer_name' )
                                                            ->leftJoin('customers', 'people_communication_flow.customer_id', '=', 'customers.id')
                                                            ->where('people_communication_flow.user_id' , $userID)
                                                            ->where('people_communication_flow.project_id' , $project_id)
                                                            ->where('people_communication_flow.problem_id' , $problem_id)
                                                            ->get()->toArray()
                         ],

                         12 => fn() => [
                              'users' => DB::table('customers')
                                                  ->select('customers.*' , 'people_communication_flow.*')
                                                                 ->leftJoin('people_communication_flow', 'customers.id', '=', 'people_communication_flow.customer_id')
                                                                 ->where('customers.project_id' , $project_id)
                                                                 ->where('customers.user_id' , $userID)
                                                                 ->whereNotNull('people_communication_flow.comment')
                                                                 ->get()
                         ],

                         13 => fn() => [
                              'partition_approach' => \App\Models\PartitionAproach::where('user_id' , $userID)->where('project_id' , $project_id)->get()->toArray()
                         ],
                         14 => fn() => [
                              'allVarifications' => DB::table('principle_identification')->get(),
                              'content' => DB::table('principle_identification_main')->where('project_id' , $project_id)->where('problem_id' , $problem_id)->where('user_id' , $userID)->first(),

                         ],
                         15 => fn() => [
                              'problemDevelopment' => DB::table('problem_development')->where('project_id' , $project_id)->where('user_id' , $userID)->get()
                         ],
                         16 => fn() => [
                              
                              'problemDevelopment' => 	\App\Models\ProblemDevelopment::select('problem_development.*' , 'error_correction.compensator' ,'error_correction.compensator_date' , 'error_correction.id as error_correction_id' )
                                                  ->leftJoin('error_correction', 'problem_development.id', '=', 'error_correction.error_id')
                                                  ->where('problem_development.project_id' , $project_id)->where('problem_development.user_id' , $userID)
                                                  ->get()->toArray(),
                              'feedBack' => \App\Models\FeedbackIdentification::select('feedback_identifications.*' , 'problem_development.error_name' )
                                             ->leftJoin('problem_development', 'feedback_identifications.error_id', '=', 'problem_development.id')
                                             ->where('feedback_identifications.user_id' , $userID)
                                             ->where('feedback_identifications.project_id' , $project_id)
                                             ->get()->toArray(),
                              'errorcorrection' => ReportController::getErrorCorrection($userID , $project_id)
                         ],
                         17 => fn() => [
                              'functionAud'  => DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->first()
                         ],
                         18 => fn() => [
                              'people' => db::table('function_belong_to_people')->select('function_belong_to_people.*' , 'customers.name' )
                                        ->leftJoin('customers', 'function_belong_to_people.customer_id', '=', 'customers.id')
                                        ->where('function_belong_to_people.problem_id' , $problem_id)
                                        ->where('function_belong_to_people.project_id' , $project_id)->where('function_belong_to_people.user_id' , $userID)->get()->toArray(),
                            'functionAud'        => DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->first(),
                            'functionApplied'    => DB::table('function_sub_people')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->where('verification_type' , 18)->first()
                            
                         ],

                         19 => fn() => [
                              'people' => db::table('function_belong_to_people')->select('function_belong_to_people.*' , 'customers.name' )
                                            ->leftJoin('customers', 'function_belong_to_people.customer_id', '=', 'customers.id')
                                            ->where('function_belong_to_people.problem_id' , $problem_id)->where('function_belong_to_people.project_id' , $project_id)->where('function_belong_to_people.user_id' , $userID)->get(),
                                
                              'functionApplied'  => DB::table('function_sub_people')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->where('verification_type' , 19)->first()
                            
                         ],
                         20 => fn() => [
                              'problemPart' => DB::table("average_approaches") ->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->first(),
                              'countPartionAproach' => DB::table("partition_approach") ->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->get()->count()
                            
                         ],
                         21 => fn() => [
                              'voiceApproach' => DB::table("passive_voice")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->first()
                         ],
                         22 => fn() => [
                              'problemreplaced' => DB::table("replace_problem_by_problem")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , $userID)->first()
                         ],
                         23 => fn() => [
                               'entities' => DB::table("entity_available")
                                                            ->where("type", "=", 0)
                                                            ->where("user_id", "=", $userID)
                                                            ->where("project_id", $project_id)
                                                        ->get(),

                                                'resources' => DB::table("resource_management")
                                                            ->where("user_id", "=", $userID)
                                                            ->where("project_id", $project_id)
                                                        ->first(),
                                                'entity_used' => DB::table("entity_usage")
                                                        ->where("user_id", "=", $userID)
                                                        ->where("project_id", $project_id)
                                                    ->first()
                         ],
                         24 => fn() => [
                              'entitiestbl' => DB::table("entities")->get(),
                              'entity_used' => DB::table("entity_usage")->where("user_id", "=", $userID)->where("project_id", $project_id)->first(),
                              'principle_identifications' => DB::table("principle_identification_main")->where('user_id' , $userID)->where('project_id' , $project_id)->first(),
                              'entities' => DB::table("entity_available")
                                                            ->where("type", "=", 0)
                                                            ->where("user_id", "=", $userID)
                                                            ->where("project_id", $project_id)
                                                        ->get()
                         ],
                         25 => fn() => [
                              'functionOfPeople' => DB::table("function_of_people_explanations")->where("project_id", "=", $project_id)->where('user_id' , $userID)->first()
                         ],
                         26 => fn() => [
                              'entiesBehind' => DB::table('visibility_entity_behind_explanation')->where('user_id' ,  $userID)->where('project_id',$project_id)->get()
                         ],
                         27 => fn() => [
                              'principle_identification' => DB::table('principle_identification')->get(),
                              'principle_identification_usage' => DB::table(
                                                                    "principle_identification_main"
                                                                )->where('user_id' , $userID)->where('project_id' , $project_id)->first(),
                              'mother_nature' => DB::table('mother_nature')->where('user_id' , $userID)->where('project_id' , $project_id)->first()
                              ],
                         28 => fn() => [
                              'mevsyou' => DB::table('me_vs_you')->where('user_id' , $userID)->where('project_id' , $project_id)->first()
                         ],
                         29 => fn() => [
                              'taking_ad'  => DB::table('taking_advantage')->where('user_id' , $userID)->where('project_id' , $project_id)->first()
                         ],
                         30 => fn() => [
                              'users' => DB::table("people_outside_project")->where(["project_id"=> $project_id , 'user_id'=> $userID])->get(),
                              'custommers' => DB::table("customers")->where("project_id", "=", $project_id)->get()
                         ],
                         31 => fn() => [
                              'problrmAtLocatios'  => DB::table('problrm_at_location_explantion')->where('user_id' , $userID)->where('project_id' , $project_id)->first()
                         ],

                         // Add closures from case 8 to 31 here...

                         32 => fn () => DB::table('function_at_locations')
                                        ->where('user_id', $userID)
                                        ->where('project_id', $project_id)
                                        ->first(),
                    ];

                  $verificationPayload = [];

                    foreach (range(1, 32) as $type) {
                    // Run the handler and cast result to array safely
                    $data = isset($handlers[$type]) ? $handlers[$type]() : null;

                    // Convert object to array or keep as null
                    $dataArray = is_object($data) ? (array) $data : ($data ?? []);

                    // Add 'validations' key
                    $dataArray['validations'] = ReportController::getValidations($type, $problem_id, $project_id, $userID);

                    // Store it
                    $verificationPayload[$type] = $dataArray;
                    }
                    
                    return $verificationPayload;
     }


     public static function getValidations($type , $problem_id, $project_id, $userID){
         $validation  = Verification::where(["problem_id" => $problem_id])
                                            ->where("verification_type_id", "=", $type)
                                            ->where("user_id", "=", $userID)
                                            ->pluck('validations')
                                            ->first();
                                            if($validation){
                                                  return $validation = json_decode($validation, true);
                                             }

     }



     public static function getErrorCorrection($user_id , $project_id){
          $problemDevelopment = DB::table('problem_development')->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
          $compensators = DB::table('error_correction')->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
          $feedBack = DB::table('feedback_identifications')->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
          $error_correction_type = db::table('error_correction_type')->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
        
             $errors = []; 
             $compensator = [];  
        foreach($error_correction_type as $key => $errorcorrection){
            $errorcorrection->error =  json_decode($errorcorrection->error);
            $array_keys_val =  array_values($errorcorrection->error);
            $pd = DB::table('problem_development')->whereIn('id' , $errorcorrection->error)->get(); 
            //Error 
            if($pd){
                $index= 0;
                foreach($pd as $keys =>$pds){
                    $errors[$index]['id'] = $errorcorrection->id;
                    $errors[$index]['error_id'] = $pds->id;
                    $errors[$index]['feedback'] = $errorcorrection->feedback;
                    $errors[$index]['feedback_applied'] = $errorcorrection->feedback_applied;
                    $errors[$index]['error_name'] = $pds->error_name;
                    $index++;
                }
                
            }
            
            //compensator
            $errorcorrection->compensator =  json_decode($errorcorrection->compensator);
            $compensator_ids = DB::table('error_correction')->whereIn('id' , $errorcorrection->compensator)->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
            if($compensator_ids){
                $index_ = 0;
                foreach($compensator_ids as $keys => $compensator_id){
                    $compensator[$index_]['id'] = $compensator_id->id;
                    $compensator[$index_]['compensator'] = $compensator_id->compensator;
                    $compensator[$index_]['feedback'] = $errorcorrection->feedback;
                    $compensator[$index_]['feedback_applied'] = $errorcorrection->feedback_applied;
                    // $compensator[$index_]['error_name'] = $errorcorrection->error_name;
                    $index_++;
                }
                
            }
                
        }        

        // echo '<pre>';print_r($errors);die;
        
        $errorcorrections = DB::table('error_correction_type')->where('user_id' , $user_id)->where('project_id' , $project_id)->get();
        $data = array('errors'=> $errors , 'compensator'=> $compensator  , 'errorcorrections' => $errorcorrections );
        return $data;
     }



}
