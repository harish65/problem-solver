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
use DB;
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
       
        if($problem)
        {
            $problem_name = $problem->name;
        }
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
            
            if($verification != ''){
                $entity = VerificationEntity::where('verTypeId', '=', $type)->where('verId', '=', $verification->id)->get();
            }else{
                $entity = VerificationEntity::where('verTypeId', '=', $type)->get();
            }
        }  
        if(isset($verification->validations)){
            $verification->validations = json_decode($verification->validations);
        }
        
        $solution_id = $solution->id; 
        $solutionTypes = DB::table('solution_types')->get();       

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
                    'verificationTypeText' => $verifiationTypeText,
                    'entity' =>$entity
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
                    'verificationTypeText' => $verifiationTypeText,
                    'entity' =>$entity
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
                    'Solution_function','verifiationTypeText','entity','solutionTypes'));
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
                    'Solution_function','verifiationTypeText','entity'));
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
                    'Solution_function','verifiationTypeText','entity'));
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
                    'Solution_function','verifiationTypeText','entity'));
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
       
    
        $validator = Validator::make ($request->all(),[
            'verificationType' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{    
            $type = $request->verificationType;
            switch($type){
                case  1 :
                    //Vocablary Verification
                    $name  = 'Vocablary';
                   return $this->AddverificationVocablary($request , $name);
                    break;
                case 2 :
                    $name  = 'Information';
                    return $this->AddverificationVocablary($request , $name);
                    break;
                default:
                 return true;
            }
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }



    /**
     * Add Voucabalry Verification
     * 
     */
    public function AddverificationVocablary($request , $name){
       
        $validator = Validator::make ($request->all() , [
           
            'solution_fun_id' => 'required',
            'verificationType' => 'required',
            'verification_type_text_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        try{
            
                $data = $request->all();
                $verification = new Verification();
                $verification->name = $name;
                $verification->verification_type_id = $data['verificationType'];
                $verification->verification_type_text_id = $data['verification_type_text_id'];
                $verification->problem_id = Crypt::decrypt($data['problem_id']);;
                $verification->solution_id =  Crypt::decrypt($data['solution_id']);
                $verification->solution_function_id = $data['solution_fun_id'];
                $verification->user_id = Auth::user()->id;
                $verification->type = 0;
                $verification->file = $data['file'];
                $verification->save();
                if($verification->id){
                    $success['verification'] =  $verification;
                    return $this->sendResponse($success, 'Verification created successfully.');
                }else{
                    return $this->sendResponse($error, 'Something Wrong.');
                }
         
            
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }


    }
    public function delete(Request $request)
    {
        $validator = Validator::make ($request->all(),[
            'id' =>'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{    
            $type = $request->verificationType;
            $verId = $request->id;
            $delete = Verification::where('id' , '=' , $verId)->delete();
            if($delete)
            {   
                $success['delete_verification'] =  $delete;
                return $this->sendResponse($success, 'Verification deleted successfully.');
            }else{
                return $this->sendResponse($error, 'Something Wrong.');
            }
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }

    public function addVocabularyEntity(Request $request)
    {
        
        $validator = Validator::make ($request->all(),[
            'verificationType' => 'required',
            'key' => 'required',
            'value' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            
            $type = $request->verificationType;
            $verId = $request->id;
            $key = $request->key;
            $entity = $request->value;

            // add new row to varification_entity table
                  if(!$request->id){
                    $verificationEntity = new VerificationEntity();
                    $verificationEntity->verification_key = $key;
                    $verificationEntity->verification_value = $entity;
                    $verificationEntity->verId = $verId;
                    $verificationEntity->verTypeId = $type;
                    $verificationEntity->save();
                }else{
                    $verificationEntity = VerificationEntity::find($request->id);
                    $verificationEntity->verification_key = $key;
                    $verificationEntity->verification_value = $entity;
                    $verificationEntity->verId = $verId;
                    $verificationEntity->verTypeId = $type;
                    $verificationEntity->save();
                }
                    if($verificationEntity->id){
                        $success['verificationEntity'] =  $verificationEntity;
                        return $this->sendResponse($success, 'Verification Entity Has created successfully.');
                    }else{
                        return $this->sendResponse($error, 'Something Wrong.');
                    }

        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }

    public function deleteVocabulary(Request $request)
    {
        
        echo "<pre>";print_r($request->all());die;
        try{    
            $entityId = $request->id;
            $delete = VerificationEntity::where('id' , '=' ,$request->id)->delete();
            if($delete)
            {   
                $success['delete_verification'] =  $delete;
                return $this->sendResponse($success, 'Verification deleted successfully.');
            }else{
                return $this->sendResponse($error, 'Something Wrong.');
            }
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }

    public function addVocabularyValidations(Request $request){
        
            $verification = Verification::find($request->id);
            $data = $request->all();
            $verification->validations = json_encode($data);
            $verification->save();
            $success['verification'] =  $verification;
            return $this->sendResponse($success, 'Velidation updated successfully.');
    }



}
