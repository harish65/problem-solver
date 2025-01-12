<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class ProjectShared extends Model
{
    use HasFactory;
    protected $table = 'project_shared';




    public static function CheckSharedProjectsMode($projectid){
       return  DB::table('project_shared')->where('project_id', $projectid)->where('editable_project', '1')->first();
    }
}
