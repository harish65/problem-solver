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
use App\Models\VerificationType;
use App\Models\Verification;
use App\Models\VerificationEntity;
use App\Models\VerificationTypeText;

use App\Models\ErrorCorrection;
use App\Models\BeforeAndAfter;
use App\Models\PastAndPresentTime;
use App\Models\Customer;
use App\Models\TimeVerification;
use App\Models\PrincipleIdentificationMain;
use App\Models\AverageApproach;

class ApiVerificationController extends BaseController
{


    // Get All verifications
    public function GetAllVerifications(Request $request){
        $verifications = $this->allVerifications();
        
       
           if ($verifications) {
           
            $success["verifications"] = $verifications;
            $success["token"] = $request->header("Authorization");
            return $this->sendResponse($success, "true");
        } else {
            $success["token"] = $request->header("Authorization");
            $success["solution"] = null;
            return $this->sendResponse($success, "true");
        }        
    }

    // get Single verification

    public function GetSingleVerification(Request $request){
        $data = $request->all();
        $problem_id = $data["problem_id"];
        $project_id = $data["project_id"];
        $type = $data["verification_type_id"];
        $problem = Problem::where("project_id", "=", $project_id)->where('user_id' , Auth::user()->id)->first();
        $Solution_function = SolutionFunction::where("problem_id",$problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
        $solution = Solution::where("problem_id", "=", $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
        $verifiationTypeText = VerificationTypeText::where( "verification_type_id",$type)->get();
        $entity = VerificationEntity::where("verTypeId","=",$type)->where('project_id', $project_id)->get();
        $validation_data = Verification::
                                select('id','validations')
                                ->where("problem_id", "=", $problem_id)    
                                ->where("verification_type_id", "=", $type)
                                ->where("user_id", Auth::user()->id)
                                // ->pluck("validations")
                                ->first();    
        
switch ($type) {
            case 1:
               
            $verification = Verification::where("problem_id", "=", $problem_id)
                    ->where("verification_type_id", "=", $type)
                    ->where("user_id", Auth::user()->id)
                    ->first();    
                $transitionPhrase = DB::table('verification_type_texts')->where('verification_type_id' , 1)->first();
                 $success = [
                    "verification" => $verification,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function,
                    "verificationTypeText" => $verifiationTypeText,
                    "entity" => $entity,'transitionPhrase' => $transitionPhrase , 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");

                break;
            case 2:
                $verification = Verification::where("problem_id", "=", $problem_id)
                    ->where("verification_type_id", "=", $type)
                    ->where("user_id", Auth::user()->id)
                    ->first();    
                $transitionPhrase = DB::table('verification_type_texts')->where('verification_type_id' , 2)->first();
                $success =  [
                    "verification" => $verification,
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function,
                    "verificationTypeText" => $verifiationTypeText,
                    "entity" => $entity,'transitionPhrase' => $transitionPhrase, 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");
                break;
            case 3:
                $beforeAfter =  DB::table('before_and_after')
                                ->where('problem_id' , $problem->id)
                                ->where('project_id' , $project_id)
                                ->where('user_id' , Auth::user()->id)
                                ->first();
                
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function,
                    "verificationTypeText" => $verifiationTypeText,
                    "beforeAfter" => $beforeAfter, 'validation_data'=>$validation_data
                    ];
                    return $this->sendResponse($success, "true");
                break;
            case 4:
                $steps = DB::table('sepration_steps')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                $custommers = DB::table("customers")->where("project_id", "=", $project_id)->get();
                $success =  [
                        "project_id" => $project_id,
                        "problem" => $problem,
                        "solution" => $solution,
                        "Solution_function" => $Solution_function,
                        "verificationTypeText" => $verifiationTypeText,
                        "custommers" => $custommers, 
                        "steps" => $steps, 'validation_data'=>$validation_data
                    ];
                    return $this->sendResponse($success, "true");
                break;
            case 5:
                $timeVerifications =  TimeVerification::where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function,
                    "timeVerifications" => $timeVerifications,  'validation_data'=>$validation_data
                    
                ];
                return $this->sendResponse($success, "true");
                break;
            case 6:
                // die();
                $allVarifications = Verification::where(
                    "verification_type_id",
                    "=",
                    6
                )->get();

                $pastAndPresentTime = PastAndPresentTime::where('problem_id' , $problem_id)
                                                        ->where('project_id' , $project_id)
                                                        ->where('user_id' , Auth::user()->id)->get();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function,
                    "pastAndPresentTime" => $pastAndPresentTime, 'validation_data'=>$validation_data
                    
                ];
                return $this->sendResponse($success, "true");
                
                break;
            case 7:
               
                $givenSet = DB::table("principle_identification_main")
                                    ->where("user_id", Auth::user()->id)
                                    ->where("project_id", $project_id)
                                    ->first();
                   
                $entitiesAvailable = DB::table("entity_available")
                                        ->where("type", "=", 0)
                                        ->where("user_id" , Auth::user()->id)
                                        ->where('project_id' , $project_id)
                                        ->get();
                $entities = DB::table("entities")->get();
                $principle_identification = DB::table("principle_identification")->get();

                $content =     DB::table("principle_identification_drived_principle")->where("project_id", $project_id)->where('user_id' , Auth::user()->id)->first();
                $principle_identifications = DB::table(
                    "principle_identification_main"
                )->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();

                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "givenSet" => $givenSet,
                    "entities" => $entities,
                    "entitiesAvailable" => $entitiesAvailable,                        
                    "content" => $content , 
                    'principle_identifications' => $principle_identifications, 'validation_data'=>$validation_data
                    
                ];
                return $this->sendResponse($success, "true");
                
                break;
            case 8:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                
                $transitionPhrase = DB::table('verification_type_texts')->where('verification_type_id' , 8)->first();
                $solutionTimeLocationOne = DB::table('solution_time_locations')->where("type", 1)->where("project_id", $project_id)->where('user_id' , Auth::user()->id)->first();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "custommers" => $custommers,
                    "transitionPhrase" => $transitionPhrase,
                    "solutionTimeLocationOne" => $solutionTimeLocationOne, 'validation_data'=>$validation_data
                    
                ];
                return $this->sendResponse($success, "true");
                
                break;
            case 9:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
               
                $transitionPhrase = DB::table('verification_type_texts')->where('verification_type_id' , 9)->first();
                $solutionTimeLocationTwo = DB::table('solution_time_locations')->where("type", 2)->where("project_id", $project_id)->where('user_id' , Auth::user()->id)->first();;
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "custommers" => $custommers,
                    "transitionPhrase" => $transitionPhrase,
                    "solutionTimeLocationTwo" => $solutionTimeLocationTwo, 'validation_data'=>$validation_data
                    
                ];
                return $this->sendResponse($success, "true");
                break;
            case 10:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                    $success =  [
                        "project_id" => $project_id,
                        "problem" => $problem,
                        "solution" => $solution,
                        "Solution_function" => $Solution_function, 
                        "custommers" => $custommers  
                    ];
                    return $this->sendResponse($success, "true");
                break;
            case 11:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                
                $communications = DB::table('people_communication_flow')
                        ->select('people_communication_flow.*' , 'customers.name AS customer_name' )
                        ->leftJoin('customers', 'people_communication_flow.customer_id', '=', 'customers.id')
                        ->where('people_communication_flow.user_id' , Auth::user()->id)
                        ->where('people_communication_flow.project_id' , $project_id)
                        ->where('people_communication_flow.problem_id' , $problem_id)
                        ->get();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "custommers" => $custommers,
                    "communications" => $communications , 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");
          
                
                break;
            case 12:
                $customersFrom = DB::table('customers')
                        ->select('customers.*' , 'people_communication_flow.*')
                        ->leftJoin('people_communication_flow', 'customers.id', '=', 'people_communication_flow.customer_id')
                        ->where('customers.project_id' , $project_id)
                        ->whereNotNull('people_communication_flow.comment')
                        ->get();
                $customersTo = DB::table("customers")
                        ->where("project_id", "=", $project_id)
                        ->get();

