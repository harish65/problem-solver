<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class AverageApproach extends Model
{
    use HasFactory;
    protected $fillable = [
                        "problem_id", 
                        "project_id",
                        "solution_id",
                        "solution_function_id",
                        "user_id",                   
                        "solution_value",
                        "problem_part",
                        "solution_part_value",
                    ];



    public static function getSolutionParts($project_id , $problem_part , $user_id){

        $data = DB::table('averagin_aproach_parts')->where('average_approach_id' , $problem_part)->where('project_id', $project_id)->where('user_id' ,$user_id)->get();
        return $data;    
    }                
}
