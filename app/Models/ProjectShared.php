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

    public function shareduser()
    {
        return $this->hasOne(User::class , 'id' , 'shared_with');
    }
    public function projectDetails()
    {
        return $this->hasOne(Project::class , 'id' , 'project_id');
    }


    public static function CheckSharedProjectsMode($projectid){
       return  DB::table('project_shared')->where('project_id', $projectid)->where('editable_project', '1')->first();
    }
}
