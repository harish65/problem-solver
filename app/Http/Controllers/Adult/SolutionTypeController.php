<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
class SolutionTypeController extends BaseController
{
    public function index(){
        $solutionTypes = DB::table('solution_types')->get();
        return view('adult.solutionTypes.index' , compact('solutionTypes'));
    }

    public function store(Request $request){
        $validator = Validator::make ( $request->all(),[
            'name' => 'required|max:255'
    ]);
    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }
    try{
        
        $insert = DB::table('solution_types')->updateOrInsert(['id'=> $request->id],
                                    [
                                    'user_id' => Auth::user()->id,
                                    'name'=> $request->name,                                       
                                        
                                    ]);
        $success['type'] =  $insert;
        return $this->sendResponse($success, 'Solution type created successfully.');
    }catch(Exception $e){
        return $this->sendError('Error.', ['error'=> $e->getMessage()]);
    }
    }
     public function delete(Request $request){
        $delete = DB::table('solution_types')->where("id", $request -> id)-> delete();
        $success['delete'] =  $delete;
        return $this->sendResponse($success, 'Solution type deleted successfully.');   
     }
}
