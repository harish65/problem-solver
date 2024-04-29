<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Problem;
use App\Models\Project;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\SolutionFunction;
use App\Models\Setting;
use App\Models\Verification;
use App\Models\VerificationType;
use App\Models\VerificationTypeText;
use App\Models\VerificationEntity;
use App\Models\ErrorCorrection;
use App\Models\BeforeAndAfter;
use App\Models\PastAndPresentTime;
use App\Models\Customer;
use App\Models\TimeVerification;
use App\Models\PrincipleIdentificationMain;
use DB;
use Auth;
use Redirect;
use Validator;

class VerificationController extends BaseController
{
    public function index($data = null, $type = null)
    {
        
        $params = Crypt::decrypt($data);
        $problem_id = $params["problem_id"];
        $project_id = $params["project_id"];
       
        if ($problem_id == "" && $project_id  != '') {
            $problem_id = Problem::where("project_id", "=", $project_id)->where('user_id' , Auth::user()->id)->pluck('id')->first();
        }
        $verificationType = null;
        $verifiationTypeText = null;
        $verification = null;
        $entity = null;
        //get problem
        
        $problem = Problem::where("id", "=", $problem_id)->first();
        if ($problem) {
            $problem_name = $problem->name;
        }
        //get solution
        $solution = Solution::where("problem_id", "=", $problem_id)->first();
       
        //get solution function
        $Solution_function = SolutionFunction::where(
            "problem_id",
            "=",
            $problem_id
        )->first();

        if (!isset($Solution_function->id)) {
            return Redirect::back()->withErrors([
                "msg" =>
                    "Verificatioon must have Solution function identified.",
            ]);
        }

        //get Verification
        $verification = Verification::where("problem_id", "=", $problem_id)
            ->where("verification_type_id", "=", $type)
            ->where("solution_function_id", "=", $Solution_function->id)
            ->first();
        if ($type != "") {
            $verificationType = VerificationType::where(
                "id",
                "=",
                $type
            )->first();
            $verificationType->validation_questions = json_decode(
                $verificationType->validation_questions
            );
            $verifiationTypeText = VerificationTypeText::where(
                "verification_type_id",
                $type
            )->get();

            if (@$verification->id != "") {
                $entity = VerificationEntity::where("verTypeId", "=", $type)
                    ->where("verId", "=", @$verification->id)
                    ->get();
            } else {
                $entity = VerificationEntity::where(
                    "verTypeId",
                    "=",
                    $type
                )->get();
            }
        }

        if (isset($verification->validations)) {
            $verification->validations = json_decode(
                $verification->validations
            );
        }

        $solution_id = $solution->id;
        $solutionTypes = DB::table("solution_types")->get();

        $types = VerificationType::orderBy("id", "asc")->get();
        $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
        switch ($type) {
            case 1:
                return view("adult.verification.view.vocabulary-content", [
                    "types" => $types,
                    "verificationType" => $verificationType,
                    "verification" => $verification,
                    "problem_id" => $problem_id,
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "solution_id" => $solution_id,
                    "Solution_function" => $Solution_function,
                    "verificationTypeText" => $verifiationTypeText,
                    "entity" => $entity,
                ]);
                break;
            case 2:
                return view("adult.verification.view.information-content", [
                    "types" => $types,
                    "verificationType" => $verificationType,
                    "verification" => $verification,
                    "problem_id" => $problem_id,
                    "project_id" => $project_id,
                    "problem" => $problem,
                    "solution" => $solution,
                    "solution_id" => $solution_id,
                    "Solution_function" => $Solution_function,
                    "verificationTypeText" => $verifiationTypeText,
                    "entity" => $entity,
                ]);
                break;
            case 3:
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        3
                    )->first();
                    $verification->validations = json_decode(
                        $verification->validations
                    );
                }
                
                $beforeAfter =  DB::table('before_and_after')
                                ->where('problem_id' , $problem->id)
                                ->where('project_id' , $project_id)
                                ->where('user_id' , Auth::user()->id)
                                ->first();
                
