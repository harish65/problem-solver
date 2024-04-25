<?php

namespace App\Http\Controllers\Adult;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Project;
use Illuminate\Support\Facades\Crypt;
use Auth;
use Validator;
use DB;

class ProjectController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $project = DB::table('projects')
                    ->leftJoin('problems', 'projects.id', '=', 'problems.project_id')
                    ->leftJoin('solutions', 'projects.id', '=', 'solutions.project_id')
                    ->select('projects.*', 'problems.id as problem_id', 'problems.name as problem' , 'solutions.name as solution_name' , 'solutions.id as solution_id')
                    ->orderBy("id", "desc")
                    ->where('projects.user_id' , Auth::user()->id)
                    ->get();
                    if ($request->is('api/*')) {
                            $success['projects'] = $project;
                            $success['token'] = $request->header('Authorization');
                            return $this->sendResponse($success,'Reviewer Response');
                    }else{
                        return view("adult.project.index", ["project" => $project]);
                    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
                  
            $validator = Validator::make ( $request->all(),[
                'name' => 'required|max:255'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            try{
                
                $insert = DB::table('projects')->updateOrInsert(['id'=> $request->id],
                                            [
                                            'user_id' => Auth::user()->id,
                                            'name'=> $request->name,                                       
                                            'created_at' => date('Y-m-d H:i:s'),
                                            ]);
                $success['type'] =  $insert;
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success, 'Project created successfully.');
            }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $data  = $request->all();
           
           
            $project  = DB::table('projects')->where('id', $request->input('id'))->delete();
             
            $problem = DB::table('problems')->where('project_id', $request->input('id'))->first();
            
            if(isset($problem->id)){
                $solution = DB::table('solutions')->where('problem_id', $problem->id)->first();  
                DB::table('problems')->where('project_id',$problem->id)->delete();
                    if(isset($solution->id)){
                        $solution_funct = DB::table('solution_functions')->where('solution_id', $solution->id)->first(); 
                        DB::table('solutions')->where('project_id',$solution->id)->delete();
                            if(isset($solution_funct->id)){
                                DB::table('solution_functions')->where('project_id',$solution_funct->id)->delete();
                            }
                    }
            }
            
            // echo "<pre>";print_r();die;
            if($project){                
                $success['success'] =  'true';
                $success['token'] = $request->header('Authorization');
                return $this->sendResponse($success, 'Project deleted successfully.');  
            }else{
                $success['success'] =  false;
                return $this->sendError($success,  'Project can not deleted13.');
            }           
            
            }catch(\Illuminate\Database\QueryException $e){
                $success['success'] =  false;
                return $this->sendResponse($success, 'Project can not deleted.');  
            }
    }
    
}