                $success =  [
                            "project_id" => $project_id,
                            "problem" => $problem,
                            "solution" => $solution,
                            "Solution_function" => $Solution_function, 
                            "customersFrom" => $customersFrom,
                            "customersTo" => $customersTo , 'validation_data'=>$validation_data
                        ];
                        return $this->sendResponse($success, "true");        
                break;
            case 13:
                $entities = DB::table("partition_approach")->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "entities" => $entities, 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");     
                break;
            case 14:
            
                $principle_identification = DB::table(
                    "principle_identification"
                )->get();
                $customers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                $content =  DB::table('principle_identification_main')->where('project_id' , $project_id)->where('problem_id' , $problem_id)->where('user_id' , Auth::user()->id)->first();
                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "content" => $content,
                    "customers" => $customers,
                    "principle_identification" => $principle_identification, 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");    
                
                break;

            case 15:
                $principle_identification = DB::table(
                    "principle_identification"
                )->get();
                $customers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->first();
                $problemDevelopment = DB::table('problem_development')->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->get();

                $success =  [
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "Solution_function" => $Solution_function, 
                    "customers" => $customers,
                    "principle_identification" => $principle_identification, 'problemDevelopment'=>$problemDevelopment, 'validation_data'=>$validation_data
                ];
                return $this->sendResponse($success, "true");    
                break;
                case 16:
                    
                    
                    $errorcorrection = DB::table('error_correction')->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->get();
                    $problemDevelopment = db::table('problem_development')
                                        ->select('problem_development.*' , 'error_correction.compensator' ,'error_correction.compensator_date' , 'error_correction.id as error_correction_id' )
                                        ->leftJoin('error_correction', 'problem_development.id', '=', 'error_correction.error_id')
                                        ->where('problem_development.project_id' , $project_id)->where('problem_development.user_id' , Auth::user()->id)
                                        ->get();
                          
