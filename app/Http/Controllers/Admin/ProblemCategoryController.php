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
use DB;
class ProblemCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('problem_categories')->get()->toArray();
        return view('admin.problem-category.index' , compact('categories'));
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
    public function store(Request $request)
    {
        
        $validator = Validator::make ( $request->all(),[
            'name' => 'required|max:255'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        try{
            
            $insert = DB::table('problem_categories')->updateOrInsert(['id'=> $request->id],
                                        [
                                        'user_id' => Auth::user()->id,
                                        'name'=> $request->name,                                       
                                        'created_at' => date('Y-m-d h:i:s')
                                        ]);
            $success['type'] =  $insert;
            return $this->sendResponse($success, 'Category created successfully.');
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
        //
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
            $problemCate  = DB::table('problem_categories')->where('id', $request->input('id'))->delete();
            
            $success['problemCate'] =  $problemCate;
            return $this->sendResponse($success, 'Category deleted successfully.');  
            
            }catch(Exception $e){
                return $this->sendError('Error.', ['error'=> $e->getMessage()]);
            }
    }
}
