<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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

    public static function CheckVerificationPermission($project_id){
        
        $verificationTypeID = request()->route()->parameter('type');
        $project = Project::find($project_id);
        $parameter = Crypt::decrypt(request()->route()->parameter('id'));
        
        if (!$project) {
            return false; // Return early if the project doesn't exist
        }
        
        $userId = Auth::user()->id;
        $isOwner = $project->user_id == $userId;
        $isShared = $project->shared == 1;
        $canEdit = Project::SharedProject($project_id, $userId);
        $isReadOnly = ProjectShared::CheckSharedProjectsMode($project_id);
        $verificationType = Verification::verificationsArray($verificationTypeID);
        
        
        // If the user has added the problem, return true
        
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


    public static function relationshipsArray(){
        return [
            1 => 'communication_and_people_relationship_explanation',
            2 => 'communication_and_principle_relationship_explanation',
            3 => 'communication_and_solution_function_relationship_explanation',
            4 => 'communication_and_solution_relationship_explanation',
            5 => 'entity_usage_and_principle_relationship_explanation',
            6 => 'entity_usage_and_solution_relationship',
            7 => 'information_and_principle_relationship_explanation',
            8 => 'information_and_solution_relationship_explanation',
            9 => 'principle_and_people_person_relationship_explanation',
            10 => 'principle_and_function_relationship_explanation',
            11 => 'principle_and_solution_relationship_explanation',
            12 => 'vocabulary_and_principle_relationship_explanation',
            13 => 'resource_management_and_solution_relationship_explanation',
            14 => 'people_and_solution_function_relationship_explanation',
        ];
    }


    public static function getValidationAns($project_id , $problem_id , $user_id , $type){
        return DB::table('rel_validations')->where(['relationship_id'=>$type , 'problem_id'=>$problem_id, 'project_id'=>$project_id , 'user_id' => $user_id])->pluck('ans')->first();

    }

    public static function appliedRelationship($type , $projectId , $user_id){
        return DB::table('relationship_applied')
        ->where('project_id', $projectId)
        ->where('user_id', $user_id)
        ->where('rel_id', $type)  
        ->exists(); 
    }

}
