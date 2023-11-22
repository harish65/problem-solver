<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Problem;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\BaseController as BaseController;
use Auth;
use DB;
use Validator;

class UserController extends BaseController
{


    public function index(){
        $users = DB::table('customers')->get();
        return view('adult.users.index' , compact('users'));
    }


    public function create(Request $request){        
        $validator = Validator::make ( $request->all(),[
            'name' => 'required',
            'type' => 'required',
           
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        try{
            if($request->hasFile('file')){
                $file = time().'.'.$request -> file -> extension();
                $request -> file -> move(public_path('assets-new/users/'), $file);
                $mime = mime_content_type(public_path('assets-new/users/' . $file));
                // if(strstr($mime, "video/")){
                //     $type = 1;
                // }else if(strstr($mime, "image/")){
                //     $type = 0;
                // }
                $insert = DB::table('customers')->updateOrInsert(['id'=> $request->id],
                [
                    'name' => $request->name,
                    'project_id' => $request->project_id,
                    'file' => $file,
                    'type' => $request->type,
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }else{
                $insert = DB::table('customers')->updateOrInsert(['id'=> $request->id],
                [
                    'name' => $request->name,
                    'type' => $request->type,
                    'created_at' => date('Y-m-d h:i:s')
                ]);
            }
            $success['user'] = $insert;
            return $this->sendResponse($success, 'Problem saved successfully.');
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }


}