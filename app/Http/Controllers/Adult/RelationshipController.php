<?php

namespace App\Http\Controllers\Adult;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Relationship;
use App\Models\SolutionFunction;
use App\Models\Solution;
use App\Models\Verification;
use DB;
use Auth;
use Validator;

class RelationshipController extends BaseController
{
    public function index($data = null, $type = null){     
        
        $params = Crypt::decrypt($data);
        
        if($params['problem_id'] == ''){
            return Redirect::back()->withErrors(['message' => 'Problem must be define or project must be selected']);
        }
        
        $relationships = Relationship::all();
        $view = null;
        $veiwParams = null;
        $relationship    =  Relationship::where('id' , $type)->first();
        $condition       = ['problem_id'=> $params['problem_id'] , 'project_id'=>$params['project_id'] ,'user_id' => Auth::user()->id];
        $validations     =  DB::table('rel_validations')->where($condition)->where('id' , $type)->first();
        
        switch($type){
            case 1: 
                $custommers      =  DB::table("customers")->where("project_id", "=", $params['project_id'])->get();
                $communications  =  $this->getCommunication($params);
                $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                'project_id'=> $params['project_id'],
                                'relationships'=>$relationships , 
                                'relationship'=>$relationship,
                                'custommers'=>$custommers,
                                'communications'=>$communications, 'validations'=>$validations];
                                return view('adult.relationship.communication_and_people_relationship_explanation' , $veiwParams);
                break;
                case 2: 
                   
                    $principal = DB::table('principle_identification_main')->where($condition)->first();
                    $communications  = $this->getCommunication($params);
                    
                    $view = 'adult.relationship.communication_and_people_principal_explanation';
                    $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                    'project_id'=> $params['project_id'],
                                    'relationships'=>$relationships , 
                                    'relationship'=>$relationship,
                                    'communications'=>$communications, 'validations'=>$validations,'principal'=>$principal];
                        return view('adult.relationship.communication_and_people_principal_explanation' , $veiwParams);            
                case 3: 
                    $communications  =   $this->getCommunication($params);
                    $Solution_function =  $Solution_function = SolutionFunction::where($condition)->first();
                   
