<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Relationship extends Model
{
    use HasFactory;

    public static function relationshipCat(){
        return DB::table('relationship_categories')->get();
    }

    public static function getEntities($project_id){
        return   $entitiesAvailable = DB::table("entity_available")
                                        ->where("type", "=", 0)
                                        ->where("user_id" , Auth::user()->id)
                                        ->where('project_id' , $project_id)
                                        ->get();
    }
}
