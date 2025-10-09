<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index($id = null, Request $request){
        if(isset($request->shared) && $request->shared == true){
            $params = Crypt::decrypt($request->parameter);
            $projectID = $params['project_id']; 
            $problem_id  = $params['problem_id'];
        }else{
            $params = Crypt::decrypt($id);
            $projectID = $params['project_id']; 
            $problem_id  = $params['problem_id'];
        }

        //dd($params['project_id'] , $params['problem_id']);
        
            $users = null;
          
        if(!empty($params['project_id'])){
                $users = DB::table('project_shared')->join('users', 'project_shared.shared_with', '=', 'users.id')->where('project_id', $params['project_id'])->select('users.id', 'name')->get();
        }
        
        $userQuiz = null;
        $problem = null;
        $project = null;
        $userId = null;

        // dd($request->all());
        if(isset($request->id)){ 
            $userId = (int)(Crypt::decrypt($request->id));
            if(is_array($params)){
                
                $project = DB::table('projects')
                            ->leftjoin('project_shared', 'projects.id', '=', 'project_shared.project_id')
                            ->select('projects.*')
                            ->orderBy("projects.id", "desc")
                            ->where('projects.id' ,$projectID)
                            ->where(function($query) use ($userId){
                                    $query->orWhere('projects.user_id' , Auth::user()->id);
                                    $query->orWhere('project_shared.shared_with', '=', $userId);
                            })
                        ->orderBy('projects.id', 'desc')
                        ->first();
                            // die;
                // if(is_null($project) || isset($project->user_id)){
                //     return abort(404);
                // }
                
                $userQuiz = DB::table('quiz_data')
                    ->join('quizzes', 'quiz_data.quiz_id', '=', 'quizzes.id')
                    ->where([
                        'quiz_data.project_id' => $projectID,
                        'quiz_data.user_id' => $userId,
                    ])
                    ->select('quiz_data.*', 'quizzes.page_type', 'quizzes.page_id', 'quizzes.project_id', 'quizzes.user_id', 'quizzes.quiz_data as owner_quiz_data', 'quizzes.quiz_title', 'quizzes.quiz_type') // or specify exact fields
                    ->get();

                    $problem = DB::table('problems')->where(['project_id' => $projectID , 'user_id'=> $userId])->orderBy('id', 'desc')->first();

                    // dd($projectID, $userId,  $userQuiz, $project);
            }
        }

        return view('adult.result.index', compact('project', 'userQuiz', 'problem', 'users', 'userId'));
    }
}