                        $success =  [
                                "project_id" => $project_id,
                                "problem" => $problem,
                                "solution" => $solution,
                                "Solution_function" => $Solution_function,
                                'errorcorrection' => $errorcorrection,'problemDevelopment' => $problemDevelopment, 'validation_data'=>$validation_data
                                ];
                        return $this->sendResponse($success, "true"); 
                    
                    break;

                    case 17:
                        $functionAud  = DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                            
                        $success =  [
                            "project_id" => $project_id,
                            "problem" => $problem,
                            "solution" => $solution,
                            "Solution_function" => $Solution_function,
                            'functionAud' => $functionAud, 'validation_data'=>$validation_data
                            ];
                        return $this->sendResponse($success, "true"); 
                        break;
                        case 18:
                            $people = db::table('function_belong_to_people')->select('function_belong_to_people.*' , 'customers.name' )
                                        ->leftJoin('customers', 'function_belong_to_people.customer_id', '=', 'customers.id')
                                        ->where('function_belong_to_people.problem_id' , $problem_id)
                                        ->where('function_belong_to_people.project_id' , $project_id)->where('function_belong_to_people.user_id' , Auth::user()->id)->get();
                            
                            
                            $functionAud  = DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                            $functionApplied  = DB::table('function_sub_people')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->where('verification_type' , $type)->first();
                            $success =  [
                                "project_id" => $project_id,
                                "problem" => $problem,
                                "solution" => $solution,
                                "Solution_function" => $Solution_function,
                                'functionAud' => $functionAud , 
                                'functionApplied' => $functionApplied , 
                                'people' => $people, 'validation_data'=>$validation_data
                                ];
                            return $this->sendResponse($success, "true"); 
                            break;
                            case 19:                         
                                $functionApplied  = DB::table('function_sub_people')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->where('verification_type' , 19)->first();
                                $success =  [
                                    "project_id" => $project_id,
                                    "problem" => $problem,
                                    "solution" => $solution,
                                    "Solution_function" => $Solution_function,
                                    'functionApplied' => $functionApplied  , 'validation_data'=>$validation_data
                                    ];
                                return $this->sendResponse($success, "true");                                
                                break;
                                case 20:
                                    $problemPart = DB::table("average_approaches") ->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                    $countPartionAproach = DB::table("partition_approach") ->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->get()->count();
                                    $success =  [
                                        "project_id" => $project_id,
                                        "problem" => $problem,
                                        "solution" => $solution,
                                        "Solution_function" => $Solution_function,
                                        'problemPart' => $problemPart,
                                        'countPartionAproach' => $countPartionAproach, 'validation_data'=>$validation_data
                                        ];
                                    return $this->sendResponse($success, "true");     
                                    break;
                                    case 21:
                                       
