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
        // 
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
                            // $insert = DB::table('verification_types')->insert(['id'=> $request->id],
                            //             [
                            //             'user_id' => Auth::user()->id,
                            //             'name'=> $request->name,                                       
                            //             'page_main_title' =>  $request->page_main_title,
                            //             'banner'=> $file, 
                            //             'explanation' =>  $request->explanation,
                            //             'validation_questions' => json_encode($request->validation)
                            //             ]);

                            $verType = new VerificationType();
                            $verType->user_id =   Auth::user()->id;
                            $verType->name =   Auth::user()->name;
                            $verType->user_id =   Auth::user()->id;
                            $verType->user_id =   Auth::user()->id;
                            $verType->user_id =   Auth::user()->id;
                            $verType->user_id =   Auth::user()->id;


            
            // $insert = DB::table('verification_types')->updateOrInsert(['id'=> $request->id],
            //                             [
            //                             'user_id' => Auth::user()->id,
            //                             'name'=> $request->name,                                       
            //                             'page_main_title' =>  $request->page_main_title,
            //                             'banner'=> $file, 
            //                             'explanation' =>  $request->explanation,
            //                             'validation_questions' => json_encode($request->validation)
            //                             ]);

            echo "<pre>";print_r($insert);die;
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
?>
