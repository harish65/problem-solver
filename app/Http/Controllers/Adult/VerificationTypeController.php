<?php

namespace App\Http\Controllers\Adult;

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
        return view("adult.verificationType.index" , compact('types'));
    }

    public function verificationType(){
        return view('adult.verificationType.add-verification-type');
    }



    public function store(Request $request){
        $validator = Validator::make ( $request->all(),[
                'name' => 'required|max:255',
                'page_main_title' => 'required',
                'explanation' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            $file = null;
            if($request->hasFile('banner')){
                $file = time().'.'.$request -> banner -> extension();
                $request -> banner -> move(public_path('assets-new/verification_types/'), $file);
                }
                if($request->id != ''){
                    $verType = VerificationType::find($request->id);
                    $verType->user_id =   Auth::user()->id;
                    $verType->name =   $request->name;
                    $verType->page_main_title =   $request->page_main_title;
                    $verType->banner =   $file;
                    $verType->explanation =   $request->explanation;
                    $verType->save();
                    if($verType->id){
                        foreach($request->validation as $key=>$validations){            
                            $question = $request->validation[$key][0];
                                foreach($request->validation[$key]['option'] as $a =>$inner){                     
                                    if(isset($request->validation[$key]['option'][$a])){
                                        $insert = DB::table('verification_validation_questions')->insert([
                                                'verificatoin_type_id' => $verType->id,
                                                'question' =>  $question,
                                                'answer' => $request->validation[$key]['option'][$a]
                                        ]);
                                    }
                                }
                
                            }
                    }
                }else{
                    $verType = new VerificationType();
                    $verType->user_id =   Auth::user()->id;
                    $verType->name =   $request->name;
                    $verType->page_main_title =   $request->page_main_title;
                    $verType->banner =   $file;
                    $verType->explanation =   $request->explanation;
                    $verType->save();
                    if($verType->id){
                        foreach($request->validation as $key=>$validations){            
                            $question = $request->validation[$key][0];
                                foreach($request->validation[$key]['option'] as $a =>$inner){                     
                                    if(isset($request->validation[$key]['option'][$a])){
                                        $insert = DB::table('verification_validation_questions')->insert([
                                                'verificatoin_type_id' => $verType->id,
                                                'question' =>  $question,
                                                'answer' => $request->validation[$key]['option'][$a]
                                        ]);
                                    }
                                }
                
                            }
                    }
                
                }  
            $success['type'] =  $verType;
            return $this->sendResponse($success, 'Verifivcation type created successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }

    public function edit($id){
        $data = DB::table('verification_types')->where('id','=',$id)->first();
        echo "<pre>";print_r($data);die;
        return view('adult.verificationType.add-verification-type', compact('data'));
    }


    public function delete(Request $request){

        $delete = VerificationType::where("id", $request -> id)-> delete();
        $success['delete'] =  $delete;
        return $this->sendResponse($success, 'Verifivcation type deleted successfully.');     
    }
}
?>
