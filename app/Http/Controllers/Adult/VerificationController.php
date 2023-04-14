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
use Auth;
use Redirect;
use Validator;


class VerificationController extends BaseController
{
   

    public function index($data = null , $type = null){  

        $params = Crypt::decrypt($data);
        $problem_id = $params['problem_id'];
        $project_id = $params['project_id']; 

        if($problem_id == ''){    
            return Redirect::back()->withErrors(['msg' => 'Verificatioon must have Solution function identified.']);
        }   

        $verificationType = null;
        $verifiationTypeText = null;
        $verification = null;
            
        //get problem
        $problem = Problem::where('id' , '=' , $problem_id)->first();
        //get solution
        $solution = Solution::where('problem_id' , '=' , $problem_id)->first();
        //get solution function
        $Solution_function = SolutionFunction::where('problem_id' , '=' , $problem_id)->first();

        if(!isset($Solution_function->id )){    
            return Redirect::back()->withErrors(['msg' => 'Verificatioon must have Solution function identified.']);
        } 
        //get Verification
        $verification = Verification::where('problem_id' , '=' , $problem_id)
                                    ->where('verification_type_id' , '=' , $type)
                                    ->where('solution_function_id' , '=' , $Solution_function->id)->first();  

        if($type != ''){
            $verificationType = VerificationType::where('id', '=' , $type)->first();
           
            $verificationType->validation_questions = json_decode($verificationType->validation_questions);
            $verifiationTypeText = VerificationTypeText::where('verification_type_id', $type)->get();
        }    
     
        $solution_id = $solution->id;      
        // echo "<pre>";print_r($verificationType);die;

        $types = VerificationType::orderBy("id", "asc")->get();

        switch($type){
            case 1:
                return view('adult.verification.view.vocabulary-content', [
                    'types' => $types, 
                    'verificationType' => $verificationType, 
                    'verification' => $verification, 
                    'problem_id' => $problem_id, 
                    'project_id' => $project_id,
                    'problem' => $problem,
                    'solution' => $solution,
                    'solution_id' => $solution_id, 
                    'Solution_function' => $Solution_function,
                    'verificationTypeText' => $verifiationTypeText
                ]);
                break;
            case 2:
                return view('adult.verification.view.information-content', [
                    'types' => $types, 
                    'verificationType' => $verificationType, 
                    'verification' => $verification, 
                    'problem_id' => $problem_id, 
                    'project_id' => $project_id,
                    'problem' => $problem,
                    'solution' => $solution,
                    'solution_id' => $solution_id, 
                    'Solution_function' => $Solution_function,
                    'verificationTypeText' => $verifiationTypeText
                ]);
                    break;
            case 3:
                return view('adult.verification.view.before-after-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 4:
                return view('adult.verification.view.separation-step',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 5:
                return view('adult.verification.view.time-verification-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 6:
                return view('adult.verification.view.past-present-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 7:
                return view('adult.verification.view.entity-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 8:
                return view('adult.verification.view.solution-time-location1-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 9:
                return view('adult.verification.view.solution-time-location2-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 10:
                return view('adult.verification.view.people-project-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 11:
                return view('adult.verification.view.people-communication-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 12:
                return view('adult.verification.view.communication-flow-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 13:
                return view('adult.verification.view.partition-approch-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            case 14:
                return view('adult.verification.view.principle-identification-content',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
                    break;
            default:
                return view('adult.verification.index',compact('types' , 
                    'verificationType' , 
                    'verification' , 
                    'problem_id' , 
                    'project_id',
                    'problem',
                    'solution',
                    'solution_id' , 
                    'Solution_function','verifiationTypeText'));
        }

    }

    public function store(Request $request){
        //  echo "<pre>";print_r($request->all());die;
        $validator = Validator::make ( $request->all(),[
            // 'varificationName' => 'required|max:255',
            'problem_id' => 'required',
            'solution_id' => 'required',
            'solution_fun_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            

                if($request->id != ''){
                    $verification = Verification::find($request->id);
                    $verification->verification_type_id = $request->verificationType;
                    $verification->verification_type_text_id = $request->verification_type_text_id;
                    $verification->problem_id = Crypt::decrypt($request->problem_id);;
                    $verification->solution_id =  Crypt::decrypt($request->solution_id);
                    $verification->solution_function_id = $request->solution_fun_id;
                    $verification->user_id = Auth::user()->id;
                    $verification->type = 0;
                    $verification->save();
                }else{
                    $verification = new Verification();
                    $verification->verification_type_id = $request->verificationType;
                    $verification->verification_type_text_id = $request->verification_type_text_id;
                    $verification->problem_id = Crypt::decrypt($request->problem_id);;
                    $verification->solution_id =  Crypt::decrypt($request->solution_id);
                    $verification->solution_function_id = $request->solution_fun_id;
                    $verification->user_id = Auth::user()->id;
                    $verification->type = 0;
                    $verification->save();
                }
               
                $success['verification'] =  $verification;
               
                return $this->sendResponse($success, 'Verification created successfully.');
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }

    
}
