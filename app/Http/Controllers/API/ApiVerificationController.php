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

        $verifications = VerificationType::all();
        if ($request->verification_id) {
            
            $verification =  null;
            $success = [];
            $type = $request->verification_id;
            switch ($type) {
                case 1:
                    $transitionPhrase = DB::table('verification_type_texts')->where('verification_type_id' , $request->verification_id)->first();
                    $verification = Verification::where("verification_type_id",$request->verification_id)->where('problem_id', $request->problem_id)->where('user_id', Auth::user()->id)->first();
                    $entities = VerificationEntity::where("verTypeId", "=", $type)->where("verId", $request->verification_id)->get();
                    $success['transitionPhrase'] =  $transitionPhrase;
                    $success['entities'] =  $entities;
                break;
                default:
                $verification = null;

            }
            $success["verification"] = $verification;
            $success["verifications"] = $verifications;
            $success["token"] = $request->header("Authorization");
            return $this->sendResponse($success, "true");
        }else {
            $success["verifications"] = $verifications;
            $success["token"] = $request->header("Authorization");
            $success["solution"] = null;
            return $this->sendResponse($success, "false");
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
    
     public function AddverificationVocablary(Request $request)
     {
        echo "<pre>";print_r($request->all());die;
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
                     "Verification created successfully."
                 );
             } else {
                 return $this->sendResponse($error, "Something Wrong.");
             }
         } catch (Exception $e) {
             return $this->sendError("Error.", ["error" => $e->getMessage()()]);
         }
     }

}