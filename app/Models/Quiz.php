<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Quiz extends Model
{
    use HasFactory;


    public static function getQuiz($project_id, $page_id, $page_type = null)
    {
        $query = DB::table('quizzes')
            ->join('quiz_data', 'quizzes.id', '=', 'quiz_data.quiz_id')
            ->select('quizzes.*', 'quiz_data.quiz_data') // Select what you need
            ->where('quizzes.project_id', $project_id)
            ->where('quizzes.page_id', $page_id)
            ->where('quiz_data.user_id', Auth::user()->id);
        if ($page_type) {
            $query->where('quizzes.page_type', $page_type);
        }
        return $query->first();
    }


    public static function isProjectQuizEditable($projectId)
    {
        $userId = Auth::id();

        // Check if the user is the project owner
        $isOwner = DB::table('projects')
            ->where('id', $projectId)
            ->where('user_id', $userId)
            ->exists();
        $shared = DB::table('project_shared')
            ->where('project_id', $projectId)
            ->where('shared_with', $userId)
            ->first();

        if ($isOwner) {
            return true;
        }

        // Check if the project is shared and both project and quiz are editable

        if ($shared && $shared->editable_project == 1 && $shared->editable_quiz == 1) {
            return true;
        }

        return false;
    }

    public static function getQuisUsers($project_id)
    {
        return DB::table('quiz_data')
            ->join('users', 'quiz_data.user_id', '=', 'users.id') // Join quiz_data with users
            //->leftJoin('quizzes', 'users.id', '=', 'quizzes.user_id') // Join users with quizzes
            //->leftJoin('quiz_data', 'quizzes.id', '=', 'quiz_data.quiz_id') // Join quizzes with quiz_data
            ->select(
                'users.id as id',
                'users.name as user_name',
                'quiz_data.*',
            )
            ->where('quiz_data.project_id', $project_id) // Filter by project
            ->get();
    }
}
