<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VerificationType;
use Auth;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use DB;
class VerificationTypeController extends BaseController
{
    //verification type
    public function index(){
        $types = VerificationType::orderBy("id", "desc")->get();
        return view("admin.verificationType.index" , compact('types'));
    }



    public function store(Request $request){
        
        $validator = Validator::make ( $request->all(),[
                'name' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            
            $insert = DB::table('verification_type')->updateOrInsert(['id'=> $request->id],
                                        [
                                        'user_id' => Auth::user()->id,
                                        'name'=> $request->name,                                       
                                        'first_field' =>  $request->first_field,
                                        'second_field'=> $request->second_field, 
                                        'third_field' =>  $request->third_field
                                        ]);
            $success['type'] =  $insert;
            return $this->sendResponse($success, 'Verifivcation type created successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }


    public function delete(Request $request){
        $delete = VerificationType::where("id", $request -> id)-> delete();
        $success['delete'] =  $delete;
        return $this->sendResponse($success, 'Verifivcation type deleted successfully.');     
    }
}
