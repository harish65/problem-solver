<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index($id = null, Request $request){
        
        $params = Crypt::decrypt($id);
        $userId = 6;
            if(is_array($params)){
                $projectID = $params['project_id']; 
                $problem_id  = $params['problem_id'];
                $project = DB::table('projects')
                            ->leftjoin('project_shared', 'projects.id', '=', 'project_shared.project_id')
                            ->select('projects.*')
                            ->orderBy("projects.id", "desc")
                            ->where('projects.id' ,$projectID)
                            ->where(function($query){
                                    $query->orWhere('projects.user_id' , Auth::user()->id);
                                    $query->orWhere('project_shared.shared_with', '=', Auth::user()->id);
                            })
                        ->orderBy('projects.id', 'desc')
                        ->first();

                if(is_null($project) || isset($project->user_id) && $project->user_id != Auth::user()->id){
                    return abort(404);
                }
                $userQuiz = DB::table('quiz_data')
                    ->join('quizzes', 'quiz_data.quiz_id', '=', 'quizzes.id')
                    ->where([
                        'quiz_data.project_id' => $projectID,
                        'quiz_data.user_id' => $userId,
                    ])
                    ->select('quiz_data.*', 'quizzes.page_type', 'quizzes.page_id', 'quizzes.project_id', 'quizzes.user_id', 'quizzes.quiz_data as owner_quiz_data', 'quizzes.quiz_title', 'quizzes.quiz_type') // or specify exact fields
                    ->get();

                    $problem = DB::table('problems')->where(['project_id' => $projectID , 'user_id'=> $userId])->orderBy('id', 'desc')->first();
                    // dd($userQuiz->first());

            }
        return view('adult.result.index', compact('project', 'problem_id', 'projectID', 'userQuiz', 'problem'));
    }
}