                return view(
                    "adult.verification.view.before-after-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "entity",
                        "solutionTypes",
                        "beforeAfter"
                    )
                );
                break;
            case 4:
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        4
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }

                return view(
                    "adult.verification.view.separation-step",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "entity" , "custommers"
                    )
                );
                break;
            case 5:
                $timeVerifications =  TimeVerification::where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
            
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        5
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
               
                return view(
                    "adult.verification.view.time-verification-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "entity",
                        "timeVerifications"
                    )
                );
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
                return view(
                    "adult.verification.view.past-present-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "entity",
                        "allVarifications" , 'pastAndPresentTime'
                    )
                );
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
                $allVarifications = DB::table("principle_identification")->get();

                $content =     DB::table("principle_identification_drived_principle")->where("project_id", $project_id)->where('user_id' , Auth::user()->id)->first();
                
                return view(
                    "adult.verification.view.entity-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "givenSet",
                        "entities",
                        "entitiesAvailable",                        
                        "allVarifications" , "content"
                    )
                );
                break;
            case 8:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        5
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
                return view(
                    "adult.verification.view.solution-time-location1-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "custommers"
                    )
                );
                break;
            case 9:
                $custommers = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        5
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
                return view(
                    "adult.verification.view.solution-time-location2-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "custommers"
                    )
                );
                break;
            case 10:
                $users = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                return view(
                    "adult.verification.view.people-project-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "users"
                    )
                );
                break;
            case 11:
                $users = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        5
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
                $communications = DB::table('people_communication_flow')
                        ->select('people_communication_flow.*' , 'customers.name AS customer_name' )
                        ->leftJoin('customers', 'people_communication_flow.customer_id', '=', 'customers.id')
                        ->where('people_communication_flow.user_id' , Auth::user()->id)
                        ->where('people_communication_flow.project_id' , $project_id)
                        ->where('people_communication_flow.problem_id' , $problem_id)
                        
                        
                        ->get();
          
                return view(
                    "adult.verification.view.people-communication-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "users" , "communications"
                    )
                );
                break;
            case 12:


                $users = DB::table('customers')
                        ->select('customers.*' , 'people_communication_flow.*')
                        ->leftJoin('people_communication_flow', 'customers.id', '=', 'people_communication_flow.customer_id')
                        ->where('customers.project_id' , $project_id)
                        ->whereNotNull('people_communication_flow.comment')
                        ->get();
                $customers = DB::table("customers")
                        ->where("project_id", "=", $project_id)
                        ->get();

                   
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        12
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
                // echo '<pre>';print_r($users);die;
                return view(
                    "adult.verification.view.communication-flow-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "users" , "customers"
                    )
                );
                break;
            case 13:
                $entities = DB::table("partition_approach")->where('user_id' , Auth::user()->id)->get();
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        13
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }
                return view(
                    "adult.verification.view.partition-approch-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "entities"
                    )
                );
                break;
            case 14:
            
                $allVarifications = DB::table(
                    "principle_identification"
                )->get();
               
                
                $users = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->get();
                   
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        14
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }

                $content =  DB::table('principle_identification_main')->where('project_id' , $project_id)->where('problem_id' , $problem_id)->where('user_id' , Auth::user()->id)->first();
                
                return view(
                    "adult.verification.view.principle-identification-content",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "allVarifications",
                        "users" , 
                        "content"
                    )
                );
                break;

            case 15:
                $allVarifications = DB::table(
                    "principle_identification"
                )->get();
                $users = DB::table("customers")
                    ->where("project_id", "=", $project_id)
                    ->first();
                if (!$verification) {
                    $verification = Verification::where(
                        "verification_type_id",
                        "=",
                        15
                    )->first();
                    if (isset($verification->validations)) {
                        $verification->validations = json_decode(
                            $verification->validations
                        );
                    }
                }

                $problemDevelopment = DB::table('problem_development')->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->get();


                return view(
                    "adult.verification.view.problem-development",
                    compact(
                        "types",
                        "verificationType",
                        "verification",
                        "problem_id",
                        "project_id",
                        "problem",
                        "solution",
                        "solution_id",
                        "Solution_function",
                        "verifiationTypeText",
                        "allVarifications",
                        "users",
                        'problemDevelopment'
                    )
                );
                break;
                case 16:
                    $allVarifications = DB::table(
                        "principle_identification"
                    )->get();
                    $users = DB::table("customers")
                        ->where("project_id", "=", $project_id)
                        ->first();
                    if (!$verification) {
                        $verification = Verification::where(
                            "verification_type_id", "=", 16
                        )->first();
                        if (isset($verification->validations)) {
                            $verification->validations = json_decode(
                                $verification->validations
                            );
                        }
                    }
                    if(!$verificationType){
                        $verificationType = VerificationType::where(
                            "id", "=", 16
                        )->first();
                    }
                    
                    $errorcorrection = DB::table('error_correction')->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->get();
                    $problemDevelopment = db::table('problem_development')
                                        ->select('problem_development.*' , 'error_correction.compensator' ,'error_correction.compensator_date' , 'error_correction.id as error_correction_id' )
                                        ->leftJoin('error_correction', 'problem_development.id', '=', 'error_correction.error_id')
                                        ->where('problem_development.project_id' , $project_id)->where('problem_development.user_id' , Auth::user()->id)
                                        ->get();
                          
                          
                    return view(
                        "adult.verification.view.error-correction-approach",
                        compact(
                            "types",
                            "verificationType",
                            "verification",
                            "problem_id",
                            "project_id",
                            "problem",
                            "solution",
                            "solution_id",
                            "Solution_function",
                            "verifiationTypeText",
                            "allVarifications",
                            "users",
                            'errorcorrection','problemDevelopment'
                        )
                    );
                    break;

                    case 17:
                        
                        $allVarifications = DB::table(
                            "principle_identification"
                        )->get();
                        $users = DB::table("customers")
                            ->where("project_id", "=", $project_id)
                            ->first();
                        if (!$verification) {
                            $verification = Verification::where(
                                "verification_type_id", "=", 16
                            )->first();
                            if (isset($verification->validations)) {
                                $verification->validations = json_decode(
                                    $verification->validations
                                );
                            }
                        }
                        if(!$verificationType){
                            $verificationType = VerificationType::where(
                                "id", "=", 16
                            )->first();
                        }
                        
                        $errorcorrection = DB::table('error_correction')->get();
                       
    
                        $problemDevelopment = db::table('problem_development')->select('problem_development.*' , 'error_correction.compensator' )
                                            ->leftJoin('error_correction', 'problem_development.id', '=', 'error_correction.error_id')
                                            ->get();
                        $functionAud  = DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                            
                        return view(
                            "adult.verification.view.function-adjustment",
                            compact(
                                "types",
                                "verificationType",
                                "verification",
                                "problem_id",
                                "project_id",
                                "problem",
                                "solution",
                                "solution_id",
                                "Solution_function",
                                "verifiationTypeText",
                                "allVarifications",
                                "users",
                                'errorcorrection','problemDevelopment','functionAud'
                            )
                        );
                        break;
                        case 18:
                        
                            $allVarifications = DB::table(
                                "principle_identification"
                            )->get();
                            $custommers = DB::table("customers")
                                ->where("project_id", "=", $project_id)
                                ->get();
                            if (!$verification) {
                                $verification = Verification::where(
                                    "verification_type_id", "=", 16
                                )->first();
                                if (isset($verification->validations)) {
                                    $verification->validations = json_decode(
                                        $verification->validations
                                    );
                                }
                            }
                            if(!$verificationType){
                                $verificationType = VerificationType::where(
                                    "id", "=", 16
                                )->first();
                            }
                            
                            $errorcorrection = DB::table('error_correction')->get();
                            $people = db::table('function_belong_to_people')->select('function_belong_to_people.*' , 'customers.name' )
                                        ->leftJoin('customers', 'function_belong_to_people.customer_id', '=', 'customers.id')
                                        ->where('function_belong_to_people.problem_id' , $problem_id)
                                        ->where('function_belong_to_people.project_id' , $project_id)->where('function_belong_to_people.user_id' , Auth::user()->id)->get();
                            
                            
                            $functionAud  = DB::table('function_adjustments')->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                               
                            return view(
                                "adult.verification.view.function-sub-and-people",
                                compact(
                                    "types",
                                    "verificationType",
                                    "verification",
                                    "problem_id",
                                    "project_id",
                                    "problem",
                                    "solution",
                                    "solution_id",
                                    "Solution_function",
                                    "verifiationTypeText",
                                    "allVarifications",
                                    "custommers",
                                    'errorcorrection','functionAud','people'
                                )
                            );
                            break;
                            case 19:
                        
                                $allVarifications = DB::table(
                                    "principle_identification"
                                )->get();
                                $custommers = DB::table("customers")
                                    ->where("project_id", "=", $project_id)
                                    ->get();
                                if (!$verification) {
                                    $verification = Verification::where(
                                        "verification_type_id", "=", 16
                                    )->first();
                                    if (isset($verification->validations)) {
                                        $verification->validations = json_decode(
                                            $verification->validations
                                        );
                                    }
                                }
                                if(!$verificationType){
                                    $verificationType = VerificationType::where(
                                        "id", "=", 16
                                    )->first();
                                }
                               
                                $people = db::table('function_belong_to_people')->select('function_belong_to_people.*' , 'customers.name' )
                                            ->leftJoin('customers', 'function_belong_to_people.customer_id', '=', 'customers.id')
                                            ->where('function_belong_to_people.problem_id' , $problem_id)->where('function_belong_to_people.project_id' , $project_id)->where('function_belong_to_people.user_id' , Auth::user()->id)->get();
                               
                               
                                return view(
                                    "adult.verification.view.function-sub-and-people",
                                    compact(
                                        "types",
                                        "verificationType",
                                        "verification",
                                        "problem_id",
                                        "project_id",
                                        "problem",
                                        "solution",
                                        "solution_id",
                                        "Solution_function",
                                        "verifiationTypeText",
                                        "allVarifications",
                                        "custommers","people"
                                        
                                    )
                                );
                                break;
                                case 20:
                                   
                                    $allVarifications = DB::table(
                                        "principle_identification"
                                    )->get();
                                   
                                    if (!$verification) {
                                        $verification = Verification::where(
                                            "verification_type_id", "=", 16
                                        )->first();
                                        if (isset($verification->validations)) {
                                            $verification->validations = json_decode(
                                                $verification->validations
                                            );
                                        }
                                        
                                    }
                                    if(!$verificationType){
                                        $verificationType = VerificationType::where(
                                            "id", "=", 16
                                        )->first();
                                    }
                                    $problemPart = DB::table("averaging_approach")->select('problem_part' , 'id') ->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                   
                                    
                                    return view(
                                        "adult.verification.view.average-aparoach-calculation",
                                        compact(
                                            "types",
                                            "verificationType",
                                            "verification",
                                            "problem_id",
                                            "project_id",
                                            "problem",
                                            "solution",
                                            "solution_id",
                                            "Solution_function",
                                            "verifiationTypeText",
                                            "allVarifications","problemPart"
                                            
                                            
                                        )
                                    );
                                    break;
                                    case 21:
                                   
                                        
                                        
                                        if (!$verification) {
                                            $verification = Verification::where(
                                                "verification_type_id", "=", 16
                                            )->first();
                                            if (isset($verification->validations)) {
                                                $verification->validations = json_decode(
                                                    $verification->validations
                                                );
                                            }
                                        }
                                        if(!$verificationType){
                                            $verificationType = VerificationType::where(
                                                "id", "=", 16
                                            )->first();
                                        }
                                        $voiceApproach = DB::table("passive_voice")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                       
                                       
                                        return view(
                                            "adult.verification.view.passive-voice-approach",
                                            compact(
                                                "types",
                                                "verificationType",
                                                "verification",
                                                "problem_id",
                                                "project_id",
                                                "problem",
                                                "solution",
                                                "solution_id",
                                                "Solution_function",
                                                "verifiationTypeText","voiceApproach"
                                               
                                                
                                                
                                            )
                                        );
                                        break;
                                        case 22:
                                   
                                            $allVarifications = DB::table(
                                                "principle_identification"
                                            )->get();
                                            
                                            if (!$verification) {
                                                $verification = Verification::where(
                                                    "verification_type_id", "=", 16
                                                )->first();
                                                if (isset($verification->validations)) {
                                                    $verification->validations = json_decode(
                                                        $verification->validations
                                                    );
                                                }
                                            }
                                            if(!$verificationType){
                                                $verificationType = VerificationType::where(
                                                    "id", "=", 16
                                                )->first();
                                            }
                                            $problemreplaced = DB::table("replace_problem_by_problem")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                            
                                           
                                            return view(
                                                "adult.verification.view.replace-problem-by-problem",
                                                compact(
                                                    "types",
                                                    "verificationType",
                                                    "verification",
                                                    "problem_id",
                                                    "project_id",
                                                    "problem",
                                                    "solution",
                                                    "solution_id",
                                                    "Solution_function",
                                                    "verifiationTypeText",
                                                    "allVarifications","problemreplaced"
                                                    
                                                    
                                                )
                                            );
                                            break;
                                            case 23:
                                   
                                                
                                                
                                                if (!$verification) {
                                                    $verification = Verification::where(
                                                        "verification_type_id", "=", 16
                                                    )->first();
                                                    if (isset($verification->validations)) {
                                                        $verification->validations = json_decode(
                                                            $verification->validations
                                                        );
                                                    }
                                                }
                                                if(!$verificationType){
                                                    $verificationType = VerificationType::where(
                                                        "id", "=", 16
                                                    )->first();
                                                }
                                                // $problemreplaced = DB::table("replace_problem_by_problem")->where('problem_id' , $problem_id)->where('project_id' , $project_id)->where('user_id' , Auth::user()->id)->first();
                                                $entity = DB::table("entity_available")
                                                            ->where("type", "=", 0)
                                                            ->where("user_id", "=", Auth::user()->id)
                                                            ->where("project_id", $project_id)
                                                        ->first();

                                                $resources = DB::table("resource_management")
                                                            ->where("user_id", "=", Auth::user()->id)
                                                            ->where("project_id", $project_id)
                                                        ->first();
                                                        
                                                //  echo "<pre>";print_r($entities);die;
                                                return view(
                                                    "adult.verification.view.resource-management-consideration",
                                                    compact(
                                                        "types",
                                                        "verificationType",
                                                        "verification",
                                                        "problem_id",
                                                        "project_id",
                                                        "problem",
                                                        "solution",
                                                        "solution_id",
                                                        "Solution_function",
                                                        "verifiationTypeText","entity","resources"
                                                        
                                                    )
                                                );
                                                break;
                                                case 24:
                                   
                                                    $allVarifications = DB::table(
                                                        "principle_identification"
                                                    )->get();
                                                    $custommers = DB::table("customers")
                                                                            ->where("project_id", "=", $project_id)
                                                                    ->get();
                                                    if (!$verification) {
                                                        $verification = Verification::where(
                                                            "verification_type_id", "=", 16
                                                        )->first();
                                                        if (isset($verification->validations)) {
                                                            $verification->validations = json_decode(
                                                                $verification->validations
                                                            );
                                                        }
                                                    }
                                                    $entities = DB::table("entity_available")
                                                        ->where("type", "=", 0)
                                                        ->where("user_id", "=", Auth::user()->id)
                                                        ->where("project_id", $project_id)
                                                    ->get();

                                                    $entitiestbl = DB::table("entities")->get();
                                                    if(!$verificationType){
                                                        $verificationType = VerificationType::where(
                                                            "id", "=", 16
                                                        )->first();
                                                    }
                                                   
                                                   
                                                    return view(
                                                        "adult.verification.view.entity_usage",
                                                        compact(
                                                            "types",
                                                            "verificationType",
                                                            "verification",
                                                            "problem_id",
                                                            "project_id",
                                                            "problem",
                                                            "solution",
                                                            "solution_id",
                                                            "Solution_function",
                                                            "verifiationTypeText",
                                                            "allVarifications","entities" ,"entitiestbl","custommers"
                                                            
                                                            
                                                        )
                                                    );
                                                    break;
                                                    case 25:
                                   
                                                        $allVarifications = DB::table(
                                                            "principle_identification"
                                                        )->get();
                                                        $custommers = DB::table("customers")
                                                                                ->where("project_id", "=", $project_id)
                                                                        ->get();
                                                        if (!$verification) {
                                                            $verification = Verification::where(
                                                                "verification_type_id", "=", 16
                                                            )->first();
                                                            if (isset($verification->validations)) {
                                                                $verification->validations = json_decode(
                                                                    $verification->validations
                                                                );
                                                            }
                                                        }
                                                        $entities = DB::table("entity_available")
                                                        ->where("type", "=", 0)
                                                        ->get();
    
                                                        $entitiestbl = DB::table("entities")->get();
                                                        if(!$verificationType){
                                                            $verificationType = VerificationType::where(
                                                                "id", "=", 16
                                                            )->first();
                                                        }
                                                       
                                                       
                                                        
                                                        return view(
                                                            "adult.verification.view.function_of_people_explanation",
                                                            compact(
                                                                "types",
                                                                "verificationType",
                                                                "verification",
                                                                "problem_id",
                                                                "project_id",
                                                                "problem",
                                                                "solution",
                                                                "solution_id",
                                                                "Solution_function",
                                                                "verifiationTypeText",
                                                                "allVarifications","entities" ,"entitiestbl","custommers"
                                                                
                                                                
                                                            )
                                                        );
                                                        break;
                                                        case 26:
                                   
                                                            $allVarifications = DB::table(
                                                                "principle_identification"
                                                            )->get();
                                                            $custommers = DB::table("customers")
                                                                                    ->where("project_id", "=", $project_id)
                                                                            ->get();
                                                            if (!$verification) {
                                                                $verification = Verification::where(
                                                                    "verification_type_id", "=", 16
                                                                )->first();
                                                                if (isset($verification->validations)) {
                                                                    $verification->validations = json_decode(
                                                                        $verification->validations
                                                                    );
                                                                }
                                                            }
                                                            $entities = DB::table("entity_available")
                                                            ->where("type", "=", 0)
                                                            ->get();
        
                                                            $entitiestbl = DB::table("entities")->get();
                                                            if(!$verificationType){
                                                                $verificationType = VerificationType::where(
                                                                    "id", "=", 16
                                                                )->first();
                                                            }
                                                           
                                                           
                                                            
                                                            return view(
                                                                "adult.verification.view.visibility_and_entity_behind_explanation",
                                                                compact(
                                                                    "types",
                                                                    "verificationType",
                                                                    "verification",
                                                                    "problem_id",
                                                                    "project_id",
                                                                    "problem",
                                                                    "solution",
                                                                    "solution_id",
                                                                    "Solution_function",
                                                                    "verifiationTypeText",
                                                                    "allVarifications","entities" ,"entitiestbl","custommers"
                                                                    
                                                                    
                                                                )
                                                            );
                                                            break;
                                                            case 27:
                                   
                                                                $allVarifications = DB::table(
                                                                    "principle_identification"
                                                                )->get();
                                                                $custommers = DB::table("customers")
                                                                                        ->where("project_id", "=", $project_id)
                                                                                ->get();
                                                                if (!$verification) {
                                                                    $verification = Verification::where(
                                                                        "verification_type_id", "=", 16
                                                                    )->first();
                                                                    if (isset($verification->validations)) {
                                                                        $verification->validations = json_decode(
                                                                            $verification->validations
                                                                        );
                                                                    }
                                                                }
                                                                $entities = DB::table("entity_available")
                                                                ->where("type", "=", 0)
                                                                ->get();
            
                                                                $entitiestbl = DB::table("entities")->get();
                                                                if(!$verificationType){
                                                                    $verificationType = VerificationType::where(
                                                                        "id", "=", 16
                                                                    )->first();
                                                                }
                                                               
                                                               
                                                                
                                                                return view(
                                                                    "adult.verification.view.mother_nature",
                                                                    compact(
                                                                        "types",
                                                                        "verificationType",
                                                                        "verification",
                                                                        "problem_id",
                                                                        "project_id",
                                                                        "problem",
                                                                        "solution",
                                                                        "solution_id",
                                                                        "Solution_function",
                                                                        "verifiationTypeText",
                                                                        "allVarifications","entities" ,"entitiestbl","custommers"
                                                                        
                                                                        
                                                                    )
                                                                );
                                                                break;
                                                                case 28:
                                   
                                                                    $allVarifications = DB::table(
                                                                        "principle_identification"
                                                                    )->get();
                                                                    $custommers = DB::table("customers")
                                                                                            ->where("project_id", "=", $project_id)
                                                                                    ->get();
                                                                    if (!$verification) {
                                                                        $verification = Verification::where(
                                                                            "verification_type_id", "=", 16
                                                                        )->first();
                                                                        if (isset($verification->validations)) {
                                                                            $verification->validations = json_decode(
                                                                                $verification->validations
                                                                            );
                                                                        }
                                                                    }
                                                                    $entities = DB::table("entity_available")
                                                                    ->where("type", "=", 0)
                                                                    ->get();
                
                                                                    $entitiestbl = DB::table("entities")->get();
                                                                    if(!$verificationType){
                                                                        $verificationType = VerificationType::where(
                                                                            "id", "=", 16
                                                                        )->first();
                                                                    }
                                                                   
                                                                   
                                                                    
                                                                    return view(
                                                                        "adult.verification.view.me_vs_you",
                                                                        compact(
                                                                            "types",
                                                                            "verificationType",
                                                                            "verification",
                                                                            "problem_id",
                                                                            "project_id",
                                                                            "problem",
                                                                            "solution",
                                                                            "solution_id",
                                                                            "Solution_function",
                                                                            "verifiationTypeText",
                                                                            "allVarifications","entities" ,"entitiestbl","custommers"
                                                                            
                                                                            
                                                                        )
                                                                    );
                                                                    break;
                                                                    case 29:
                                   
                                                                        $allVarifications = DB::table(
                                                                            "principle_identification"
                                                                        )->get();
                                                                        $custommers = DB::table("customers")
                                                                                                ->where("project_id", "=", $project_id)
                                                                                        ->get();
                                                                        if (!$verification) {
                                                                            $verification = Verification::where(
                                                                                "verification_type_id", "=", 16
                                                                            )->first();
                                                                            if (isset($verification->validations)) {
                                                                                $verification->validations = json_decode(
                                                                                    $verification->validations
                                                                                );
                                                                            }
                                                                        }
                                                                        $entities = DB::table("entity_available")
                                                                        ->where("type", "=", 0)
                                                                        ->get();
                    
                                                                        $entitiestbl = DB::table("entities")->get();
                                                                        if(!$verificationType){
                                                                            $verificationType = VerificationType::where(
                                                                                "id", "=", 16
                                                                            )->first();
                                                                        }
                                                                       
                                                                       
                                                                        
                                                                        return view(
                                                                            "adult.verification.view.taking_advantage",
                                                                            compact(
                                                                                "types",
                                                                                "verificationType",
                                                                                "verification",
                                                                                "problem_id",
                                                                                "project_id",
                                                                                "problem",
                                                                                "solution",
                                                                                "solution_id",
                                                                                "Solution_function",
                                                                                "verifiationTypeText",
                                                                                "allVarifications","entities" ,"entitiestbl","custommers"
                                                                                
                                                                                
                                                                            )
                                                                        );
                                                                        break;
                    default:                
                    return view(
                        "adult.verification.index",
                        compact(
                            "types",
                            "verificationType",
                            "verification",
                            "problem_id",
                            "project_id",
                            "problem",
                            "solution",
                            "solution_id",
                            "Solution_function",
                            "verifiationTypeText"
                        )
                    );
        }
    }

    public function store(Request $request)
    {
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
                    //Vocablary Verification
                    $name = "Vocablary";
                    return $this->AddverificationVocablary($request, $name);
                    break;
                case 2:
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

    /**
     * Add Voucabalry Verification
     *
     */
    public function AddverificationVocablary($request, $name)
    {
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
            $verification->problem_id = Crypt::decrypt($data["problem_id"]);
            $verification->solution_id = Crypt::decrypt($data["solution_id"]);
            $verification->solution_function_id = $data["solution_fun_id"];
            $verification->user_id = Auth::user()->id;
            $verification->type = 0;

            $verification->file = isset($data["file"]) ? $data["file"] : null;
            $verification->save();
            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()()]);
        }
    }
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $type = $request->verificationType;
            $verId = $request->id;
            $delete = Verification::where("id", "=", $verId)->delete();
            $entityDelete = Db::table("verification_entities")
                ->where("verId", "=", $verId)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Verification deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function addVocabularyEntity(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "verificationType" => "required",
            "key" => "required",
            "value" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            // dd($request);
            // $type = $request->verificationType;
            // $verId = $request->ver_id;
            // $key = $request->key;
            // $entity = $request->value;

            // add new row to varification_entity table
            if (!$request->id) {
                $verificationEntity = new VerificationEntity();
                $verificationEntity->verification_key = $request->key;
                $verificationEntity->verification_value = $request->value;
                $verificationEntity->verId = $request->ver_id;
                $verificationEntity->verTypeId = $request->verificationType;
                $verificationEntity->point_to = $request->point_to;
                $verificationEntity->save();
            } else {
                $verificationEntity = VerificationEntity::find($request->id);
                $verificationEntity->verification_key = $request->key;
                $verificationEntity->verification_value = $request->value;
                $verificationEntity->verId = $request->ver_id;
                $verificationEntity->verTypeId = $request->verificationType;
                $verificationEntity->point_to = $request->point_to;
                $verificationEntity->save();
            }
            if ($verificationEntity->id) {
                $success["verificationEntity"] = $verificationEntity;
                return $this->sendResponse(
                    $success,
                    "Verification Entity Has created successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    //Before And After
    public function BeforeAndAfter(Request $request){
        
        $validator = Validator::make($request->all(), [
            "verificationType" => "required",
            "existing_after" => "required",
           
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
           
            // echo "<pre>";print_r($request->all());die;
            // add new row to varification_entity table
            if (!$request->beforeafter_id) {
                $verificationEntity = new BeforeAndAfter();
                $verificationEntity->problem_id = $request->problem_id;
                $verificationEntity->project_id = $request->project_id;
                $verificationEntity->solution_id = $request->solution_id;
                $verificationEntity->solution_function_id = $request->solution_function_id;
                $verificationEntity->user_id = Auth::user()->id;
                $verificationEntity->existing_after = $request->existing_after;
                $verificationEntity->save();
            } else {
                $verificationEntity = BeforeAndAfter::find($request->beforeafter_id);
                $verificationEntity->problem_id = $request->problem_id;
                $verificationEntity->project_id = $request->project_id;
                $verificationEntity->solution_id = $request->solution_id;
                $verificationEntity->solution_function_id = $request->solution_function_id;
                $verificationEntity->user_id = Auth::user()->id;
                $verificationEntity->existing_after = $request->existing_after;
                $verificationEntity->save();
            }
            if ($verificationEntity->id) {
                $success["verificationEntity"] = $verificationEntity;
                return $this->sendResponse(
                    $success,
                    "The problem is identified before, then after the problem is solved.  This process can be edited to determine whether the problem is identified before the solution of the problem or the solution is identified after the problem."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function DeleteBeforeAndAfter(Request $request){
        try {
            $entityId = $request->id;
            $delete = BeforeAndAfter::where(
                "id",
                "=",
                $request->id
            )->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }
    public function deleteVocabulary(Request $request)
    {
        try {
            $entityId = $request->id;
            $delete = VerificationEntity::where(
                "id",
                "=",
                $request->id
            )->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Verification deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function addVocabularyValidations(Request $request)
    {
        if ($request->verificationType == 3) {
            if ($request->id !== "") {
                $verification = Verification::find($request->id);
                $data = [
                    "validation_1" => @$request->validation_1,
                    "validation_2" => @$request->validation_2,
                ];
                $verification->validations = json_encode($data);
                $verification->save();
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Velidation updated successfully."
                );
            }
            $data = $request->all();
            $verification = new Verification();
            $verification->name = "before-after";
            $verification->verification_type_id = $data["verificationType"];
            $verification->verification_type_text_id = 0;
            $verification->problem_id = Crypt::decrypt($data["problem_id"]);
            $verification->solution_id = Crypt::decrypt($data["solution_id"]);
            $verification->solution_function_id = $data["solution_fun_id"];
            $verification->user_id = Auth::user()->id;
            $verification->type = 0;
            $verification->file = 0;
            $verification->save();
            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
            }
        }

        /////////////////
        $verification = Verification::find($request->id);
        $data = $request->all();
        $verification->validations = json_encode($data);
        $verification->save();
        $success["verification"] = $verification;
        return $this->sendResponse(
            $success,
            "Velidation updated successfully."
        );
    }

    public function storeTimeVerification(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "date" => "required",
            "solution_hold" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        // echo "<pre>";print_r());die;
        try {            
            if ($request->id == "") {
                $verification = new TimeVerification();
            } else {
                $verification = TimeVerification::find($request->id);
            }
            $verification->user_id = Auth::user()->id;
            $verification->project_id = $request->project_id;
            $verification->problem_id = $request->problem_id;
            $verification->date = date('Y-m-d H:i:s',strtotime($request->date));

            $verification->solution_hold = $request->solution_hold;
            $verification->save();
            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
            }
        } catch (Exception $e) {
            return $this->sendError("Error!", $e->getMessage()());
        }
    }
    public function deleteTimeVerification(Request $request)
    {
        try {
            //echo "<pre>";print_r($request->all());die;
            $delete = TimeVerification::where("id", "=", $request->id)->delete();
            if ($delete) {
                $success["delete_verification"] = true;
                return $this->sendResponse(
                    $success,
                    "Verification deleted successfully."
                );
            } else {
                $success["delete_verification"] = false;
                return $this->sendResponse($success, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function StorePastPresentTime(Request $request){
        $validator = Validator::make($request->all(), [
            "past_time" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            if ($request->id) {
                $PastAndPresentTime = PastAndPresentTime::find($request->id);
            } else {
                $PastAndPresentTime = new PastAndPresentTime();
            }
            $data = $request->all();
            $PastAndPresentTime->problem_id = $data["problem_id"];            
            $PastAndPresentTime->project_id = $data["project_id"];
            $PastAndPresentTime->solution_id = $data["solution_id"];          
            $PastAndPresentTime->solution_function_id = $data["solution_function_id"];
            $PastAndPresentTime->user_id = Auth::user()->id;
            $PastAndPresentTime->time = date('Y-m-d H:i:s',strtotime($data["past_time"]));
            $PastAndPresentTime->verification_type_id = $data['verification_type_id'];
            $PastAndPresentTime->solution_hold = 1;
            $PastAndPresentTime->save();
            if ($PastAndPresentTime->id) {
                $success["verification"] = $PastAndPresentTime;
                return $this->sendResponse(
                    $success,
                    "Record saved successfully."
                );
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function DeletePastPresentTime(Request $request){
        try{
            $data = $request->all();

            if($data['data']){
                $delete = PastAndPresentTime::whereIn('id' , $data['data'])->delete();
                if($delete){
                    $success["delete_verification"] = true;
                return $this->sendResponse( $success,"Verification deleted successfully." );
                }else{
                    $success["delete_verification"] = false;
                     return $this->sendResponse($success, "Something Wrong.");
                }
            }
        }catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function storePricipleVerification(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "principle_type" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        
        try {
            
            if ($request->id) {
                $verification = PrincipleIdentificationMain::find($request->id);
            } else {
                $verification = new PrincipleIdentificationMain();
            }
            
            $data = $request->all();
            $verification->user_id = Auth::user()->id;
            $verification->project_id = Crypt::decrypt($data["project_id"]);
            $verification->problem_id = Crypt::decrypt($data["problem_id"]);
            $verification->principle_type = $data["principle_type"];
            if(isset($data["content"]) && !empty($data["content"])){
                $verification->content = ($data["content"]) ? $data["content"] : null;
            }
            
            $verification->created_at = date('Y-m-d H:i:s');
            $verification->save();

            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
            }

           
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function storePricipleIdentification(Request $request)
    {
    //    echo "<pre>";print_r($request->all());die;
        
           
            $data = $request->all();
            $insert = DB::table("principle_identification_drived_principle")->updateOrInsert(
                    ["id" => $request->id],
                    [
                        "user_id"=> Auth::user()->id,
                        "project_id" => Crypt::decrypt($data["project_id"]),
                        "problem_id" => Crypt::decrypt($data["problem_id"]),
                        "principle_type" => $data["principle_type"],
                        "principle_identification_id" => $data["principle_identification_id"],
                        "principle_main_id" => $data["principle_main_id"],
                        "applicable" => $data["applicable"]
                    ]
                );
                
            $success["verification"] = $insert;
            return $this->sendResponse($success,"Record saved successfully.");
                
                
            // return Redirect::back()->withSuccess(["msg" => "The Message"]);
        
        
        
    }

    public function storeEntityAvailable(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            "entity" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        
        try {
            $verificationID = null;
            //check if verificatoin type is added in verification table
            $verification = Verification::where(
                "verification_type_id",
                "=",
                $request->verificationType
            )->first();
            $data = $request->all();
           
            if ($verification) {
                $verificationID = $verification->id;
            } else {
                
                $verification = new Verification();
                $verification->name = "entity-available";
                $verification->verification_type_id = $data["verificationType"];
                $verification->verification_type_text_id = 0;
                $verification->problem_id = Crypt::decrypt($data["problem_id"]);
                $verification->solution_id = Crypt::decrypt(
                    $data["solution_id"]
                );
                $verification->solution_function_id = $data["solution_fun_id"];
                $verification->user_id = Auth::user()->id;
                $verification->type = 0;
                $verification->save();
                $verificationID = $verification->id;
            }
            // echo "<pre>";print_r($request->all());die;
            if ($request->updateProblemType == 0) {
                $file = null;
                $type = null;
                if ($request->hasFile("updateProblemFile")) {
                    $file =
                        time() . "." . $request->updateProblemFile->extension();
                    $request->updateProblemFile->move(
                        public_path(
                            "assets-new/verification_types/entity-available/"
                        ),
                        $file
                    );
                    $mime = mime_content_type(
                        public_path(
                            "assets-new/verification_types/entity-available/" .
                                $file
                        )
                    );
                    if (strstr($mime, "video/")) {
                        $type = 1;
                    } elseif (strstr($mime, "image/")) {
                        $type = 0;
                    }
                    $insert = DB::table("entity_available")->updateOrInsert(
                        ["id" => $request->entity_id],
                        [
                            "verification_id" => $verificationID,
                            "verification_type_id" => $data["verificationType"],
                            "media" => $file,
                            "entity" => $data["entity"],
                            "actual_entity" => $data["actual_entity"],
                            "type" => $type,
                            "formula" => $data["formula"],
                            "solution_id" => Crypt::decrypt($data["solution_id"]),
                            "problem_id"=> Crypt::decrypt($data["problem_id"]),
                            "project_id"=> Crypt::decrypt($data["project_id"]),
                            "solution_function_id"=> $data["solution_function_id"],
                            "user_id"=> Auth::user()->id,
                        ]
                    );
                } else {
                    $insert = DB::table("entity_available")->updateOrInsert(
                        ["id" => $request->entity_id],
                        [
                            "verification_id" => $verificationID,
                            "verification_type_id" => $data["verificationType"],
                            "entity" => $data["entity"],
                            "actual_entity" => $data["actual_entity"],
                            // "type" => $type,
                            "formula" => $data["formula"],
                            "solution_id" => Crypt::decrypt($data["solution_id"]),
                            "problem_id"=> Crypt::decrypt($data["problem_id"]),
                            "project_id"=> Crypt::decrypt($data["project_id"]),
                            "solution_function_id" => $data["solution_function_id"],
                            "user_id"=> Auth::user()->id,
                        ]
                    );
                }
            } else {
                $insert = DB::table("entity_available")->updateOrInsert(
                    ["id" => $request->entity_id],
                    [
                        "verification_id" => $verificationID,
                        "verification_type_id" => $data["verificationType"],
                        "media" => $data["updateProblemFileLink"],
                        "entity" => $data["entity"],
                        "type" => 2,
                        "formula" => $data["formula"],
                    ]
                );
            }

            $success["verification"] = true;
            return $this->sendResponse(
                $success,
                "Velidation updated successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    //delete Entity Availble // We are not using entities now in the entity available verification
    public function deleteEntityAvailable($id){
       
        try {
            $delete = Db::table("entity_available")
                ->where("id", "=", $id)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function createEntity(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "entity_name" => "required",
            "actual_enity" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        try {
            $data = $request->all();
            $insert = DB::table("entities")->updateOrInsert(
                ["id" => $request->id],
                [
                    
                    "entity" => $data["entity_name"],
                    "actual_entity" => $data["actual_enity"],
                    "selected" => $data["selection"],
                    "problem_id" => Crypt::decrypt($data["problem_id"]),
                    "project_id" => Crypt::decrypt($data["project_id"]),
                    "solution_id" => Crypt::decrypt($data["solution_id"]),
                    "solution_function_id" => $data["solution_fun_id"],
                    "user_id" => Auth::user()->id,
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Entity created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function deleteEntity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $entityDelete = Db::table("verification_entities")
                ->where("verId", "=", $verId)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Verification deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function createPartitionApproach(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            "word" => "required",
            "given" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        try {
            $data = $request->all();
            $insert = DB::table("partition_approach")->updateOrInsert(
                ["id" => $request->id],
                [
                    "user_id" => Auth::user()->id,
                    "verification_type_id" => 13,
                    'project_id' => $data["project_id"],
                    "word" => $data["word"],
                    "given" => $data["given"],
                    "solution_id" => $data["solution_id"],
                    "problem_id" => $data["problem_id"],
                    "part" => $data["part"],
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function updateValidations(Request $request)
    {
        try {
            $input = $request->all();
           
            $verification = Verification::find($input["id"]);
           
            // unset($input["id"]);
            // unset($input["id"]);
            if (!$verification) {
                $verification = new Verification();
                $verification->verification_type_id = $input["verification_type_id"];
                // $verification->verification_type_text_id =  $input['verification_type_text_id'];
                $verification->problem_id = $input["problem_id"];
                $verification->solution_id = $input["solution_id"];
                $verification->solution_function_id = $input["solution_fun_id"];
                $verification->user_id = Auth::user()->id;
                $verification->name = $input["name"];
            }else{
                
                $verification = Verification::Find($input["id"]);
            
            }
            
            $verification->validations = json_encode($input);
            
            $verification->save();
            $success["verification"] = $verification;
            return $this->sendResponse(
                $success,
                "Validation created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function storeCommunicationFlow(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "person_to" => "required",
            "subject" => "required",
            "comment" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        try {
            $data = $request->all();
            
            $insert = DB::table(
                "people_communication_flow"
            )->updateOrInsert(
                ["id" => @$request->id],
                [   
                    "project_id" => $data["project_id"],
                    "problem_id" => $data["problem_id"],
                    "customer_id" => $data["person_one"],
                    "person_to" => $data["person_to"],
                    "title" => $data["subject"],
                    "comment" => $data["comment"],
                    "user_id" => Auth::user()->id,

                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }



    public function deleteCommunicationFlow(Request $request){        
        $validator = Validator::make($request->all(), [
            "id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $delete = Db::table("people_communication_flow")
                ->where("id", "=", $request->id)
                ->delete();
            if ($delete) {
                $success["delete_"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function storeProblemDevelopmnt(Request $request){
        $validator = Validator::make($request->all(), [
            "error_name" => "required",
            "error_date" => "required",
            "problem_date" => "required",
            "problem_name" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $data =  $request->all();



            $insert = DB::table(
                "problem_development"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "user_id" => Auth::user()->id,
                    "verification_type_id" => 15,
                    "error_name" => $data["error_name"],
                    "error_date" =>  date('Y-m-d H:i:s',strtotime($data["error_date"])),
                    "problem_date" => date('Y-m-d H:i:s',strtotime($data["problem_date"])),
                    "problem_name" => $data["problem_name"],
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }

    // Problem development delete
    public function deleteProblemDevelopmnt($id){
        // $validator = Validator::make($id, [
        //     "id" => "required",
        // ]);
        // if ($validator->fails()) {
        //     return $this->sendError("Validation Error.", $validator->errors());
        // }
        try {
            $delete = Db::table("problem_development")
                ->where("id", "=", $id)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    /////////Error Correction Aproach/////////////

    public function addErrorCorectionAproach(Request $request){
        
        $validator = Validator::make($request->all(), [
                "compensator" => "required",
                "compensator_date" => "required|date",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error.", $validator->errors());
            }
        try{
            $problemDevelopment_count =  DB::table('problem_development')->get();
            $error_correction_count = ErrorCorrection::all();
            
            // if($error_correction_count->count() <= $problemDevelopment_count->count() && $request->id == ''){
            //     return $this->sendError("Compensator Error.", ['Compensator can not exceed more than errors!']);
            // }

            if($request->id != ''){
                $ErrorCorrection = ErrorCorrection::find($request->id);
            }else{
                $ErrorCorrection = new ErrorCorrection();
            }
            
            // $ErrorCorrection = new ErrorCorrection();
            $ErrorCorrection->project_id = $request->project_id;
            $ErrorCorrection->problem_id = $request->problem_id;
            $ErrorCorrection->user_id = Auth::user()->id;
            $ErrorCorrection->error_id = $request->error_id;
            $ErrorCorrection->compensator = $request->compensator;  
            $ErrorCorrection->compensator_date = date('Y-m-d H:i:s' , strtotime($request->compensator_date));  
            $ErrorCorrection->save();
            DB::table('problem_development')->where('id' , $request->error_id)->update(['compensator'=>1]);
            $success["error-corection"] = $ErrorCorrection;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(\Illuminate\Database\QueryException $e){
            return $this->sendError("Database Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }


    public function feedbackIdentification(Request $request){
        $params = $request->all();
        
        $project_id = $params['project_id'];
        $problem_id = $params['problem_id'];
        $problemDevelopment = DB::table('problem_development')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
        
        $feedBack = db::table('feedback_identifications')->select('feedback_identifications.*' , 'problem_development.error_name' )
                    ->leftJoin('problem_development', 'feedback_identifications.error_id', '=', 'problem_development.id')
                    ->where('feedback_identifications.user_id' , Auth::user()->id)
                    ->where('feedback_identifications.project_id' , $project_id)
                    ->get();
        
        return view("adult.verification.view.feed-back-identification" , compact("problemDevelopment" , "feedBack" , 'params' ,'problem_id' , 'project_id' ));
    }

    public function storeFeedbackIdentification(Request $request){
       
        $validator = Validator::make($request->all(), [
            "error" => "required",
            "feedback" => "required",
            "date" => "required",
            "from-person" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        
        try {
            $data =  $request->all();
            $insert = DB::table(
                "feedback_identifications"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "error_id" => $data["error"],
                    "feedback" => $data["feedback"],
                    "feedback_date" => date('Y-m-d H:i:s', strtotime($data["date"])),
                    "user_id" => Auth::user()->id,
                    "from_person" => $data["from-person"],
                    "project_id" => $data["project_id"] 
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }

    public function DeleteFeedbackIdentification($id){
        try {            
            $delete = Db::table("feedback_identifications")
                ->where("id", "=", $id)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = $delete;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                return $this->sendResponse($error, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function errorCorrection(Request $request){
        
        $params = $request->all();
        $project_id = $params['project_id'];
        $problemDevelopment = DB::table('problem_development')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
        $compensators = DB::table('error_correction')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
        $feedBack = DB::table('feedback_identifications')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
        $error_correction_type = db::table('error_correction_type')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
        
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
            $compensator_ids = DB::table('error_correction')->whereIn('id' , $errorcorrection->compensator)->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
            
            
            
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
       
        

        
        $errorcorrections = db::table('error_correction_type')->where('user_id' , Auth::user()->id)->where('project_id' , $project_id)->get();
       
        //  echo "<pre>";print_r($errorcorrections);die;
               
        return view("adult.verification.view.error-corection" ,  compact("problemDevelopment" ,"compensators" , "feedBack" , "errorcorrections" , "errors" , "compensator" ,'params' ,'project_id'));
    }


    public function storeErrorCorrection(Request $request){        
        $validator = Validator::make($request->all(), [
            "error" => "required",
            "feedback" => "required",
            "compensator" => "required",
          
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        //error_correction_type
        // echo "<pre>";print_r($request->all());die;
        try {
            $data =  $request->all();
            $error = null;
            $compensator = null;
            if(is_array($data['error'])){
                $error =  json_encode($data['error']);          
            }
            if(is_array($data['compensator'])){
                $compensator =  json_encode($data['compensator']);          
            }
            $insert = DB::table(
                "error_correction_type"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "error" => $error,
                    "compensator" => $compensator,
                    "feedback" => $data["feedback"],
                    "feedback_applied" => $data["feedback_applied"],
                    "user_id" => Auth::user()->id,
                    "project_id" => $data["project_id"] 
                ]
            );
            $success["error"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    public function deleteErrorCorrection(Request $request){
        try {            
            
            $delete = Db::table(''.$request->table_name.'')->where("id", "=", $request->id)
                ->delete();
            if ($delete) {
                $success["delete_verification"] = true;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                $success["delete_verification"] = false;
                return $this->sendResponse($success, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }

    ///function Function Adjustment
    public function storeFunctionAdjustment(Request $request){
        // echo "<pre>";print_r($request->all());die;
        $validator = Validator::make($request->all(), [
            "function_name" => "required",
            "problem_name" => "required",
            "solution_fun_id" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $data =  $request->all();
            $insert = DB::table(
                "function_adjustments"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "solution_function_id" => $data["solution_fun_id"],
                    "problem_name" => $data["problem_name"],
                    "user_id" => Auth::user()->id,                   
                    "function_name" => $data["function_name"],
                    
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }
    public function functionAdjustment(Request $request){
        return view("adult.verification.view.error-corection" );
    }



    // Function Substitution and People

    public function functionSustitutionAndPeople(Request $request){
        
        $validator = Validator::make($request->all(), [
            "customer" => "required",
        ]);
        if ($validator->fails()) {
           
            return $this->sendError("Validation Error.", $validator->errors());
        }


        try {

            $data =  $request->all();
            $checkifSelected = DB::table("function_belong_to_people")->where("customer_id" , $data["customer"])->first();
           
            if($checkifSelected){
                $error["success"] = false;
                return $this->sendError("Validation Error.", [
                    "error" => 'User Already selected',
                ]);
            }

            $insert = DB::table(
                "function_belong_to_people"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "solution_function_id" => $data["solution_fun_id"],
                    "user_id" => Auth::user()->id,                   
                    "customer_id" => $data["customer"],
                    
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }



    public function SolutionFunctionAverage(Request $request){
        
        $validator = Validator::make($request->all(), [
            "problem_part" => "required|numeric",
            "solution_value" => "required|numeric",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $data =  $request->all();
           
            $insert = DB::table(
                "averaging_approach"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "solution_function_id" => $data["solution_fun_id"],
                    "user_id" => Auth::user()->id,                   
                    "solution_value" => $data["solution_value"],
                    "problem_part" => $data["problem_part"],
                    
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }


    //Replace Problem By Problem

    public function replaceProblemByProblem(Request $request){
        try {
            $data =  $request->all();
           
            $insert = DB::table(
                "replace_problem_by_problem"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "solution_function_id" => $data["solution_function_id"],
                    "user_id" => Auth::user()->id,                   
                    "replaced" => true
                    
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
        try {
            $data =  $request->all();
           
            $insert = DB::table(
                "replace_problem_by_problem"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "solution_function_id" => $data["solution_function_id"],
                    "user_id" => Auth::user()->id,                   
                    "replaced" => true
                    
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }


    public function deletePeopleFromProject(Request $request){
        try {            
            $deletCommunication  = DB::table('people_communication_flow')->where('customer_id' , $request->id)->orWhere('person_to' , $request->id)->delete();
            $delete = Db::table('customers')->where("id", "=", $request->id)
                ->delete();

            if ($delete) {
                $success["delete_verification"] = true;
                return $this->sendResponse(
                    $success,
                    "Record deleted successfully."
                );
            } else {
                $success["delete_verification"] = false;
                return $this->sendResponse($success, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        }
    }


    public function storePassiveVoice(Request $request){
        try {
            
            $data =  $request->all();
            $insert = DB::table(
                "passive_voice"
            )->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "user_id" => Auth::user()->id, 
                    "added" => true,
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }


    public function storeResourceManagment(Request $request){
        try {
            // echo "<pre>";print_r($request->all());die;
            $data =  $request->all();
            $file = time() . "." . $request->file->extension();
            $request->file->move(public_path("assets-new/verification_types/resource-managment/"),$file);
            $mime = mime_content_type(public_path("assets-new/verification_types/resource-managment/" .$file ));
            if (strstr($mime, "video/")) {
                $type = 1;
            } elseif (strstr($mime, "image/")) {
                $type = 0;
            }
            $insert = DB::table("resource_management")->updateOrInsert(
                ["id" => @$request->id],
                [
                    "problem_id" => $data["problem_id"],
                    "project_id" => $data["project_id"],
                    "solution_id" => $data["solution_id"],
                    "user_id" => Auth::user()->id, 
                    "file" => $file,
                    'type' => $type
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(Exception $e){
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage(),
            ]);
        } 
    }

}