                                        $voiceApproach = DB::table("passive_voice")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                        $success =  [
                                            "project_id" => $project_id,
                                            "problem" => $problem,
                                            "solution" => $solution,
                                            "Solution_function" => $Solution_function,
                                            'voiceApproach' => $voiceApproach,'validation_data'=>$validation_data
                                            ];
                                        return $this->sendResponse($success, "true"); 
                                        break;
                                        case 22:
                                            $problemreplaced = DB::table("replace_problem_by_problem")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                            $success =  [
                                                "project_id" => $project_id,
                                                "problem" => $problem,
                                                "solution" => $solution,
                                                "Solution_function" => $Solution_function,
                                                'problemreplaced' => $problemreplaced,'validation_data'=>$validation_data
                                                ];
                                            return $this->sendResponse($success, "true"); 
                                            break;
                                            case 23:
                                                $entities = DB::table("entity_available")
                                                            ->where("type", "=", 0)
                                                            ->where("user_id", "=", Auth::user()->id)
                                                            ->where("project_id", $project_id)
                                                        ->get();

                                                $resources = DB::table("resource_management")
                                                            ->where("user_id", "=", Auth::user()->id)
                                                            ->where("project_id", $project_id)
                                                        ->first();
                                                $entity_used = DB::table("entity_usage")
                                                        ->where("user_id", "=", Auth::user()->id)
                                                        ->where("project_id", $project_id)
                                                        ->first();
                                                    $success =  [
                                                        "project_id" => $project_id,
                                                        "problem" => $problem,
                                                        "solution" => $solution,
                                                        "Solution_function" => $Solution_function,
                                                        "entities"=>$entities,
                                                        "resources"=>$resources,
                                                        "entity_used"=>$entity_used, 'validation_data'=>$validation_data
                                                        ];
                                                    return $this->sendResponse($success, "true"); 
                                                
                                                break;
                                                case 24:
                                                    $custommers = DB::table("customers")
                                                                        ->where("project_id", "=", $project_id)
                                                                        ->get();
                                                    $entitiesAvail = DB::table("entity_available")
                                                        ->where("type", "=", 0)
                                                        ->where("user_id", "=", Auth::user()->id)
                                                        ->where("project_id", $project_id)
                                                    ->get();
                                                    $entitiestbl = DB::table("entities")->get();
                                                    
                                                    $entity_used = DB::table("entity_usage")
                                                        ->where("user_id", "=", Auth::user()->id)
                                                        ->where("project_id", $project_id)
                                                    ->first();

