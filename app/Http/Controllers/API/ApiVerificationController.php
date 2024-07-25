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
           $verifications = VerificationType::all();
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
                    $entities = VerificationEntity::where("verTypeId", "=", $type)->where("verId", $verification->id)->get();
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



    
    

}