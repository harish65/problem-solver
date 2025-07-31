<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class PrincipleIdentificationMain extends Model
{
    use HasFactory;
    protected $table = 'principle_identification_main';



    public static function getApplicable($project_id , $principle_type , $principle_identification_id){
           return DB::table('principle_identification_drived_principle')
                            ->where('user_id' , 3)   
                            ->where('project_id' , $project_id)
                            ->where('principle_type' , $principle_type)
                            ->where('principle_identification_id',$principle_identification_id)
                            ->pluck('applicable')
                            ->first();
    }
}