                                                    $principle_identifications = DB::table(
                                                        "principle_identification_main"
                                                    )->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                    $success =  [
                                                            "project_id" => $project_id,
                                                            "problem" => $problem,
                                                            "solution" => $solution,
                                                            "Solution_function" => $Solution_function,
                                                            "entitiesAvail"=>$entitiesAvail,
                                                            "entity_used"=>$entity_used,
                                                            'custommers' => $custommers,
                                                            "entitiestbl" => $entitiestbl,
                                                            "principle_identifications" => $principle_identifications, 'validation_data'=>$validation_data
                                                        ];
                                                    return $this->sendResponse($success, "true"); 
                                                    break;
                                                    case 25:
                                                        $custommers = DB::table("customers")->where("project_id", "=", $project_id)->get();
                                                        $functionOfPeople = DB::table("function_of_people_explanations")->where("project_id", "=", $project_id)->where('user_id' , Auth::user()->id)->first();
                                                        $success =  [
                                                            "project_id" => $project_id,
                                                            "problem" => $problem,
                                                            "solution" => $solution,
                                                            "Solution_function" => $Solution_function,
                                                            'custommers' => $custommers,
                                                            "functionOfPeople" => $functionOfPeople, 'validation_data'=>$validation_data
                                                        ];
                                                    return $this->sendResponse($success, "true"); 
                                                    break;
                                                    case 26:
                                                            $entiesBehind = DB::table('visibility_entity_behind_explanation')->where('user_id' , Auth::user()->id)->where('project_id',$project_id)->get();
                                                            $success =  [
                                                                "project_id" => $project_id,
                                                                "problem" => $problem,
                                                                "solution" => $solution,
                                                                "Solution_function" => $Solution_function,
                                                                'entiesBehind' => $entiesBehind, 'validation_data'=>$validation_data
                                                            ];
                                                            return $this->sendResponse($success, "true"); 
                                                            break;
                                                            case 27:
                                                                $principle_identifications = DB::table(
                                                                    "principle_identification_main"
                                                                )->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                                $mother_nature = DB::table('mother_nature')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                                $success =  [
                                                                    "project_id" => $project_id,
                                                                    "problem" => $problem,
                                                                    "solution" => $solution,
                                                                    "Solution_function" => $Solution_function,
                                                                    'principle_identifications' => $principle_identifications,
                                                                    "mother_nature" => $mother_nature, 'validation_data'=>$validation_data
                                                                ];
                                                                return $this->sendResponse($success, "true"); 
                                                                break;
                                                                case 28:
                                                                    $mevsyou = DB::table('me_vs_you')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();                                                                 
                                                                    $custommers = DB::table("customers")->where("project_id", "=", $project_id)->get();
                                                                    $success =  [
                                                                        "project_id" => $project_id,
                                                                        "problem" => $problem,
                                                                        "solution" => $solution,
                                                                        "Solution_function" => $Solution_function,
                                                                        'mevsyou' => $mevsyou,
                                                                        "custommers" => $custommers, 'validation_data'=>$validation_data
                                                                    ];
                                                                    return $this->sendResponse($success, "true"); 
                                                                    break;
                                                                    case 29:
                                                                        $custommers = DB::table("customers")
                                                                                                ->where("project_id", "=", $project_id)
                                                                                        ->get();
                                                                        $taking_ad  = DB::table('taking_advantage')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                                        $success =  [
                                                                            "project_id" => $project_id,
                                                                            "problem" => $problem,
                                                                            "solution" => $solution,
                                                                            "Solution_function" => $Solution_function,
                                                                            "custommers" => $custommers,
                                                                            "taking_ad" => $taking_ad, 'validation_data'=>$validation_data
                                                                        ];
                                                                        return $this->sendResponse($success, "true"); 
                                                                        break;
                                                                    case 30:
                                   
                                                                        $people_outside_project = DB::table("people_outside_project")
                                                                                                ->where("project_id", "=", $project_id)->get();
                                                                        $custommers = DB::table("customers")->where("project_id", "=", $project_id)->get();
                                                                        $success =  [
                                                                            "project_id" => $project_id,
                                                                            "problem" => $problem,
                                                                            "solution" => $solution,
                                                                            "Solution_function" => $Solution_function,
                                                                            "custommers" => $custommers,
                                                                            "people_outside_project" => $people_outside_project, 'validation_data'=>$validation_data
                                                                        ];
                                                                        return $this->sendResponse($success, "true"); 
                                                                    break;
                                                                    case 31:
                                                                        $problrmAtLocatios  = DB::table('problrm_at_location_explantion')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                                        $custommers = DB::table("customers")->where("project_id", "=", $project_id)->get();
                                                                        $success =  [
                                                                            "project_id" => $project_id,
                                                                            "problem" => $problem,
                                                                            "solution" => $solution,
                                                                            "Solution_function" => $Solution_function,
                                                                            "custommers" => $custommers,
                                                                            "problrmAtLocatios" => $problrmAtLocatios, 'validation_data'=>$validation_data
                                                                        ];
                                                                        return $this->sendResponse($success, "true");
                                                                    break;

                                                                    case 32:
                                                                        $function_at_location  = DB::table('function_at_locations')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->first();
                                                                        $custommers = DB::table("customers")
                                                                        ->where("project_id", "=", $project_id)->get();
                                                                        $success =  [
                                                                            "project_id" => $project_id,
                                                                            "problem" => $problem,
                                                                            "solution" => $solution,
                                                                            "Solution_function" => $Solution_function,
                                                                            "custommers" => $custommers,
                                                                            "function_at_location" => $function_at_location, 'validation_data'=>$validation_data
                                                                        ];
                                                                        return $this->sendResponse($success, "true");
                                                                    break;
                                                                    default: 
                                                                
