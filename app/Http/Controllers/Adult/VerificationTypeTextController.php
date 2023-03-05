<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerificationType;
use App\Models\VerificationTypeText;
use Auth;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use DB;
class VerificationTypeTextController extends BaseController
{
    //verification type text
    public function index(){
       
        $verificationTypetext = DB::table('verification_type_texts')
                                ->join('verification_types', 'verification_type_texts.verification_type_id', '=', 'verification_types.id')
                                ->select('verification_type_texts.*', 'verification_types.name as verification_type_name')
                                ->get();
        $verificationTypes = VerificationType::orderBy("id", "asc")-> get();
        return view('adult.verificationTypeText.index', compact('verificationTypetext' , 'verificationTypes'));
    }
    public function store(Request $request){
        
        $validator = Validator::make ( $request->all(),[
                'name' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{            
            $insert = DB::table('verification_type_texts')->updateOrInsert(['id'=> $request->id],
                        [
                        'user_id' => Auth::user()->id,
                        'name'=> $request->name,                                       
                        'verification_type_id' =>  $request->verification_type_id                                        
                        ]);
            $success['type'] =  $insert;
            return $this->sendResponse($success, 'Record saved successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }
    

    public function delete(Request $request){
        $delete = VerificationTypeText::where("id", $request -> id)->delete();
        $success['delete'] =  $delete;
        return $this->sendResponse($success, 'Record deleted successfully.');    
    }
}
