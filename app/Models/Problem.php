<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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


    public static function GetAllProblemsOfProject($id){
        return DB::table('problems')->where('project_id' , $id)->get();
    }
}
