<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\user;
use App\Models\Problem;
use App\Http\Controllers\BaseController as BaseController;
use Auth;
use Validator;


class ProblemController extends BaseController
{
    //problem
    public function index(){
        $problems = Problem::all();
        return view("admin.problem.index",compact('problems'));
    }



   
    public function getAdminProblem(Request $request){
        $search = $request -> search;

        if($search == ""){
            $problems = Problem::orderBy("id", "desc")
                -> paginate(5);
        }else{
            $users = User::where("name", "like", "%" . $search . "%")
                -> orWhere("email", "like", "%" . $search . "%")
                -> select("id")
                -> get();
                
            $problems = Problem::orderBy("id", "desc")
                -> where(function($q) use($search, $users){
                    $q -> where("name", "like", "%" . $search . "%");
                    $q -> orWhereIn("user_id", $users);
                })
                -> paginate(5);
        }

        return view("admin.problem.getAdminProblem", [
            "problems" => $problems,
        ]);
    }


    public function update(Request $request){
        $defaultType = Problem::where("id", $request -> updateProblemId)
                            -> value("type");
        if($request -> updateProblemType == 0){
            // echo "<pre>";print_r($request->all());die;
            if($request->hasFile('updateProblemFile')){
                
                $validator = Validator::make ( $request->all(),[
                    'updateProblemFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                if($validator->fails()){
                    return $this->sendError('Validation Error.', $validator->errors());       
                }
                $file = time().'.'.$request -> updateProblemFile -> extension();
                $request -> updateProblemFile -> move(public_path('assets-new/problem/'), $file);

                $mime = mime_content_type(public_path('assets-new/problem/' . $file));
                if(strstr($mime, "video/")){
                    $type = 1;
                }else if(strstr($mime, "image/")){
                    $type = 0;
                }

                $problem  = Problem::where("id", $request -> updateProblemId)-> update([
                        "file" => $file,
                        "type" => $type
                    ]);

            }else{
                $problem = Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 0,
                    ]);
            }

            if($defaultType == 1){
                $problem = Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 1,
                    ]);
            }
            if($problem){
                $success['problem'] =  $problem;
                return $this->sendResponse($success, 'Problem updated successfully.');  
            }else{
                return $this->sendError('Error.', ['error'=> 'Some thing went wrong!']);
            }
        }elseif($request->updateProblemType == 2){
            $validator = Validator::make ( $request->all(),[
                    'updateProblemName' => 'required|max:255',
                    'updateProblemFileLink' => 'required|url',  
                ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            try{
                $problem  = Problem::where("id", $request -> updateProblemId)
                            -> update([
                                "type" => $request -> updateProblemType,
                                "file" => $request -> updateProblemFileLink,
                            ]);
                $success['problem'] =  $problem;
                return $this->sendResponse($success, 'Problem updated successfully.');              
            }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
            }

        }
    }

    public function updateAdminProblem(Request $request){
        $defaultType = Problem::where("id", $request -> updateProblemId)
                -> value("type");

        if($request -> updateProblemName){
            $request->validate([
                'updateProblemName' => 'required|max:255',
            ]);

            Problem::where("id", $request -> updateProblemId)
                -> update([
                    "name" => $request -> updateProblemName,
                    "type" => $request -> updateProblemType
                ]);
        }

        if($request -> updateProblemType == 0){
            if($request->hasFile('updateProblemFile')){
                $request -> validate([
                    'updateProblemFile' => 'required|mimes:png,jpg,jpeg,avi,mp4,mpeg|:2048',
                ]);
                $file = time().'.'.$request -> updateProblemFile -> extension();
                $request -> updateProblemFile -> move(public_path('assets/problem/'), $file);

                $mime = mime_content_type(public_path('assets/problem/' . $file));
                if(strstr($mime, "video/")){
                    $type = 1;
                }else if(strstr($mime, "image/")){
                    $type = 0;
                }

                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "file" => $file,
                        "type" => $type
                    ]);
            }else{
                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 0,
                    ]);
            }

            if($defaultType == 1){
                Problem::where("id", $request -> updateProblemId)
                    -> update([
                        "type" => 1,
                    ]);
            }
        }elseif($request -> updateProblemType == 2){
            $request -> validate([
                'updateProblemFileLink' => 'required|url',
            ]);

            Problem::where("id", $request -> updateProblemId)
                -> update([
                    "type" => $request -> updateProblemType,
                    "file" => $request -> updateProblemFileLink,
                ]);
        }

        return back() -> with("success", "Problem has been updated successfully.");
    }

    public function delAdminProblem(Request $request){
       try{
        $problem  = Problem::where('id', '=',$request->input('id'))->first();
       
        if($problem->id){
            $problem->delete();
            $success['problem'] =  $problem;
            return $this->sendResponse($success, 'Problem deleted successfully.');  
        }else{
            return $this->sendError('Error.', ['error'=> 'Problem not exist!']);  
        }       
        }catch(Exception $e){
            return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
      
    }
}
