<?php

namespace App\Http\Controllers\Project;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;

class ProjectController extends BaseController
{
    public function __construct() {
        $this->middleware('auth');
    }

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
                    if ($request->is('api/*')) {
                            $success['projects'] = $project;
                            $success['token'] = $request->header('Authorization');
                            return $this->sendResponse($success,'Reviewer Response');
                    }else{
                        return view("adult.project.index", ["project" => $project]);
                    }

        // return view ('project.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    
}
