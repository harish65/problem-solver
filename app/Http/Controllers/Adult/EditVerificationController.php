<?php

namespace App\Http\Controllers\Adult;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verification;
use App\Models\VerificationEntity;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Redirect;
use Validator;

class EditVerificationController extends BaseController
{
        public function updateVerification(Request $request){
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
                               return $this->editVerificationVocablary($request);
                                break;
                            case 2 :
                                $this->editVerificationVocablary($request);
                                break;
                            default:
                             return true;
                        }
                    }catch(Exception $e){
                        return $this->sendError('Validation Error.', ['error'=> $e->getMessage]);  
                    }
        }
        public function editVerificationVocablary($request)
        {                
           // dd($request);
                $validator = Validator::make ($request->all() , [
                    'name' => 'required',
                    'id' => 'required', // id is verification id
                    'solution_fun_id' => 'required',
                    'verificationType' => 'required',
                    'verification_type_text_id' => 'required'
                ]);
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                try{
                    $data = $request->all();
                    if($data['file'] == 0){
                        if($data['imageFile'] != ''){
                            $file = time().'.'.$data['imageFile'] -> extension();
                            $data['imageFile'] -> move(public_path('assets-new/verification/'), $file);
                            $mime = mime_content_type(public_path('assets-new/verification/' . $file));
                            if(strstr($mime, "video/")){
                                $type = 1;
                            }else if(strstr($mime, "image/")){
                                $type = 0;
                            }
                            $verification = Verification::find($request->id);
                            $verification->name = $data['name'];
                            $verification->verification_type_id = $data['verificationType'];
                            $verification->verification_type_text_id = $data['verification_type_text_id'];
                            $verification->problem_id = Crypt::decrypt($data['problem_id']);
                            $verification->solution_id =  Crypt::decrypt($data['solution_id']);
                            $verification->solution_function_id = $data['solution_fun_id'];
                            $verification->user_id = Auth::user()->id;
                            $verification->type = $type;
                            $verification->file = $file;
                            $verification->save();
                            if($verification->id){
                                $success['verification'] =  $verification;
                                return $this->sendResponse($success, 'Verification updated  successfully.');
                            }else{
                                return $this->sendResponse($error, 'Something Wrong.');
                            }
                        }
                    }else if($data['file'] == 2){
                       
                        $verification = new Verification();
                            $verification->name = $data['name'];
                            $verification->verification_type_id = $data['verificationType'];
                            $verification->verification_type_text_id = $data['verification_type_text_id'];
                            $verification->problem_id = Crypt::decrypt($data['problem_id']);;
                            $verification->solution_id =  Crypt::decrypt($data['solution_id']);
                            $verification->solution_function_id = $data['solution_fun_id'];
                            $verification->user_id = Auth::user()->id;
                            $verification->type = 2;
                            $verification->file = $data['youtubeLink'];
                            $verification->save();
                            if($verification->id){
                                $success['verification'] =  $verification;
                                return $this->sendResponse($success, 'Verification created successfully.');
                            }else{
                                return $this->sendResponse($error, 'Something Wrong.');
                            }
                    }
                }catch(Exception $e){
                    return $this->sendError('Error.', ['error'=> $e->getMessage()]);
                }
        
}

                public function updateVocabulary(Request $request)
                {
                   // dd($request);
                    $validator = Validator::make ($request->all() , [
                        'entityId' => 'required', 
                        'key' => 'required',
                        'value' => 'required'
                    ]);
                    if($validator->fails()){
                        return $this->sendError('Validation Error.', $validator->errors());       
                    }
                    try{
                        $verificationEntity = VerificationEntity::find($request->entityId);
                        $verificationEntity->verification_key = $request->key;
                        $verificationEntity->verification_value = $request->value;
                        $verificationEntity->save();
                            if($verificationEntity->id){
                                $success['verificationEntity'] =  $verificationEntity;
                                return $this->sendResponse($success, 'Verification Entity updated  successfully.');
                            }else{
                                return $this->sendResponse($error, 'Something Wrong.');
                            }


                    }catch(Exception $e){
                    return $this->sendError('Error.', ['error'=> $e->getMessage()]);
                    }
                }

}