                    $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                    'project_id'=> $params['project_id'],
                                    'relationships'=>$relationships , 
                                    'relationship'=>$relationship,
                                    'communications'=>$communications, 'validations'=>$validations , 'Solution_function'=>$Solution_function];
                    return view('adult.relationship.communication_and_solution_function_relationship_explanation' , $veiwParams); 
                case 4: 
                    $communications  =  $this->getCommunication($params);
                    $Solution  = Solution::where($condition)->first();
                   
                    $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                    'project_id'=> $params['project_id'],
                                    'relationships'=>$relationships , 
                                    'relationship'=>$relationship,
                                    'communications'=>$communications, 'validations'=>$validations , 'Solution'=>$Solution];
                    return view('adult.relationship.communication_and_solution_relationship_explanation' , $veiwParams); 
                case 5: 
                    $principal = DB::table('principle_identification_main')->where($condition)->first();
                    $entitieUsage = DB::table("entity_usage")->where($condition)->first();
                    
                    $view = '';
                    $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                    'project_id'=> $params['project_id'],
                                    'relationships'=>$relationships , 
                                    'relationship'=>$relationship,
                                    'validations'=>$validations,'principal'=>$principal,'entitieUsage'=>$entitieUsage];
                        return view('adult.relationship.entity_usage_and_principle_relationship_explanation' , $veiwParams); 
                    case 6: 
                    $Solution  = Solution::where($condition)->first();
                    $entitieUsage = DB::table("entity_usage")->where($condition)->first();
                    $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                    'project_id'=> $params['project_id'],
                                    'relationships'=>$relationships , 
                                    'relationship'=>$relationship,
                                    'validations'=>$validations,'entitieUsage'=>$entitieUsage,'Solution'=>$Solution];
                        return view('adult.relationship.entity_usage_solutionrelationship' , $veiwParams); 
                    break;
                    case 7: 
                        $verification = Verification::where("problem_id", "=", $params['problem_id'])
                                    ->where("verification_type_id", "=", 2)
                                    ->first();
                        $principal = DB::table('principle_identification_main')->where($condition)->first();
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'principal'=>$principal,'verification'=>$verification];
                        return view('adult.relationship.info_principal' , $veiwParams);
                    break;
                    case 8: 
                        $verification = Verification::where("problem_id", "=", $params['problem_id'])
                        ->where("verification_type_id", "=", 2)
                        ->first();
                        $Solution  = Solution::where($condition)->first();
                        
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'verification'=>$verification,'Solution'=>$Solution];
                        return view('adult.relationship.info_sol' , $veiwParams);
                    break;
                    case 9: 
                        $custommers      =  DB::table("customers")->where("project_id", "=", $params['project_id'])->get();
                        $principal = DB::table('principle_identification_main')->where($condition)->first();
                        
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'principal'=>$principal,'custommers'=>$custommers];
                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                    case 10: 
                        $Solution_function =  $Solution_function = SolutionFunction::where($condition)->first();
                        $principal = DB::table('principle_identification_main')->where($condition)->first();
                        
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'principal'=>$principal,'Solution_function'=>$Solution_function];
                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                    case 11: 
                        $Solution  = Solution::where($condition)->first();
                        $principal = DB::table('principle_identification_main')->where($condition)->first();
                        
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'principal'=>$principal,'Solution'=>$Solution];
                                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                    case 12: 
                        //voucab
                        $principal = DB::table('principle_identification_main')->where($condition)->first();
                        $words = DB::table('verification_entities')->where(['problem_id'=> $params['problem_id'] , 'project_id'=>$params['project_id']])->get();
                      
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'principal'=>$principal , 'words'=>$words];
                                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                    case 13: 
                        $entitieUsage = DB::table("entity_usage")->where($condition)->first();
                        $Solution  = Solution::where($condition)->first();
                        
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'Solution'=>$Solution , 'entitieUsage'=>$entitieUsage];
                                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                    case 14: 
                        $Solution_function =  $Solution_function = SolutionFunction::where($condition)->first();
                        $custommers      =  DB::table("customers")->where("project_id", "=", $params['project_id'])->get();
                       
                        $veiwParams = ['problem_id'=>$params['problem_id'] , 
                                        'project_id'=> $params['project_id'],
                                        'relationships'=>$relationships , 
                                        'relationship'=>$relationship,
                                        'validations'=>$validations,'Solution_function'=>$Solution_function , 'custommers'=>$custommers];
                                        return view('adult.relationship.principal_and_people' , $veiwParams);
                    break;
                default:
                 $view = 'adult.relationship.index';
                 $veiwParams = ['problem_id'=>$params['problem_id'] , 'project_id'=> $params['project_id'] ,'relationships'=>$relationships];
                 
        }
        
        return view($view,$veiwParams);
    }


    public function getCommunication($params){
        return DB::table('people_communication_flow')
                        ->select('people_communication_flow.*' , 'customers.name AS customer_name' )
                        ->leftJoin('customers', 'people_communication_flow.customer_id', '=', 'customers.id')
                        ->where('people_communication_flow.user_id' , Auth::user()->id)
                        ->where('people_communication_flow.project_id' , $params['project_id'])
                        ->where('people_communication_flow.problem_id' , $params['problem_id'])
                        ->get();
    }

    public function SaveValidations(Request $request){
        $validator = Validator::make($request->all(), [
            "problem_id" => "required",
            "project_id" => "required",
            
        ]);
        
        if ($validator->fails()) {
            return $this->sendError("Validation Error.", $validator->errors());
        }

        try {
            $insert = DB::table("rel_validations")->updateOrInsert(
                ["id" => $request->id],
                [
                    "user_id"=> Auth::user()->id,
                    "project_id" => $request->project_id,
                    "problem_id" => $request->problem_id,
                    "user_id"   => Auth::user()->id,
                    "ans" => json_encode($request->ans),
                    "created_at" => date('Y-m-d H:i:s'),

                ]
            );
            if ($insert) {
                $success["success"] = $insert;
                return $this->sendResponse(
                    $success,
                    "Vadlidation recorded successfully."
                );
            } else {
                $success["success"] = $insert;
                return $this->sendResponse($success, "Something Wrong.");
            }
        } catch (Exception $e) {
            return $this->sendError("Error.", ["error" => $e->getMessage()()]);
        }
    }




}
