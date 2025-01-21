<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Problem extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function solution(){
        return $this->hasMany(Solution::class);
    }
    
    public function solFunction(){
        return $this->hasMany(SolutionFunction::class);
    }

    public function verification(){
        return $this->hasMany(Verification::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public static function GetAllProblemsOfProject($id){
        return DB::table('problems')->where('project_id' , $id)->get();
    }
    public static function GetAllUsersInProblem($project_id){
        return DB::table('users')
                            ->leftJoin('problems', 'users.id', '=', 'problems.user_id') // Join users with problems table
                            ->select(
                                'users.id as user_id',
                                'users.name as user_name',
                                'problems.id as problem_id',
                                'problems.name as problem_name',
                                'problems.created_at as problem_created_at'
                            )
                            ->where('problems.project_id',  $project_id) // Get only users with problems
                            ->get();
    }

    public static function GetProblem($id){
        $problem = DB::table('problems')->where(['project_id' => $id , 'user_id'=>Auth::user()->id])->first();
        if(is_null($problem)){
            $problem = DB::table('problems')->where('project_id' , $id)->first();
        }
        return $problem;

    }
}
