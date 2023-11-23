<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Problem;
use App\Models\Solution;
use App\Models\SolutionType;
use App\Models\SolutionFunction;
use App\Models\Setting;
use App\Models\Verification;
use App\Models\VerificationType;
use App\Models\VerificationTypeText;
use App\Models\VerificationEntity;
use App\Models\ErrorCorrection;
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

        if ($problem_id == "") {
            return Redirect::back()->withErrors([
                "msg" =>
                    "Verificatioon must have Solution function identified.",
            ]);
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
                        "solutionTypes"
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
                        "entity"
                    )
                );
                break;
            case 5:
                $allVarifications = Verification::where(
                    "verification_type_id",
                    "=",
                    5
                )->get();
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
                        "allVarifications"
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
                        "allVarifications"
                    )
                );
                break;
            case 7:
                $givenSet = DB::table("verifications")
                    ->where("verification_type_id", "=", 14)
                    ->first();
                $entities = DB::table("entity_available")
                    ->where("type", "=", 0)
                    ->get();
                $entitiestbl = DB::table("entities")->get();
                $principle_identification_type = $givenSet->type == 0 ? 1 : 2;
                $allVarifications = DB::table("principle_identification")
                    ->where("type", "=", $principle_identification_type)
                    ->get();
                
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
                        "entitiestbl",
                        "allVarifications"
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
                        "users"
                    )
                );
                break;
            case 12:
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
                        "users"
                    )
                );
                break;
            case 13:
                $entities = DB::table("partition_approach")->get();
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
                    ->first();
                   
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
                        "users"
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

                $problemDevelopment = DB::table('problem_development')->get();


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
                    
                    $errorcorrection = DB::table('error_correction')->get();
                    // $problemDevelopment = DB::table('problem_development')->get();

                    $problemDevelopment = db::table('problem_development')->select('problem_development.*' , 'error_correction.compensator' )
                                        ->leftJoin('error_correction', 'problem_development.id', '=', 'error_correction.error_id')
                                        ->get();
                    //   echo "<pre>";print_r($data);die;                      
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
                "error" => $e->getMessage,
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
            return $this->sendError("Error.", ["error" => $e->getMessage()]);
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
                "error" => $e->getMessage,
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
                "error" => $e->getMessage,
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
                "error" => $e->getMessage,
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

        try {
            // echo "<pre>";print_r();die;
            if ($request->verification_id == "") {
                $verification = new Verification();
            } else {
                $verification = Verification::find($request->verification_id);
            }

            $verification->name = "time-verification";
            $verification->user_id = Auth::user()->id;
            $verification->problem_id = $request->problem_id;
            $verification->verification_type_id =
            $request->verification_type_id;
            $verification->solution_id = $request->solution_id;
            $verification->solution_function_id = $request->solution_function_id;
            $verification->verification_type_text_id = 1; //static
            $verification->type = 0;
            $verification->key = strtotime($request->date);
            $verification->val = $request->solution_hold;
            $verification->save();
            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
            }
        } catch (Exception $e) {
            return $this->sendError("Error!", $e->getMessage());
        }
    }
    public function deleteTimeVerification(Request $request)
    {
        try {
            //echo "<pre>";print_r($request->all());die;
            $delete = Verification::where("id", "=", $request->id)->delete();
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
                "error" => $e->getMessage,
            ]);
        }
    }

    public function storePricipleVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "applicable" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            if ($request->id) {
                $verification = Verification::find($request->id);
            } else {
                $verification = new Verification();
            }
            $data = $request->all();

            $verification->name = "principle-identification";
            $verification->verification_type_id = $data["verificationType"];
            $verification->verification_type_text_id = 0;
            $verification->problem_id = Crypt::decrypt($data["problem_id"]);
            $verification->solution_id = Crypt::decrypt($data["solution_id"]);
            $verification->solution_function_id = $data["solution_fun_id"];
            $verification->user_id = Auth::user()->id;
            $verification->type = $data["applicable"];

            // $verification->val = $data['applicable'];
            $verification->save();
            if ($verification->id) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Verification created successfully."
                );
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
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage,
            ]);
        }
    }

    public function storePricipleIdentification(Request $request)
    {
        if (isset($request->content) && $request->content !== "") {
            $verification = DB::table("principle_identification")->update([
                "content" => $request->content,
            ]);
            return Redirect::back()->withSuccess(["msg" => "The Message"]);
        }
        $validator = Validator::make($request->all(), [
            "applicable" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        try {
            $verification = DB::table("principle_identification")
                ->where("id", "=", $request->pricple_identify_id)
                ->update(["applicable" => $request->applicable]);
            if ($verification) {
                $success["verification"] = $verification;
                return $this->sendResponse(
                    $success,
                    "Record updated successfully."
                );
            }
            $success["verification"] = true;
            return $this->sendResponse(
                $success,
                "Velidation updated successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage,
            ]);
        }
    }

    public function storeEntityAvailable(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "entity" => "required",
        ]);
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }
        // echo "<pre>";print_r($request->all());die;
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
                            "type" => $type,
                            "formula" => $data["formula"],
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
                "error" => $e->getMessage,
            ]);
        }
    }

    public function createEntity(Request $request)
    {
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
                    "verification_id" => $data["verificationID"],
                    "entity" => $data["entity_name"],
                    "actual_entity" => $data["actual_enity"],
                    "selected" => $data["selection"],
                ]
            );
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Entity created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage,
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
                "error" => $e->getMessage,
            ]);
        }
    }

    public function createPartitionApproach(Request $request)
    {
        // echo "<pre>";print_r($request->all());die;
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
                    "verification_type_id" => 13,
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
                "error" => $e->getMessage,
            ]);
        }
    }

    public function updateValidations(Request $request)
    {
        try {
            $input = $request->all();

            $verification = Verification::find($input["id"]);

            unset($input["id"]);
            if (!$verification) {
                $verification = new Verification();
                $verification->verification_type_id =
                    $input["verification_type_id"];
                // $verification->verification_type_text_id =  $input['verification_type_text_id'];
                $verification->problem_id = $input["problem_id"];
                $verification->solution_id = $input["solution_id"];
                $verification->solution_function_id = $input["solution_fun_id"];
                $verification->user_id = Auth::user()->id;
                $verification->name = $input["name"];
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
                "error" => $e->getMessage,
            ]);
        }
    }

    public function storeCommunicationFlow(Request $request)
    {
        try {
            $data = $request->all();

            if ($request->hasFile("file")) {
                $file = time() . "." . $request->file->extension();
                $request->file->move(
                    public_path("assets-new/communication/"),
                    $file
                );
                $mime = mime_content_type(
                    public_path("assets-new/communication/" . $file)
                );
                if (strstr($mime, "video/")) {
                    $type = 1;
                } elseif (strstr($mime, "image/")) {
                    $type = 0;
                }
                $insert = DB::table(
                    "people_communication_flow"
                )->updateOrInsert(
                    ["id" => @$request->id],
                    [
                        "customer_id" => $data["user_id"],
                        "file" => $file,
                        "type" => $type,
                        "title" => $data["title"],
                        "comment" => $data["comment"],
                    ]
                );
            } else {
                $insert = DB::table(
                    "people_communication_flow"
                )->updateOrInsert(
                    ["id" => @$request->id],
                    [
                        "customer_id" => $data["user_id"],
                        "file" => $data["link"],
                        "type" => 2,
                        "title" => $data["title"],
                        "comment" => $data["comment"],
                    ]
                );
            }
            $success["entity"] = $insert;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        } catch (Exception $e) {
            return $this->sendError("Validation Error.", [
                "error" => $e->getMessage,
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
                "error" => $e->getMessage,
            ]);
        } 
    }

    /////////Error Correction Aproach/////////////

    public function addErrorCorectionAproach(Request $request){
        // echo "<pre>";print_r($request->all());die;
        try{
            // echo "<pre>";print_r($request->all());die;
            $ErrorCorrection = new ErrorCorrection();
            $ErrorCorrection->project_id = $request->project_id;
            $ErrorCorrection->problem_id = $request->problem_id;
            $ErrorCorrection->user_id = Auth::user()->id;
            $ErrorCorrection->error_id = $request->error_id;
            $ErrorCorrection->compensator = $request->compensator;            
            $ErrorCorrection->save();
            $success["error-corection"] = $ErrorCorrection;
            return $this->sendResponse(
                $success,
                "Record created successfully."
            );
        }catch(\Illuminate\Database\QueryException $e){
            return $this->sendError("Database Error.", [
                "error" => $e->getMessage,
            ]);
        }
    }


    public function feedbackIdentification(){
        
    }
}
