<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Project;
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
    public function index()
    {
        $project = DB::table('projects')
                    ->leftJoin('problems', 'projects.id', '=', 'problems.project_id')
                    ->select('projects.*', 'problems.id as problem_id', 'problems.name as problem')
                    ->orderBy("id", "desc")
                    ->get();
        return view("admin.project.index", ["project" => $project,]);
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
                'name' => 'required|max:255',
            ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{                    
            $Project = Project::Insert([
                        'created_by' => Auth::user()->id,
                        'name' => $request -> name,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
            if($Project){ 
                    $success['Project'] =  $Project;
                    return $this->sendResponse($success, 'Record created successfully.');
            }else{ 
                return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
            } 
        }catch(Exceptio $e){
            return $this->sendError('Error.', ['error'=> 'Something went wrong!']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
