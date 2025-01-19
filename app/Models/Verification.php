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
            $verificationTypeID = request()->route()->parameter('type');
            $project = Project::find($project_id);

            if (!$project) {
                return false; // Return early if the project doesn't exist
            }

            $userId = Auth::user()->id;
            $isOwner = $project->user_id == $userId;
            $isShared = $project->shared == 1;
            $canEdit = Project::SharedProject($project_id, $userId);
            
            $isReadOnly = ProjectShared::CheckSharedProjectsMode($project_id);
            $verificationType = Verification::verificationsArray($verificationTypeID);
            
            // Case 1: Owner of the project
            if ($isOwner && (!$isShared || ($isShared && $isReadOnly && $canEdit && $canEdit->editable_verification == 0))) {
                return true;
            }

            // Case 2: Shared project with editable permissions
            if ($isShared && $canEdit && $canEdit->editable_project == 1 && $canEdit->editable_verification == 1 && $canEdit->$verificationType) {
                return true;
            }

            return false;
    }

    public static function verificationsArray($verificationTypeID){
        $data =  [
            1 => 'vocabulary',
            2 => 'information',
            3 => 'before_and_after',
            4 => 'separation_step',
            5 => 'time_verification',
            6 => 'past_and_present_time',
            7 => 'entity_available',
            8 => 'solution_time_location1',
            9 => 'solution_time_location2',
            10 => 'people_in_project',
            11 => 'people_and_communication',
            12 => 'communication_flow',
            13 => 'partition_approach',
            14 => 'principle_identification',
            15 => 'problem_development_from_error_explanation',
            16 => 'error_correction_approach',
            17 => 'function_adjustment',
            18 => 'function_substitution_and_people',
            19 => 'functions_belong_to_people_explanation',
            20 => 'averaging_approach',
            21 => 'passive_voice_approach_explanation',
            22 => 'replace_problem_by_problem',
            23 => 'resource_management_consideration',
            24 => 'entity_usage',
            25 => 'function_of_people_explanation',
            26 => 'visibility_and_entity_behind_explanation',
            27 => 'mother_nature_existence_explanation',
            28 => 'me_vs__you_approach',
            29 => 'taking_advantage_on_other',
            30 => 'people_outside_the_project',
            31 => 'problem_and_solution_at_location_explanation',
            32 => 'function_at_location_explanation',
        ];
        return $data[$verificationTypeID];
    }
    
    

}
