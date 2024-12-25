<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class SolutionFunction extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function problem(){
        return $this->belongsTo(Problem::class);
    }

    public function solution(){
        return $this->belongsTo(Solution::class);
    }

    public function verification(){
        return $this->hasMany(Verification::class);
    }

    public static function getAllSolutionfunction($project_id){
        return DB::table('solution_functions')->where('project_id' , $project_id)->get();
    }
}
