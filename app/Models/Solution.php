<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Solution extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function problem(){
        return $this->belongsTo(Problem::class);
    }

    public function solutionType(){
        return $this->belongsTo(SolutionType::class);
    }

    public function solFunction(){
        return $this->hasMany(SolutionFunction::class);
    }

    public function verification(){
        return $this->hasMany(Verification::class);
    }



    public static function GetSolution($id){
        $solution = DB::table('solutions')->where(['project_id' => $id , 'user_id'=>Auth::user()->id])->first();
        if(is_null($solution)){
            $solution = DB::table('problems')->where('project_id' , $id)->first();
        }
        return $solution;

    }
}
