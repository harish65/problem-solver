<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Problem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Project extends Model
{
    use HasFactory;
    public function problems()
    {
        return $this->hasMany(Problem::class);
    }
    public function solutions()
    {
        return $this->hasMany(Solution::class);
    }
    public function solutionFunction()
    {
        return $this->hasMany(SolutionFunction::class);
    }

    public function sharedUsers(){
        return $this->hasMany(ProjectShared::class, 'project_id');
    }
    public function projectUsers()
    {
        // return $this->hasMany(User::class ,'id' , 'user_id');
    }

    public function problemsWithUsers($userid){
    return $this->hasMany(\App\Models\Problem::class, 'project_id', 'id')
                    ->where('problems.user_id', $userid);
    }

    public static function SharedProject($project_id , $user_id){
       return DB::table('project_shared')->where('project_id' , $project_id)->where('shared_with' , $user_id)->first();
       
    }
    public static function getUsers($project_id){
        $projectShared =  DB::table('project_shared')->select('shared_with')->where('project_id' , $project_id)->get();
        $users = [];
        foreach($projectShared as $k=>$user){
            $users[$k] = $user->shared_with;
           
        }
        return User::whereIn('id',$users)->get();
    }

    // We are checking here for the last verification submitted bu user or not;
    public static function checkForReport($project_id , $userID = null , $problem_id = null){
         return DB::table('entity_usage')
        ->where('project_id', $project_id)

        ->when(!is_null($userID), function ($query) use ($userID) {
            $query->where('user_id', $userID);
        })

        // Add problem filter only if $problem_id is not null
        ->when(!is_null($problem_id), function ($query) use ($problem_id) {
            $query->where('problem_id', $problem_id);
        })

        ->first();   // returns the first matching row or null
    }


    // Report

    public function problemsForUser(int $userId)
    {
        return $this->problems()->where('user_id', $userId);
    }

    public function projectUser(int $userId){
        return User::where('id', $userId)->select('name')->first()->toArray();
    }
    public function solutionForUser(int $userId)
    {
        return $this->solutions()->where('user_id', $userId);
    }
    public function solutionFunctionForUser(int $userId)
    {
        return $this->solutionFunction()->where('user_id', $userId);
    }
    

}