                                                                    $success =  [
                                                                        "project_id" => $project_id,
                                                                        "problem" => $problem,
                                                                        "solution" => $solution,
                                                                        "Solution_function" => $Solution_function, 'validation_data'=>$validation_data
                                                                    ];
                                                                    return $this->sendResponse($success, "No verification type found");
                                                                }



    }
   


    // Creat Voucablary Verification for New project

    public function storeVoucablaryVerification(Request $request){
        $validator = Validator::make($request->all(), [
            "solution_fun_id" => "required",
            "verificationType" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }  



        
    }

     public function allVerifications(){
        $verifications = VerificationType::all();
        foreach($verifications as $key => $value){
            if($value->category == 1){
                $value->category_name = 'Vocabulary & Information';
            }
            if($value->category == 2){
                $value->category_name = 'Time Validation';
            }
            if($value->category == 3){
                $value->category_name = 'Separation of Entities';
            }
            if($value->category == 4){
                $value->category_name = 'Stability';
            }
            if($value->category == 5){
                $value->category_name = 'Principle Approach';
            }
            if($value->category == 6){
                $value->category_name = 'Resource Management';
            }
        }

        return $verifications;
     }
    // This function stores voucab and information verifications 
     public function AddverificationVocablary($request, $name)
     {
        // echo "<pre>";print_r($request->all());die;
         $validator = Validator::make($request->all(), [
             "solution_fun_id" => "required",
             "verificationType" => "required",
             //'verification_type_text_id' => 'required'
         ]);
         if ($validator->fails()) {
             return $this->sendError("Validation Error.", $validator->errors());
         }
 
         try {
             $data = $request->all();
             $verification = new Verification();
             $verification->name = $name;
             $verification->verification_type_id = $data["verificationType"];
             $verification->verification_type_text_id = isset(
                 $data["verification_type_text_id"]
             )
                 ? $data["verification_type_text_id"]
                 : null;
             $verification->problem_id = $data["problem_id"];
             $verification->solution_id = $data["solution_id"];
             $verification->solution_function_id = $data["solution_fun_id"];
             $verification->user_id = Auth::user()->id;
             $verification->type = 0;
 
             $verification->file = isset($data["file"]) ? $data["file"] : null;
             $verification->save();
             if ($verification->id) {
                 $success["verification"] = $verification;
                 return $this->sendResponse(
                     $success,
                     "Record saved successfully."
                 );
             } else {
                 return $this->sendResponse($error, "Something Wrong.");
             }
         } catch (Exception $e) {
             return $this->sendError("Error.", ["error" => $e->getMessage()()]);
         }
     }



     public function store(Request $request){
        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "verificationType" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $type = $request->verificationType;
            switch ($type) {
                case 1:
                    $validator = Validator::make($request->all(), [
                        // "verification_type_text_id" => "required",
                        "file" => "required"
                    ]);
                    if ($validator->fails()) {
                        return $this->sendError("Validation Error.", $validator->errors());
                    }
                    $name = "Vocablary";
                    return $this->AddverificationVocablary($request, $name);
                    break;
                case 2:
                    $validator = Validator::make($request->all(), [
                        // "verification_type_text_id" => "required",
                        "file" => "required"
                    ]);
                    if ($validator->fails()) {
                        return $this->sendError("Validation Error.", $validator->errors());
                    }
                    $name = "Information";
                    return $this->AddverificationVocablary($request, $name);
                    break;
                default:
                case 15:
                    $name = "problem_development";
                    return $this->AddverificationVocablary($request, $name);
                    break;
                    return true;
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }


    public function StoreValidatoins(Request $request){
        try {
            
            $input = $request->all();
            $verification = Verification::find($input["id"]);
            $mesaage = "";
            if (!$verification) {
                $verification = new Verification();
                $verification->verification_type_id = $input["verification_type_id"];
                // $verification->verification_type_text_id =  $input['verification_type_text_id'];
                $verification->problem_id = $input["problem_id"];
                // $verification->solution_id = $input["solution_id"];
                // $verification->solution_function_id = $input["solution_fun_id"];
                $verification->user_id = Auth::user()->id;
                $verification->name = ($input["name"]) ? $input["name"]:'';
                $mesaage = "Validation created successfully.";
            }else{
                $verification = Verification::Find($input["id"]);
                $mesaage = "Validation updated successfully.";
            }
            
            $verification->validations = json_encode($input);
            
            $verification->save();
            $success["verification"] = $verification;
            return $this->sendResponse(
                $success,
                $mesaage
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }

    }



    public function storinformationVerification(){

    }
    

}