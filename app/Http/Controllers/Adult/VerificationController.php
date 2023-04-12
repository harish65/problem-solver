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
use DB;


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
        $validationQuestions = null;
            
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

            $validationQuestions = DB::table('verification_validation_questions')->where('verificatoin_type_id' , '=' , $type)->get();
        }       

       
     
        $solution_id = $solution->id; 
        
        

        // foreach($verificationType->validation_questions as $validations){
        //     echo "<pre>";print_r($validations[0]);die;
        // }
        
        
        $types = VerificationType::orderBy("id", "desc")->get();
        return view('adult.verification.index',compact('types' , 
                                                        'verificationType' , 
                                                        'verification' , 
                                                        'problem_id' , 
                                                        'project_id',
                                                        'problem',
                                                        'solution',
                                                        'solution_id' , 
                                                        'Solution_function','verifiationTypeText','validationQuestions'));
    }

    public function store(Request $request){
        //  echo "<pre>";print_r($request->all());die;
        $validator = Validator::make ( $request->all(),[
            'name' => 'required|max:255',
            'problem_id' => 'required',
            'solution_id' => 'required',
            'solution_fun_id' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            $type =  null;
            $file = null;
                if($request->fileType == 0){
                    if($request->hasFile('imageFile')){
                            $file = time().'.'.$request -> imageFile -> extension();
                            $request -> imageFile -> move(public_path('assets-new/verifications/'), $file);
                            $mime = mime_content_type(public_path('assets-new/verifications/' . $file));
                            if(strstr($mime, "video/")){
                                $type = 1;
                            }else if(strstr($mime, "image/")){
                                $type = 0;
                            }
                        }
                }else{
                    $type = 2;
                }
                    //Update Code
                if($request->id != ''){
                    $verification = Verification::find($request->id);
                    $verification->verification_type_id = $request->verificationType;
                    $verification->verification_type_text_id = $request->verification_type_text_id;
                    $verification->problem_id = Crypt::decrypt($request->problem_id);;
                    $verification->solution_id =  Crypt::decrypt($request->solution_id);
                    $verification->solution_function_id = $request->solution_fun_id;
                    $verification->name = $request->name;

                    if($request->fileType == 2){
                        $verification->file = $request->youtubeLink;
                        $verification->type = 2;
                    }elseif ($request->fileType == 0){
                        $verification->file = $file;
                        $verification->type = $type;
                    }
                    $verification->user_id = Auth::user()->id;
                    $verification->type = $type;
                    $verification->save();
                }else{

                    //Insert code
                    $verification = new Verification();
                    $verification->verification_type_id = $request->verificationType;
                    $verification->verification_type_text_id = $request->verification_type_text_id;
                    $verification->problem_id = Crypt::decrypt($request->problem_id);;
                    $verification->solution_id =  Crypt::decrypt($request->solution_id);
                    $verification->solution_id =  Crypt::decrypt($request->solution_id);
                    $verification->solution_function_id = $request->solution_fun_id;
                    $verification->name = $request->name;

                    $verification->user_id = Auth::user()->id;
                    if($request->fileType == 2){
                        $verification->file = $request->youtubeLink;
                        $verification->type = 2;
                    }elseif ($request->fileType == 0){
                        $verification->file = $file;
                        $verification->type = $type;
                    }
                   
                   
                    $verification->save();
                }
               
                $success['verification'] =  $verification;
               
                return $this->sendResponse($success, 'Verification created successfully.');
        }catch(Exception $e){
            return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
        }
    }

    
}
