<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\ProjectShared;
use Auth;

class Verification extends Model
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

    public function verification_type(){
        return $this->belongsTo(VerificationType::class);
    }

    public function solution_function(){
        return $this->belongsTo(SolutionFunction::class);
    }

    public function verification_type_text(){
        return $this->belongsTo(VerificationTypeText::class);
    }

    public static function CheckVerificationPermission($project_id){
        $project            = Project::find($project_id);
        $can_edit           = Project::SharedProject($project_id , Auth::user()->id);  
        $checkReadOnlyMode  = ProjectShared::CheckSharedProjectsMode($project_id);
        $ButtonDisplay  = false;
        if(($project->user_id == Auth::user()->id && $project->shared == 0) || ($project->user_id == Auth::user()->id && $project->shared == 1 && $checkReadOnlyMode && $can_edit != null && $can_edit->editable_verification == 0)){ //Case 1: User is the owner of the project and project not shared or shared only on read only read mode
            $ButtonDisplay =  true;
        }elseif($project->shared == 1 &&  $can_edit != null && $can_edit->editable_project == 1 && $can_edit->editable_verification == 1 ){ //Case 2: User is shared in the project in editable mode
            $ButtonDisplay =  true;
        }
        return $ButtonDisplay;
    }   

}
