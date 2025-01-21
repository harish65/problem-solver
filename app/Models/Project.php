<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use App\Models\Problem;
use DB;
use Auth;
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

    public function sharedUsers()
{
    return $this->hasMany(ProjectShared::class, 'project_id');
}
    public function projectUsers()
    {
        // return $this->hasMany(User::class ,'id' , 'user_id');
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


    

}
